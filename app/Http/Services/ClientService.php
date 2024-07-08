<?php

namespace App\Http\Services;

use App\Http\Interfaces\ClientInterface;
use App\Http\Repositeries\ClientRepository;
use App\Http\Requests\StoreClientRequest;
use Illuminate\Http\JsonResponse;

class ClientService implements ClientInterface
{
    protected ClientRepository $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }
 
    public function index()
    {
        return $this->clientRepository->index();
    }

    public function create(){
        return $this->clientRepository->create();
    }

    public function store(StoreClientRequest $request){
        return $this->clientRepository->store($request);
    }
    public function edit(int $id){
        return $this->clientRepository->edit($id);
    }

    public function update(int $id,StoreClientRequest $request){
        return $this->clientRepository->update($id,$request);
    }

    public function delete(int $id){
        return $this->clientRepository->delete($id);

    }


}