<?php

namespace App\Http\Services;

use App\Http\Interfaces\JobInterface;
use App\Http\Repositeries\JobRepository;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\StoreJobRequest;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class JobService implements JobInterface
{
    protected JobRepository $jobRepository;

    public function __construct(JobRepository $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }
 
    public function index()
    {
        return $this->jobRepository->index();
    }

    public function create(){
        return $this->jobRepository->create();
    }

    public function store(StoreJobRequest $request , User $user){
        return $this->jobRepository->store($request , $user);
    }
    public function edit(int $id){
        return $this->jobRepository->edit($id);
    }
    public function show(int $id){
        return $this->jobRepository->show($id);
    }

    public function update(int $id,StoreJobRequest $request){
        return $this->jobRepository->update($id,$request);
    }

    public function delete(int $id){
        return $this->jobRepository->delete($id);

    }

    public function clientSites($id)
    {
        return $this->jobRepository->clientSites($id);
    }

    public function depotResourse($id)
    {
        return $this->jobRepository->depotResourse($id);
    }


}