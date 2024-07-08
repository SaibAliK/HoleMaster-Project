<?php 

namespace App\Http\Interfaces;

use App\Http\Requests\StoreJobRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

interface JobInterface {
    
    public function index();
    public function create();
    public function store(StoreJobRequest $request, User $user);
    public function edit(int $id);
    public function show(int $id);
    public function update(int $id,StoreJobRequest $request);
    public function delete(int $id);
    public function clientSites(int $id);


}