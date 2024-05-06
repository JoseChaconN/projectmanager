<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Facades\LogBatch;
use Spatie\Activitylog\Models\Activity;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['data'] = Stage::with('projects')->get();
        return view('stage.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['data'] = new Stage();
        $data['projects_stage'] = $data['data']->projects;
        $data['projects'] = Project::all();
        return view('stage.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required'
        ]);
        try {
            DB::transaction(function () use ($request,&$id) {
                $stage = Stage::create([
                    'name' => $request->input('name'),
                    'user_id' => Auth::user()->id,
                    'description' => $request->input('description')
                ]);
                $id = $stage->id;
                $projectIds = $request->input('project_ids', []);
                $stage->projects()->sync($projectIds);
                /*if(!empty($request->input('projects'))){
                    $stageIds = $request->input('stage_ids', []);
                    // Sincronizar las relaciones en la tabla pivote
                    //$project->stages()->sync($stageIds);
                }*/
            });
            return redirect()->route('stage.edit',$id)
            ->with('notification_type', 'success')
            ->with('notification_message', 'Etapa creada correctamente!');
        } catch (\Exception $e) {
            return redirect()->route('stage.create')->with('notification_type', 'danger')->with('notification_message', 'Error al crear la Etapa: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Stage $stage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stage $stage)
    {
        //
        $data['data'] = $stage;
        $data['projects_stage'] = $stage->projects;
        $data['projects'] = Project::all();
        return view('stage.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stage $stage)
    {
        //
        $request->validate([
            'name' => 'required'
        ]);
        try {
            DB::transaction(function () use ($request,&$stage) {
                $old_data = $stage->getOriginal();
                $stage->update([
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                ]);
                $projectIds = $request->input('project_ids', []);
                $stage->projects()->sync($projectIds);
                activity()
                    ->performedOn($stage)
                    ->withProperties(['old_data' => $old_data, 'new_data' => $stage])
                    ->causedBy(Auth::user())
                    ->event('update')
                    ->log('update stage');
            });
            return redirect()->route('stage.edit',$stage->id)
            ->with('notification_type', 'success')
            ->with('notification_message', '¡Etapa actualizada correctamente!');
        } catch (\Exception $e) {
            return redirect()->route('stage.edit',$stage->id)->with('notification_type', 'danger')->with('notification_message', 'Error al actualizar la etapa: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stage $stage)
    {
        try {
            DB::transaction(function () use (&$stage) { 
                $data = Stage::find($stage->id);
                $data->delete();
            });            
            activity()
            ->performedOn($stage)
            ->causedBy(Auth::user())
            ->event('delete')
            ->log('delete stage');
            return redirect()->route('stage.index')
            ->with('notification_type', 'success')
            ->with('notification_message', '¡Etapa eliminada correctamente!');
            //return response()->json(['success' => TRUE,'message' => '¡Proyecto eliminado con éxito!']);
        } catch (\Exception $e) {
            return redirect()->route('stage.index')->with('notification_type', 'danger')->with('notification_message', 'Error al eliminar la etapa: ' . $e->getMessage());
            //return response()->json(['success' => FALSE,'message' => '¡Error al eliminar el proyecto!'.$e->getMessage()]);               
        }
    }
}
