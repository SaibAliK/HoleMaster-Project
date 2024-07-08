<?php

namespace App\Http\Services\Api;

use App\Http\Interfaces\Api\JobInterface;
use App\Http\Interfaces\Api\UserInterface;
use App\Http\Repositeries\Api\JobRepository;
use App\Http\Repositeries\Api\UserRepository;
use App\Http\Requests\Api\LoginRequest;
use App\Models\Form;
use App\Models\JobDetail;

class JobService implements JobInterface
{

    protected JobRepository $jobRepository;
    public function __construct(JobRepository $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }
    public function get_job()
    {

        return $this->jobRepository->get_job();
    }


    public function get_job_detail($id)
    {
        return $this->jobRepository->get_job_detail($id);
    }

    public function get_forms($jobDetail, $form)
    {
        return $this->jobRepository->get_forms($jobDetail, $form);
    }

    public function make_form_locked($request)
    {
        return $this->jobRepository->make_form_locked($request);
    }


    public function get_jobs_by_operative()
    {

        return $this->jobRepository->get_jobs_by_operative();
    }

    public function uploadImage($request)
    {
        return $this->jobRepository->uploadImage($request);
    }
}
