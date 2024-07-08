<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\OperativeInterface;
use App\Http\Requests\StoreOperativeRequest;
use App\Http\Services\OperativeService;
use App\Models\JobDetail;
use App\Models\Operative;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route as FacadesRoute;
use function PHPUnit\Framework\isEmpty;

class OperativeController extends Controller implements OperativeInterface
{
    protected OperativeService $operativeService;
    protected JobDetail $jobDetail;
    protected Operative $operative;


    
    public function __construct(OperativeService $operativeService, JobDetail $jobDetail , Operative $operative)
    {   
        $this->operativeService = $operativeService;
        $this->jobDetail = $jobDetail;
        $this->operative = $operative;
        $route = FacadesRoute::current();
        $action = class_basename($route->getActionName());
        $controller = substr($action, 0, strpos($action, '@'));
        $this->middleware("manage_permission:$controller")->except('new_password','reset_password','operativeDetail','showJobDetails','operativeDetailUpdate','operativeDetailEdit');
    }
    
    public function index(){
        return $this->operativeService->index();
    }
    public function create(){
        return $this->operativeService->create();
    }

    public function store(StoreOperativeRequest $request){
        return $this->operativeService->store($request);
    }

    public function edit(int $id){
        return $this->operativeService->edit($id);
    }

    public function update(int $id,StoreOperativeRequest $request){
        return $this->operativeService->update($id,$request);
    }
    
    public function delete($id){
        return $this->operativeService->delete($id);
    }
    public function resetemail($id){
        return $this->operativeService->resetemail($id);
    }
    public function reset_password(Request $request,$token = null){
        
        return view('auth.passwords.reset-password')->with(['token'=>$token,'email'=>$request->email]);
    }
    public function new_password(Request $request){
        $request->validate([
            'email'=>'required|email:exists,users|email',
            'password'=>'required|min:6|regex: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'confirm_password'=>'required|same:password'
        ]);
        

        $check_token = DB::table('password_resets')->where([
            'email'=>$request->email,
            'token'=>$request->token,
        ])->first();
        
        if(!$check_token){
            return redirect()->back()->withErrors('error','Token doest not match');
        }
        User::where('email',$request->email)->update([
            'password'=>Hash::make($request->password)
        ]);

        DB::table('password_resets')->where([
            'email'=>$request->email
        ])->delete();

        return  redirect()->route('login')->with('message','Your Password change successfully');
    }

    public function operativeDetail($id){
        $jobs = JobDetail::where('operative_id',$id)->with(['userClient','userOperative'])->get();
            return view('operative.details', compact('jobs'));
    }

    public function operativeDetailEdit(int $id){
        return $this->operativeService->operativeDetailEdit($id);
    }

    public function operativeDetailUpdate(int $id,StoreOperativeRequest $request)
    {
        return $this->operativeService->operativeDetailUpdate($id,$request);
    }
    
    public function showJobDetails(int $id)
    {
        return $this->operativeService->showJobDetails($id);
    }
}
