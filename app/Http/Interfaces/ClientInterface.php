<?php 

namespace App\Http\Interfaces;

use App\Http\Requests\StoreClientRequest;
use Illuminate\Http\JsonResponse;

interface ClientInterface {
    
    public function index();
    public function create();
    public function store(StoreClientRequest $request);
    public function edit(int $id);
    public function update(int $id,StoreClientRequest $request);
    public function delete(int $id);


}