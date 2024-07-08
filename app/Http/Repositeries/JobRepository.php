<?php

namespace App\Http\Repositeries;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\ClientInterface;
use App\Http\Interfaces\JobInterface;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\StoreJobRequest;
use Exception;
use Illuminate\Http\JsonResponse;

use App\Models\{
    Client,
    Operative,
    JobDetail,
    User,
    Form,
    JobDetailForm,
    Site,
    Stages
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function GuzzleHttp\Promise\all;
use function GuzzleHttp\Promise\exception_for;

class JobRepository extends Controller implements JobInterface
{

    protected JobDetail $jobDetail;
    protected User $user;
    protected Client $client;
    protected Operative $operative;
    protected Form $form;
    protected JobDetailForm $jobDetailForm;
    protected Site $sites;
    protected Stages $stages;

    public function __construct(
        JobDetail $jobDetail,
        User $user,
        Operative $operative,
        Client $client,
        Form $form,
        JobDetailForm $jobDetailForm,
        Site $sites,
        Stages $stages,
    ) {
        $this->jobDetail = $jobDetail;
        $this->user  = $user;
        $this->client = $client;
        $this->operative = $operative;
        $this->form = $form;
        $this->jobDetailForm = $jobDetailForm;
        $this->sites = $sites;
        $this->stages = $stages;
    }
    public function index()
    {
        $user_type = auth()->user()->type;
        if ($user_type == 'super_admin')
            $jobs = $this->jobDetail->with(['userClient', 'userOperative', 'jobSite', 'users'])->get();
        else
            $jobs = $this->jobDetail->where('parent_id', auth()->user()->id)->with(['userClient', 'userOperative', 'jobSite'])->get();
        return view('job.index', compact('jobs'));
    }

    public function create()
    {
        $user_type = auth()->user()->type;
        $admins = User::where('type', 'admin')->where('deleted_at', null)->get();
        if ($user_type == 'super_admin') {
            $clients = $this->client::all();
            $operatives = $this->operative::all();
        } else {
            $clients = $this->client::where('parent_id', auth()->user()->id)->get();
            $operatives = $this->operative::where('parent_id', auth()->user()->id)->get();
        }
        $forms = $this->form::all();
        $sites = $this->sites::all();
        $stages = Stages::orderBy('id', 'asc')->with('forms')->whereHas('forms')->get();
        // dd($stages);

        return view('job.create', compact('stages','clients', 'operatives', 'forms', 'sites', 'admins'));
    }

    public function store(StoreJobRequest $request, User $user)
    {
        // dd($request->all());
        $user_id = $user->id;
        try {
            if (empty($request->form_id)) {
                return redirect()->back()->with('sessionMessage', 'Please Select The Form');
            }
            DB::beginTransaction();
            $client = $this->client->find($request->client_name);
            $operative = $this->operative->find($request->operative_name);
            $sites = $this->sites->find($request->sites);

            $c_id = $client->id;
            $this->jobDetail->client_id = $c_id;
            $this->jobDetail->user_id = $user->id;
            $this->jobDetail->operative_id = $operative->user_id;
            $this->jobDetail->visit_date = $request->visit_date;
            $this->jobDetail->site_id = $request->sites;
            if (auth()->user()->type == 'super_admin') {
                $this->jobDetail->parent_id = $request->depot_id;
            } else {
                $this->jobDetail->parent_id = auth()->user()->id;
            }
            $this->jobDetail->save();
            if ($this->jobDetail->save()) {
                if (count($request->form_id) > 0) {
                    foreach ($request->form_id as $value) {
                        $jobDetailForm = new JobDetailForm();
                        $jobDetailForm->job_detail_id = $this->jobDetail->id;
                        $jobDetailForm->form_id = $value;
                        $jobDetailForm->is_locked = 'Yes';
                        $jobDetailForm->save();
                    }
                }
            }

            $form_id = $this->jobDetail->jobDetailForms[0]->id;
            $jobDfom = JobDetailForm::find($form_id);
            $jobDfom->update([
                'is_locked' => 'No'
            ]);

            DB::commit();
            return redirect()->route('job.index')
                ->with('sessionMessage', 'Job Created Successfully');
        } catch (\Exception $ex) {
            DB::rollBack();
            $error =  $ex->getMessage();
            return redirect()->back()->with('error', $error);
        }
    }

    public function edit(int $id)
    {
        $admins = User::where('type', 'admin')->where('deleted_at', null)->get();
        $user_type = auth()->user()->type;
        if ($user_type == 'super_admin') {
            $clients = $this->client::all();
            $operatives = $this->operative::all();
        } else {
            $clients = $this->client::where('parent_id', auth()->user()->id)->get();
            $operatives = $this->operative::where('parent_id', auth()->user()->id)->get();
        }
        $job =  $this->jobDetail->where('id', $id)->with(['userClient', 'userOperative', 'jobSite', 'jobDetailForms'])->first();
        $forms = $this->form::all();
        $form_ids = [];
        foreach ($job->jobDetailForms as $item) {
            array_push($form_ids, $item->form_id);
        }
        return view('job.edit', compact('job', 'clients', 'forms', 'form_ids', 'admins', 'operatives'));
    }

    public function show(int $id)
    {
        $jobDetailForm = JobDetailForm::where('job_detail_id', $id)->with(['jobDetail', 'forms'])->first();
        $jobForms = JobDetailForm::where('job_detail_id', $id)->whereHas('forms')->get();
        return view('job.show', compact('jobDetailForm', 'jobForms'));
    }

    public function update(int $id, StoreJobRequest $request)
    {
        try {
            DB::beginTransaction();

            $jobDetail =  $this->jobDetail->find($id);
            $jobDetail->client_id = $request->client_name;
            $jobDetail->operative_id = $request->operative_name;
            $jobDetail->visit_date = $request->visit_date;
            $jobDetail->site_id = $request->sites;

            $jobDetailForm = JobDetailForm::where('job_detail_id', $id)->get();
            if (count($jobDetailForm) > 0) {
                foreach ($jobDetailForm  as $item) {
                    $item->delete();
                }
            }

            $jobDetail->update();
            if ($jobDetail->update()) {
                if (count($request->form_id) > 0) {
                    foreach ($request->form_id as $value) {
                        $jobDetailForm = new JobDetailForm();
                        $jobDetailForm->job_detail_id = $jobDetail->id;
                        $jobDetailForm->form_id = $value;
                        $jobDetailForm->is_locked = 'Yes';
                        $jobDetailForm->save();
                    }
                }
            }

            $form_id = $jobDetail->jobDetailForms[0]->id;
            $jobDfom = JobDetailForm::find($form_id);
            $jobDfom->update([
                'is_locked' => 'No'
            ]);
            DB::commit();
            return redirect()->route('job.index')
                ->with('sessionMessage', 'Job Updated Successfully');
        } catch (\Exception $ex) {
            DB::rollBack();
            $error =  $ex->getMessage();
            return redirect()->back()->with('error', $error);
        }
    }

    public function delete(int $id)
    {
        $jobDetail = $this->jobDetail->find($id);
        $jobDetail->delete();
        return redirect()->route('job.index')
            ->with('sessionMessage', 'Job Deleted Successfully');
    }

    public function clientSites($id)
    {
        $sites = Site::where('client_id', $id)->get();
        return $sites;
    }

    public function depotResourse($id)
    {
        $clients = Client::where('parent_id', $id)->where('deleted_at', null)->get();
        $operatives = Operative::where('parent_id', $id)->where('deleted_at', null)->get();
        $response  = ['clients' => $clients, 'opeatives' => $operatives];
        return $response;
    }
}
