<?php

namespace App\Http\Repositeries;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\ClientInterface;
use App\Http\Requests\StoreClientRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Models\{
    Client,
    Site,
    User
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClientRepository extends Controller implements ClientInterface
{

    protected Client $client;
    protected Site $client_site;
    public function __construct(Client $client, User $user,  Site $client_site)
    {
        $this->client = $client;
        $this->client_site = $client_site;
    }
    public function index()
    {
        $user_type = auth()->user()->type;
        if ($user_type == "super_admin")
            $clients = $this->client->with('users')->get();
        else
            $clients = $this->client::where('parent_id', auth()->user()->id)->get();
        return view('client.index', compact('clients'));
    }

    public function create()
    {
        $admins = User::where('type', 'admin')->get();
        return view('client.create', compact('admins'));
    }

    public function store(StoreClientRequest $request)
    {
        // dd($request->all());
        // if (!isset($request->sites) ||  count($request->sites) < 1) {
        //     return redirect()->back()->with('error', 'Please Enter the Site');
        // }
        try {
            DB::beginTransaction();
            $this->client->client_name = $request->name;
            $this->client->phone = $request->phone;
            $this->client->client_contact = $request->contact;
            $this->client->email = $request->email;
            $this->client->address1 = $request->address1;
            $this->client->address2 = $request->address2;
            $this->client->town = $request->town;
            $this->client->city = $request->city;
            $this->client->post_code = $request->post_code;
            if (auth()->user()->type == 'super_admin') {
                $this->client->parent_id = $request->admin_id;
            } else {
                $this->client->parent_id = Auth::user()->id;
            }
            $this->client->save();

            if (isset($request->sites) && count($request->sites) > 0) {
                foreach ($request->sites as $key => $value) {
                    if ($value != null) {
                        $client_site = new Site();
                        $client_site->site = $value['name'];
                        $client_site->client_id = $this->client->id;
                        $client_site->site_address = $value['site_address'];
                        $client_site->site_email = $value['site_email'];
                        $client_site->site_phone = $value['site_phone'];
                        $client_site->site_contact = $value['site_contact'];

                        $client_site->save();
                    }
                }
            }
            DB::commit();
            return redirect()->route('client.index')
                ->with('sessionMessage', 'Client Created Successfully');

            DB::rollBack();
            return redirect()->back()->with('error', 'you have some error');
        } catch (\Exception $ex) {
            DB::rollBack();
            $error =  $ex->getMessage();
            dd($error);
            return redirect()->back()->with('success', $error);
        }
    }

    public function edit(int $id)
    {
        $admins = User::where('type', 'admin')->get();
        $user_type = auth()->user()->type;
        if ($user_type == "super_admin")
            $client = Client::where('id', $id)->with('sites')->first();
        else
            $client = Client::where('id', $id)->where('parent_id', auth()->user()->id)->with('sites')->first();
        return view('client.edit', compact('client', 'admins'));
    }

    public function update(int $id, StoreClientRequest $request)
    {
        // if (!isset($request->sites) ||  count($request->sites) < 1) {
        //     return redirect()->back()->with('error', 'Please Enter Site');
        // }

        $client =  $this->client->find($id);
        $client->client_name = $request->name;
        $client->phone = $request->phone;
        $client->client_contact = $request->contact;
        $client->address1 = $request->address1;
        $client->address2 = $request->address2;
        $client->town = $request->town;
        $client->city = $request->city;
        $client->post_code = $request->post_code;
        if (auth()->user()->type == 'super_admin') {
            $client->parent_id = $request->admin_id;
        } else {
            $client->parent_id = Auth::user()->id;
        }
        $client->update();

        $client_sites = Site::where('client_id', $id)->get();
        if (count($client_sites) > 0) {
            foreach ($client_sites  as $item) {
                $item->delete();
            }
        }

        if (isset($request->sites) && count($request->sites) > 0) {
            foreach ($request->sites as $key => $value) {
                if ($value != null) {
                    $client_site = new Site();
                    $client_site->site = $value['name'];
                    $client_site->client_id = $client->id;
                    $client_site->site_address = $value['site_address'];
                    $client_site->site_email = $value['site_email'];
                    $client_site->site_phone = $value['site_phone'];
                    $client_site->site_contact = $value['site_contact'];
                    $client_site->save();
                }
            }
        }
        return redirect()->route('client.index')
            ->with('sessionMessage', 'Client Updated Successfully');
    }

    public function delete(int $id)
    {
        $client = $this->client->find($id);
        $client->delete();
        return redirect()->route('client.index')
            ->with('sessionMessage', 'Client Deleted Successfully');
    }
}
