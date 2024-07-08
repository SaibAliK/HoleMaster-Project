<?php

namespace App\Http\Interfaces\Api;

use App\Models\Form;
use App\Models\JobDetail;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;

interface JobInterface{
    public function get_job();
    public function get_job_detail($id);
    public function get_forms(JobDetail $jobDetail, Form $form);
    public function make_form_locked(HttpRequest $request);
    public function get_jobs_by_operative();
}