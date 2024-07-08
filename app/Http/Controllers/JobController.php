<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobRequest;
use App\Http\Services\JobService;
use App\Models\Client;
use App\Models\Site;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route as FacadesRoute;

class JobController extends Controller
{
    protected JobService $jobService;

    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
        $route = FacadesRoute::current();
        $action = class_basename($route->getActionName());
        $controller = substr($action, 0, strpos($action, '@'));
        $this->middleware("manage_permission:$controller");
    }

    public function index()
    {
        return $this->jobService->index();
    }
    public function create()
    {
        return $this->jobService->create();
    }

    public function store(StoreJobRequest $request)
    {
        $user = Auth::user();
        return $this->jobService->store($request, $user);
    }

    public function edit(int $id)
    {
        return $this->jobService->edit($id);
    }

    public function show(int $id)
    {
        return $this->jobService->show($id);
    }

    public function update(int $id, StoreJobRequest $request)
    {
        return $this->jobService->update($id, $request);
    }

    public function delete($id)
    {
        return $this->jobService->delete($id);
    }

    public function clientSites($id)
    {
        return $this->jobService->clientSites($id);
    }

    public function depotResourse($id)
    {
        return $this->jobService->depotResourse($id);
    }
}
