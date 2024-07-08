<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFormRequest;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Services\FormService;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\Stages;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route as FacadesRoute;


class FormController extends Controller
{
    protected FormService $formService;

    public function __construct(FormService $formService)
    {
        $this->formService = $formService;
        $route = FacadesRoute::current();
        $action = class_basename($route->getActionName());
        $controller = substr($action, 0, strpos($action, '@'));
        $this->middleware("manage_permission:$controller");
    }

    public function index()
    {
        return $this->formService->index();
    }
    public function create()
    {
        return $this->formService->create();
    }

    public function store(StoreFormRequest $request)
    {
        return $this->formService->store($request);
    }

    public function edit(int $id)
    {
        return $this->formService->edit($id);
    }

    public function update(int $id, StoreFormRequest $request)
    {
        return $this->formService->update($id, $request);
    }

    public function delete($id)
    {
        return $this->formService->delete($id);
    }

    public function dublicate($id)
    {
        return $this->formService->dublicate($id);
    }

    public function sectionCreate($id)
    {
        $form_id  = $id;
        $form =  $this->formService->getForm($id);
        return view('section.create', compact('form_id', 'form'));
    }
    public function sectionSave(Request $request)
    {
        try {
            // dd($request->all());
            $section_id = '';
            $section = Section::where('form_id', $request['form_id'])->get();
            foreach ($section as $item) {
                $item->delete();
            }

            foreach ($request->sections as $key => $value) {
                if ($key == "new") {
                    $section = new Section();
                    $section->section_name = $value['name'];
                    $section->form_id = $request->form_id;
                    $section->save();
                    $section_id = $section->id;

                    $question = Question::create([
                        'question' => $value['question']['new']['name'],
                        'type' => $value['question']['new']['type'],
                        'precaution' => $value['question']['new']['precaution'],
                        'section_id' =>  $section->id,
                        'is_required' =>  isset($value['question']['new']['is_required']) ? 'true' : 'false',
                    ]);

                    if (isset($value['question']['new']['option']['value'])) {
                        foreach ($value['question']['new']['option']['value'] as $opt) {
                            if ($opt != null) {
                                $option = new QuestionOption();
                                $option->question_option = $opt;
                                $option->question_id = $question->id;
                                $option->save();
                            }
                        }
                    }
                } else {
                    $section = new Section();
                    $section->section_name = $value['name'];
                    $section->form_id = $request->form_id;
                    $section->save();
                    $section_id = $section->id;

                    if ($value['question']) {
                        foreach ($value['question'] as $ques) {
                            $question = new Question();
                            $question->question = $ques['name'];
                            $question->type = $ques['type'];
                            $question->precaution = $ques['precaution'];
                            if (isset($ques['is_required'])) {
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
            }
            DB::commit();
            if ($request['add_question'] == 'add_question') {
                return redirect()->route('section.addQuestion', $section_id);
            }

            if ($request['add_section'] == 'add_section') {
                $form_id  = $request->form_id;
                return view('section.create', compact('form_id'));
            }

            if ($request['section_save'] == 'section_save') {
                return redirect()->route('form.index')
                    ->with('sessionMessage', 'Form Created Successfully');
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            $error =  $ex->getMessage();
            return redirect()->back()->with('error', $error);
        }
    }

    public function sectionaddQuestion($id)
    {
        $section = Section::find($id);
        if ($section) {
            $form_id = $section->form_id;
            $form = Form::find($form_id);
            $stages = Stages::all();
            return view('section.create', compact('section', 'form_id', 'form', 'stages'));
        } else {
            return redirect()->back();
        }
    }
}
