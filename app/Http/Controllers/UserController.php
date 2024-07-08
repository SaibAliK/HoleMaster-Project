<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\{
    StoreClientRequest,
};

class UserController extends Controller
{
 
    public function index()
    {
        $clients = Client::all();
        return view('client/index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client/create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        // $this->validate($request, [
        //     'name' => 'required|min:3|max:50',
        //     'email' => 'required|email|max:50|unique:users,email',
        //     'phone' => 'required',
        //     'contact' => 'required',
        //     'address1' => 'required',
        //     'address2' => 'required',
        //     'town' => 'required',
        //     'city' => 'required',
        //     'post_code' => 'required',
        // ]);

        try{
            DB::beginTransaction();

            $user = new User();
            $user->email = $request->email;
            $user->password = Hash::make('123456');
            $user->type = 'client';
            if($user->save()){
                $client = new Client();
                $client->client_name = $request->name;
                $client->phone = $request->phone;
                $client->client_contact = $request->contact;
                $client->address1 = $request->address1;
                $client->address2 = $request->address2;
                $client->town = $request->town;
                $client->city = $request->city;
                $client->post_code = $request->post_code;
                $client->user_id = $user->id;
                $client->save();
    
                DB::commit();
                return redirect('home');
    
            }

            DB::rollBack();
            return redirect()->back()->with('error', 'you have some error');   


        }catch(\Exception $ex){
            DB::rollBack();
            $error =  $ex->getMessage();
            return redirect()->back()->with('success', $error);   

        }
        

        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
   

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::where('id',$id)->first();
        return view('client/edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //     'name' => 'required|min:3|max:50',
        //     'phone' => 'required',
        //     'contact' => 'required',
        //     'address1' => 'required',
        //     'address2' => 'required',
        //     'town' => 'required',
        //     'city' => 'required',
        //     'post_code' => 'required',
        // ]);

        $client =  Client::find($id);
        $client->client_name = $request->name;
        $client->phone = $request->phone;
        $client->client_contact = $request->contact;
        $client->address1 = $request->address1;
        $client->address2 = $request->address2;
        $client->town = $request->town;
        $client->city = $request->city;
        $client->post_code = $request->post_code;
        $client->save();
        return redirect('home');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
