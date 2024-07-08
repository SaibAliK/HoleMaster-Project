<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStageRequest;
use App\Models\Stages;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route as FacadesRoute;


class StagesController extends Controller
{
    protected Stages $stages;

    public function __construct(Stages $stages)
    {
        $this->stages = $stages;
        $route = FacadesRoute::current();
        $action = class_basename($route->getActionName());
        $controller = substr($action, 0, strpos($action, '@'));
        $this->middleware("manage_permission:$controller");
    }
    public function index()
    {
        $stages = $this->stages->all();
        return view("stage.index", compact('stages'));
    }
    public function create()
    {
        return view("stage.create");
    }
    public function store(StoreStageRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->stages->name = $request->name;
            $this->stages->save();

            DB::commit();
            return redirect()->route('stage.index')
                ->with('sessionMessage', 'Stage Created Successfully');

            DB::rollBack();
            return redirect()->back()->with('error', 'Try Again');
        } catch (\Exception $ex) {
            DB::rollBack();
            $error =  $ex->getMessage();
            return redirect()->back()->with('success', $error);
        }
    }
    public function edit(int $id)
    {
        $stage = Stages::where('id', $id)->first();
        return view('stage.edit', compact('stage'));
    }
    public function update(int $id, StoreStageRequest $request)
    {
        $stages =  $this->stages->find($id);
        $stages->name = $request->name;
        $stages->update();

        return redirect()->route('stage.index')
            ->with('sessionMessage', 'Stage Updated Successfully');
    }

    public function delete(int $id)
    {
        $stages = $this->stages->find($id);
        $stages->delete();
        return redirect()->route('stage.index')
            ->with('sessionMessage', 'Stage Deleted Successfully');
    }
}
