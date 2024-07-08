<?php

namespace App\Http\Services;

use App\Http\Interfaces\OperativeInterface;
use App\Http\Repositeries\OperativeRepository;
use App\Http\Requests\StoreOperativeRequest;

class OperativeService implements OperativeInterface
{
    protected OperativeRepository $operativeRepository;

    public function __construct(OperativeRepository $operativeRepository)
    {
        $this->operativeRepository = $operativeRepository;
    }
 
    public function index()
    {
        return $this->operativeRepository->index();
    }

    public function create(){
        return $this->operativeRepository->create();
    }

    public function store(StoreOperativeRequest $request){
        return $this->operativeRepository->store($request);
    }
    public function edit(int $id){
        return $this->operativeRepository->edit($id);
    }

    public function update(int $id,StoreOperativeRequest $request){
        return $this->operativeRepository->update($id,$request);
    }

    public function delete(int $id){
        return $this->operativeRepository->delete($id);

    }
    public function resetemail(int $id){
        return $this->operativeRepository->resetEmail($id);

    }
    public function operativeDetailEdit(int $id){
        return $this->operativeRepository->operativeDetailEdit($id);

    }
    public function operativeDetailUpdate(int $id, StoreOperativeRequest $request){
        return $this->operativeRepository->operativeDetailUpdate($id, $request);

    }
    public function showJobDetails(int $id){

        return $this->operativeRepository->showJobDetails($id);
    }


}