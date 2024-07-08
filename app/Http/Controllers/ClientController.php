<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Interfaces\ClientInterface;
use App\Http\Requests\StoreClientRequest;
use App\Http\Services\ClientService;
use Illuminate\Support\Facades\Route as FacadesRoute;

class ClientController extends Controller implements ClientInterface
{

    protected ClientService $clientService;

    public function __construct(ClientService $clientService)
    {   
        $this->clientService = $clientService;
        $route = FacadesRoute::current();
        $action = class_basename($route->getActionName());
        $controller = substr($action, 0, strpos($action, '@'));
        $this->middleware("manage_permission:$controller");
    }
    
    public function index(){
        return $this->clientService->index();
    }
    public function create(){
        return $this->clientService->create();
    }

    public function store(StoreClientRequest $request){
        return $this->clientService->store($request);
    }

    public function edit(int $id){
        return $this->clientService->edit($id);
    }

    public function update(int $id,StoreClientRequest $request){
        return $this->clientService->update($id,$request);
    }

    public function delete($id){
        return $this->clientService->delete($id);
    }
}
