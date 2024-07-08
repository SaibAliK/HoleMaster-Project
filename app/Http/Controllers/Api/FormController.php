<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Section;
use App\Models\Stages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class FormController extends ApiController
{

    protected Form $form;
    protected User $user;
    protected Section $section;
    protected Question $questions;
    protected QuestionOption $options;

    public function __construct(Form $form, User $user, Section $section, QuestionOption $options, Question $questions)
    {
        $this->form = $form;
        $this->user  = $user;
        $this->section = $section;
        $this->questions = $questions;
        $this->options = $options;
    }

    public function Stages()
    {
        return Stages::select('id', 'name')->get();
    }

    public function getForm($id)
    {
        return Form::with('sections')->find($id);
    }

    public function formSubmit(Request $request): JsonResponse
    {
        try {
            if ($request->form_id == 0) {
                $form = new Form([
                    'form_name' => $request->form_name,
                    'category' => $request->category,
                    'stage_id' => $request->stage,
                ]);
                $form->save();
            } else {
                $form = Form::find($request->form_id);
                $form->form_name = $request->form_name;
                $form->category = $request->category;
                $form->stage_id = $request->stage;
                $form->update();

                $section = Section::where('form_id', $request->form_id)->get();
                foreach ($section as $item) {
                    $item->delete();
                }
            }

            foreach ($request->sections as $item) {
                $section = new Section();
                $section->section_name = $item['section_name'];
                $section->form_id = $form->id;
                $section->save();

                if ($item['questions']) {
                    foreach ($item['questions'] as $ques) {
                        $question = new Question();
                        $question->question = $ques['ques'];
                        $question->type = $ques['question_type'];
                        $question->precaution = $ques['precaution'];
                        if (isset($ques['is_requred'])) {
                            $question->is_required = 'true';
                        } else {
                            $question->is_required = 'false';
                        }
                        $question->section_id = $section->id;
                        $question->save();

                        if (isset($ques['options'])) {
                            foreach ($ques['options'] as $opt) {
                                if ($opt['value'] != null) {
                                    $option = new QuestionOption();
                                    $option->question_option = $opt['value'];
                                    $option->question_id = $question->id;
                                    $option->save();
                                }
                            }
                        }
                    }
                }
            }
            DB::commit();
            return self::successResponse('Form', "Login Successfully", "Form Submit", TRUE, 200);
        } catch (\Exception $ex) {
            DB::rollBack();
            return self::errorResponse($ex->getMessage(), 400, [], "Form Submit", FALSE);
        }
    }
}
