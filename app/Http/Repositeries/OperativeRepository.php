<?php

namespace App\Http\Repositeries;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\OperativeInterface;
use App\Http\Requests\StoreOperativeRequest;
use App\Jobs\OperativeCreateJob;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Models\{
    JobDetail,
    JobDetailForm,
    Operative,
    User,
};
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class OperativeRepository extends Controller implements OperativeInterface
{
    protected Operative $operative;
    protected User $user;
    protected JobDetailForm $jobDetailForm;
    protected JobDetail $jobDetail;

    public function __construct(JobDetail $jobDetail, Operative $operative, User $user, JobDetailForm $jobDetailForm)
    {
        $this->operative = $operative;
        $this->user  = $user;
        $this->jobDetailForm = $jobDetailForm;
        $this->jobDetail = $jobDetail;
    }

    public function index()
    {
        $user_type = auth()->user()->type;
        if ($user_type == 'super_admin')
            $operatives = $this->operative->with('users')->get();
        else
            $operatives = $this->operative::where('parent_id', auth()->user()->id)->get();
        return view('operative.index', compact('operatives'));
    }
    public function create()
    {
        $admins = User::where('type', 'admin')->get();
        return view('operative.create',compact('admins'));
    }

    public function store(StoreOperativeRequest $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();

            $this->user->email = $request->email;
            $this->user->password = Hash::make('123456');
            $this->user->type = 'operative';
            if ($this->user->save()) {
                $this->operative->first_name = $request->first_name;
                $this->operative->surname = $request->surname;
                $this->operative->phone = $request->phone;
                $this->operative->address1 = $request->address1;
                $this->operative->address2 = $request->address2;
                $this->operative->town = $request->town;
                $this->operative->city = $request->city;
                $this->operative->post_code = $request->post_code;
                if(auth()->user()->type == 'super_admin'){
                    $this->operative->parent_id = $request->admin_id;
                }else {
                    $this->operative->parent_id = auth()->user()->id;
                }
                $this->operative->user_id = $this->user->id;
                $this->operative->save();

                $token = Str::random(64);
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);
                $action_link = route('reset_password', ['token' => $token, 'email' => $request->email]);
                $body = "We have received a request to reset password regard this email <u> " . $request->email .
                    "</u>.You can reset your password by clicking the link below";

                $data['action_link'] = $action_link;
                $data['body'] = $body;
                $data['from'] = $request->email;
                $data['to'] = 'noreply@gmail.com';

                Mail::send('auth.passwords.email-reset', $data,  function ($message) use ($request) {
                    $message->from('noreply@gmail.com', 'Hole Master');
                    $message->to($request->email)
                        ->subject('Reset Password');
                });
                DB::commit();
                return redirect()->route('operative.index')
                    ->with('sessionMessage', 'Operative Created Successfully');
            }

            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'you have some error.']);
        } catch (\Exception $ex) {
            DB::rollBack();
            $error =  $ex->getMessage();
            return redirect()->back()->withErrors(['error' => $error]);
        }
    }

    public function edit(int $id)
    {
        $admins = User::where('type', 'admin')->get();
        $user_type = auth()->user()->type;
        if ($user_type == "super_admin")
            $operative =  $this->operative->find($id);
        else
            $operative =  $this->operative->where('id', $id)->where('parent_id', auth()->user()->id)->first();
        return view('operative.edit', compact('operative','admins'));
    }

    public function update(int $id, StoreOperativeRequest $request)
    {
        $operative =  $this->operative->find($id);
        $operative->first_name = $request->first_name;
        $operative->surname = $request->surname;
        $operative->phone = $request->phone;
        $operative->address1 = $request->address1;
        $operative->address2 = $request->address2;
        $operative->town = $request->town;
        $operative->city = $request->city;
        $operative->post_code = $request->post_code;
        if (auth()->user()->type == 'super_admin') {
            $operative->parent_id = $request->admin_id;
        } else {
            $operative->parent_id = Auth::user()->id;
        }

        $user = User::find($operative->user_id);
        if (isset($request->password) && !empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->update();
        $operative->save();
        return redirect()->route('operative.index')
            ->with('sessionMessage', 'Operative Updated Successfully');
    }

    public function delete(int $id)
    {
        $operative = $this->operative->find($id);
        $operative->delete();
        return redirect()->route('operative.index')
            ->with('sessionMessage', 'Operative Deleted Successfully');
    }

    public function operativeDetailEdit(int $id)
    {
        $operative = Operative::where('user_id', $id)->first();
        return view('operative.editDetails', compact('operative'));
    }

    public function operativeDetailUpdate(int $id, StoreOperativeRequest $request)
    {
        $operative = Operative::where('user_id', $id)->first();
        $operative->first_name = $request->first_name;
        $operative->surname = $request->surname;
        $operative->phone = $request->phone;
        $operative->address1 = $request->address1;
        $operative->address2 = $request->address2;
        $operative->town = $request->town;
        $operative->city = $request->city;
        $operative->post_code = $request->post_code;

        $operative->save();
        return redirect()->route('operative.detail', [$operative->user_id])
            ->with('sessionMessage', 'Operative Updated Successfully');
    }

    public function showJobDetails(int $id)
    { {
            // dd('abc');
            $jobDetailForm = JobDetailForm::where('job_detail_id', $id)->with(['jobDetail', 'forms'])->first();

            $jobForms = JobDetailForm::where('job_detail_id', $id)->whereHas('forms')->get();
            return view('operative.showJobDetail', compact('jobDetailForm', 'jobForms'));
        }
    }

    public function resetEmail(int $id)
    {
        $operative =  $this->operative->find($id);

        $user_email = User::find($operative->user_id);
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $user_email->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);
        $action_link = route('reset_password', ['token' => $token, 'email' => $user_email->email]);
        $body = "We have received a request to reset password regard this email <u> " . $user_email->email .
            "</u>.You can reset your password by clicking the link below";

        $data['action_link'] = $action_link;
        $data['body'] = $body;
        $data['from'] = $user_email->email;
        $data['to'] = 'noreply@gmail.com';

        Mail::send('auth.passwords.email-reset', $data,  function ($message) use ($user_email) {
            $message->from('noreply@gmail.com', 'Hole Master');
             $message->to($user_email->email)
                ->subject('Reset Password');
        });
        return redirect()->route('operative.index')
                    ->with('sessionMessage', 'Reset Email Sent  Successfully');
    } 
}
