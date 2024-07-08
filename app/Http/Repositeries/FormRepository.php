<?php

namespace App\Http\Repositeries;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\FormInterface;
use App\Http\Requests\StoreFormRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Models\{
    Client,
    Form,
    JobDetail,
    Question,
    QuestionOption,
    Section,
    Stages,
    User
};

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FormRepository extends Controller implements FormInterface
{

    protected Form $form;
    protected User $user;
    protected Client $client;
    protected Section $section;
    protected Question $questions;
    protected QuestionOption $options;
    protected Stages $stages;

    public function __construct(Stages $stages, Form $form, User $user, Section $section, QuestionOption $options, Question $questions)
    {
        $this->form = $form;
        $this->user  = $user;
        $this->section = $section;
        $this->questions = $questions;
        $this->options = $options;
        $this->stages = $stages;
    }

    public function index()
    {
        $forms = $this->form::all();
        $stages = Stages::orderBy('id', 'asc')->with('forms')->whereHas('forms')->get();
        return view('form.index', compact('forms', 'stages'));
    }

    public function create()
    {
        $stages = $this->stages::all();
        return view('form.create', compact('stages'));
    }

    public function store(StoreFormRequest $request)
    {
        // dd($request->all());
        try {
            $this->form->form_name = $request->form_name;
            // $this->form->thread = $request->thread;
            $this->form->category = $request->category;
            // $this->form->seen_by = $request->seen_by;
            $this->form->stage_id = $request->stage;
            $this->form->save();
            return redirect()->route('section.create', [$this->form->id]);
        } catch (\Exception $ex) {
            $error =  $ex->getMessage();
            return redirect()->back()->with('error', $error);
        }
    }

    public function edit(int $id)
    {
        $form = $this->form->find($id);
        // dd($form);
        $stages = $this->stages::all();
        return view('form.edit', compact('form', 'stages'));
    }

    public function update(int $id, StoreFormRequest $request)
    {
        try {
            
            // dd($request->all());
            $form = $this->form->find($id);
            $form->form_name = $request->form_name;
            $form->category = $request->category;
            $form->stage_id = $request->stage;
            $form->update();


            $section = $this->section->where('form_id', $id)->get();
            foreach ($section as $item) {
                $item->delete();
            }

            foreach ($request->sections as $item) {
                $section = new Section();
                $section->section_name = $item['name'];
                $section->form_id = $id;
                $section->save();

                if ($item['question']) {
                    foreach ($item['question'] as $ques) {
                        $question = new Question();
                        $question->question = $ques['name'];
                        $question->type = $ques['type'];
                        $question->precaution = $ques['precaution'];
                        if (isset($ques['is_required']) ) {
                            $question->is_required = 'true';
                        } else {
                            $question->is_required = 'false';
                        }
                        $question->section_id = $section->id;
                        $question->save();

                        if (isset($ques['option'])) {
                            foreach ($ques['option'] as $opt) {
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
            return redirect()->route('form.index', [$id])
                ->with('sessionMessage', 'Form Updated Successfully');
        } catch (\Exception $ex) {
            DB::rollBack();
            $error =  $ex->getMessage();
            return redirect()->back()->with('error', $error);
        }
    }

    public function delete(int $id)
    {
        $form = $this->form->find($id);
        foreach ($form->sections as $item) {
            $item->delete();
        }
        $form->delete();
        return redirect()->route('form.index')
            ->with('sessionMessage', 'Form Deleted Successfully');
    }

    public function getForm($id)
    {
        $form = $this->form->where('id', $id)->with('sections')->get();
        return $form;
    }

    public function sectionCreate($id)
    {
        $form_id  = $id;

        return view('section.create', compact('form_id'));
    }

    public function dublicate($id)
    {
        try {
            $form_old = $this->form->find($id);
            $form = new Form();
            $form->form_name = $form_old->form_name;
            $form->category = $form_old->category;
            // $form->seen_by = $form_old->seen_by;
            $form->stage_id = $form_old->stage_id;
            $form->save();

            foreach ($form_old->sections as $section) {
                $section_new = new Section();
                $section_new->section_name = $section->section_name;
                $section_new->form_id = $form->id;
                $section_new->save();

                if ($section->questions) {
                    foreach ($section->questions as $question) {
                        $question_new = new Question();
                        $question_new->question = $question->question;
                        $question_new->type = $question->type;
                        $question_new->precaution = $question->precaution;
                        $question_new->is_required = $question->is_required;
                        $question_new->section_id = $section_new->id;
                        $question_new->save();

                        if (isset($question->options)) {
                            foreach ($question->options as $option) {
                                $option_new = new QuestionOption();
                                $option_new->question_option = $option->question_option;
                                $option_new->question_id = $question_new->id;
                                $option_new->save();
                            }
                        }
                    }
                }
            }

            DB::commit();
            return redirect()->route('form.edit', [$form->id])
                ->with('sessionMessage', 'Form template created successfully');
        } catch (\Exception $ex) {
            DB::rollBack();
            $error =  $ex->getMessage();
            dd($error);
            return redirect()->back()->with('error', $error);
        }
    }
}
