<?php

namespace App\Http\Services;

use App\Http\Interfaces\ClientInterface;
use App\Http\Interfaces\FormInterface;
use App\Http\Repositeries\FormRepository;
use App\Http\Requests\StoreClientRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class FormService implements FormInterface
{
    protected FormRepository $formRepository;

    public function __construct(FormRepository $formRepository)
    {
        $this->formRepository = $formRepository;
    }
 
    public function index()
    {
        return $this->formRepository->index();
    }

    public function getForm($id)
    {
        return $this->formRepository->getForm($id);
    }

    public function create(){
        return $this->formRepository->create();
    }

    public function store(FormRequest $request){
        return $this->formRepository->store($request);
    }
    public function edit(int $id){
        return $this->formRepository->edit($id);
    }

    public function update(int $id,FormRequest $request){
        return $this->formRepository->update($id,$request);
    }

    public function delete(int $id){
        return $this->formRepository->delete($id);
    }
    public function sectionCreate($id){
        return $this->formRepository->sectionCreate($id);
    }


    public function dublicate($id)
    {
        return $this->formRepository->dublicate($id);
    }

    

}