<?php

namespace App\Http\Repositeries\Api;

use App\Enums\ConstantsEnums;
use App\Http\Controllers\ApiController;
use App\Http\Interfaces\Api;
use App\Http\Interfaces\Api\JobInterface;
use App\Http\Interfaces\Api\UserInterface;
use App\Http\Requests\Api\LoginRequest;
use App\Models\Form;
use App\Models\JobDetail;
use App\Models\JobDetailForm;
use App\Models\SaveResponse;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JobRepository extends ApiController implements JobInterface
{
    protected JobDetail $jobDetail;

    public function __construct(JobDetail $jobDetail)
    {
        $this->jobDetail = $jobDetail;
    }

    public function get_job()
    {
        try {
            // userOperative','forms'
            $jobs = JobDetail::where('operative_id', Auth()->user()->id)->with(['userClient', 'userOperative', 'jobDetailForms'])->get();
            return self::successResponse($jobs, "Get Job", "JOB", TRUE, 200);
        } catch (Exception $ex) {
            return self::errorResponse($ex->getMessage(), 400, [], "LOGIN", FALSE);
        }
    }

    public function get_job_detail($id)
    {
        try {
            $jobs = JobDetail::where('id', $id)->with(['userClient', 'userOperative', 'jobDetailForms'])->first();
            if ($jobs) {
                return self::successResponse($jobs, "Get Job Detail", "JOB_DETAIL", TRUE, 200);
            } else {
                return self::errorResponse('Record Not Found', 400, [], "JOB_DETAIL", FALSE);
            }
        } catch (Exception $ex) {
            return self::errorResponse($ex->getMessage(), 400, [], "JOB_DETAIL", FALSE);
        }
    }

    public function get_forms($jobDetail, $form)
    {
        try {
            $jobs = JobDetailForm::where('job_detail_id', $jobDetail->id)->where('form_id', $form->id)->select('id', 'status', 'job_detail_id', 'form_id')->with(['forms:id,form_name,category,seen_by,is_locked,stage'])->first();
            if ($jobs) {
                return self::successResponse($jobs, "Get Form", "GET_FORM", TRUE, 200);
            } else {
                return self::errorResponse('Record Not Found', 400, [], "GET_FORM", FALSE);
            }
        } catch (Exception $ex) {
            return self::errorResponse($ex->getMessage(), 400, [], "GET_FORM", FALSE);
        }
    }

    public function make_form_locked($request)
    {
        try {
            if (count($request['question']) > 0) {
                $jobDetailForm = JobDetailForm::where('job_detail_id', $request['job_detail_id'])->where('form_id', $request['form_id'])->first();

                foreach ($request['question'] as $item) {
                    SaveResponse::create([
                        'job_detail_id' => $request['job_detail_id'],
                        'job_form_id'=> $jobDetailForm->id ?? null,
                        'form_id' => $request['form_id'],
                        'section_id' => $item['section_id'],
                        'question_id' => $item['question_id'],
                        'question_type' => $item['question_type'] ?? '',
                        'answer' => $item['answer'] ?? '',
                        'option' => json_encode($item['option']) ?? '',
                    ]);
                }

                $nextJobDetailForm = JobDetailForm::where('is_locked', 'Yes')->where('status', 'incomplete')->where('job_detail_id', $request['job_detail_id'])->first();
                if (isset($nextJobDetailForm)) {
                    $nextJobDetailForm->is_locked = "No";
                    $nextJobDetailForm->update();
                }

                $jobDetailForm->status = "complete";
                $jobDetailForm->is_locked = "Yes";
                $jobDetailForm->update();


                return self::successResponse([], "Form Submit Successfully", "FORM_LOCKED", TRUE, 200);
            } else {
                return self::errorResponse('Record Not Found', 400, [], "FORM_LOCKED", FALSE);
            }
        } catch (Exception $ex) {
            return self::errorResponse($ex->getMessage(), 400, [], "FORM_LOCKED", FALSE);
        }
    }

    public function get_jobs_by_operative()
    {
        try {
            $login_user_id = Auth()->user()->id;
            $job_by_operative = JobDetail::where('operative_id', '=', $login_user_id)->with(['userClient', 'userOperative'])->get();
            return self::successResponse($job_by_operative, "Job Listing", "JOB_LISTING", TRUE, 200);
        } catch (Exception $ex) {
            return self::errorResponse($ex->getMessage(), 400, [], "JOB_LISTING", FALSE);
        }
    }
    public function uploadImage($request)
    {
        try {
            $validator = Validator::make(
                [
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ],
                [
                    'image.image' => 'The type of the uploaded file should be an image.',
                    'image.max' => 'Failed to upload an image. The image maximum size is 2MB.',
                ]
            );

            if ($validator->fails()) {
                return $this->responseApi([], false, $validator->messages()->all(), 417, 'UPLOAD_IMAGE');
            }
            if ($request->has('image')) {
                // $image = base64_encode(file_get_contents($request->file('image')));
                $image = $request->file('image');

                $file_name = strtolower($image->getClientOriginalName());
                $file_name = explode('.', $file_name)[0];
                $file_name = str_replace(' ', '-', $file_name);
                $filename = $file_name . '-' . time() . rand(0, 9999) . '.' . $image->getClientOriginalExtension();
                if ($image->move(public_path() . '/uploads/', $filename)) {
                    $image_url = 'public/uploads/' . $filename;
                    $my_response = [
                        'image_path' => url($image_url),
                    ];
                    return self::successResponse($my_response, "Image uploaded successfully", "UPLOAD_IMAGE", TRUE, 200);
                }
            }
        } catch (Exception $ex) {
            return self::errorResponse($ex->getMessage(), 400, [], "UPLOAD_IMAGE", FALSE);
        }
    }
}
