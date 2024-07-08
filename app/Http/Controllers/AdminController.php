<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use App\Models\UserPermission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminController extends Controller
{

    public function index()
    {
        $admins = User::where('type', 'admin')->get();
        return view('admin/index', compact('admins'));
    }

    public function permission_index()
    {
        $permissions = Permission::all();
        return view('role/index', compact('permissions'));
    }

    public function permission_update(Request $request)
    {
        foreach($request->permissions as $key=>$item)
        {
           $permiss =  Permission::find($item);
           $permiss->name = $request->names[$key];
           $permiss->update();
        }
        return redirect(route('admin.permission.index'))->with('sessionMessage','Permission Update Successfully');
    }



    public function create()
    {
        $permissions = Permission::all();
        return view('admin/create', ['permissions' => $permissions]);
    }


    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,NULL,id',
                'password' => 'required'
            ]);

            DB::beginTransaction();
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->email_verified_at = Carbon::now();
            $user->type = 'admin';
            $user->save();

            if ($user->save() && isset($request->permissions)) {
                foreach ($request->permissions as $item) {
                    UserPermission::create([
                        'user_id' => $user->id,
                        'permission_id' => $item
                    ]);
                }
            }
            DB::commit();
            return redirect(route('admin.index'))->with('sessionMessage', 'Admin Created Successfully');
        } catch (\Exception $ex) {
            DB::rollBack();
            $error =  $ex->getMessage();
            return redirect()->back()->with('error', $error);
        }
    }


    public function show($id)
    {
    }


    public function edit($id)
    {
        $admin = User::where('id', $id)->where('type', 'admin')->first();
        $permissions = Permission::all();
        $permission_ids = [];
        foreach ($admin->user_roles as $item) {
            array_push($permission_ids, $item->permission_id);
        }
        return view('admin/edit', compact('admin', 'permissions', 'permission_ids'));
    }


    public function update(Request $request, $id)
    {
        $admin =  User::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        if (isset($request->password) && !empty($request->password)) {
            $admin->password = Hash::make($request->password);
        }
        $admin->save();

        foreach ($admin->user_roles as $item) {
            $user_per = UserPermission::find($item->id);
            $user_per->delete();
        }

        if ($admin->save() && isset($request->permissions)) {
            foreach ($request->permissions as $item) {
                UserPermission::create([
                    'user_id' => $id,
                    'permission_id' => $item
                ]);
            }
        }

        return redirect(route('admin.index'))->with('sessionMessage', 'Admin Updated Successfully');
    }

    public function delete($id)
    {
        $admin = User::find($id);
        $admin->email = null;
        $admin->save();
        $admin->delete();
        return redirect(route('admin.index'))->with('sessionMessage', 'Admin Deleted Successfully');
    }
    
    public function editprofile()
    {
        $admin_id = auth()->user()->id;
        $admin = User::find($admin_id);
        return view('admin.showprofile', compact('admin'));
    }
    public function updateprofile(Request $request)
    {
        $admin_id = auth()->user()->id;
        $admin =  User::find($admin_id);
        $admin->name = $request->name;
        if (isset($request->password) && !empty($request->password)) {
            $admin->password = Hash::make($request->password);
        }
        $admin->update();

        return redirect()->back()->with('sessionMessage', 'Profile updated Successfully');   
    }

    public function forgetPassword(Request $request)
    {
        return view('auth.passwords.forget-password');
    }
    public function submitForgePasswordEmail(Request $request)
    {
        $request->validate([
            'email'=> 'required|email|exists:users,email'
        ]);
        $check_email = DB::table('users')->where([
            'email'=>$request->email,
        ])->first();

        if(!$check_email){
            return redirect()->back()->with('error','Email doest not match');
        }
        else {
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $check_email->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);
        $action_link = route('reset_password', ['token' => $token, 'email' => $check_email->email]);
        $body = "We have received a request to reset password regard this email <u> " . $check_email->email .
            "</u>.You can reset your password by clicking the link below";

        $data['action_link'] = $action_link;
        $data['body'] = $body;
        $data['from'] = $check_email->email;
        $data['to'] = 'noreply@gmail.com';

            Mail::send('auth.passwords.email-reset', $data,  function ($message) use ($check_email) {
                $message->from('noreply@gmail.com', 'Hole Master');
                $message->to($check_email->email)
                    ->subject('Reset Password');
            });
        }
        return redirect()->route('login')
                    ->with('sessionMessage', 'Reset Email Sent  Successfully');
    }
}
