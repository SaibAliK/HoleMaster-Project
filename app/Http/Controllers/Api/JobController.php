<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Api\JobInterface;
use App\Http\Requests\ImageRequest;
use App\Http\Services\Api\JobService;
use App\Models\Form;
use Illuminate\Http\Request;
use App\Models\JobDetail;

class JobController extends Controller implements JobInterface
{

    protected JobService $jobService;
    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }

    public function get_job()
    {
        return $this->jobService->get_job();
    }

    public function get_forms(JobDetail $jobDetail, Form $form)
    {
        return $this->jobService->get_forms($jobDetail, $form);
    }

    public function make_form_locked(Request $request)
    {
        return $this->jobService->make_form_locked($request->all());
    }

    public function get_job_detail($id)
    {
        return $this->jobService->get_job_detail($id);
    }

    public function get_jobs_by_operative()
    {
        return $this->jobService->get_jobs_by_operative();
    }
    public function uploadImage(ImageRequest $request)
    {
        return $this->jobService->uploadImage($request);
    }
}
