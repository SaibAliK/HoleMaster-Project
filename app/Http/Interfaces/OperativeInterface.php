<?php 

namespace App\Http\Interfaces;

use App\Http\Requests\StoreOperativeRequest;
use Illuminate\Http\JsonResponse;

interface OperativeInterface {
    
    public function index();
    public function create();
    public function store(StoreOperativeRequest $request);
    public function edit(int $id);
    public function update(int $id,StoreOperativeRequest $request);
    public function delete(int $id);
    // public function reset_password(Request $request,$token);
    // public function new_password(Request $request){;


}