<?php 

namespace App\Http\Interfaces;

use App\Http\Requests\StoreFormRequest;
use App\Http\Requests\StoreJobRequest;
use Illuminate\Http\JsonResponse;

interface FormInterface {
    
    public function index();
    public function create();
    public function store(StoreFormRequest $request);
    public function edit(int $id);
    public function getForm(int $id);
    public function update(int $id,StoreFormRequest $request);
    public function delete(int $id);
    public function sectionCreate($id);
    public function dublicate($id);
    

    




}