<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Facades\LogBatch;
use Spatie\Activitylog\Models\Activity;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['data'] = Project::all();
        return view('project.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['data'] = new Project();
        return view('project.form',$data);
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
                $project = Project::create([
                    'name' => $request->input('name'),
                    'user_id' => Auth::user()->id,
                    'description' => $request->input('description')
                ]);
                $id = $project->id;
            });
            return redirect()->route('project.edit',$id)
            ->with('notification_type', 'success')
            ->with('notification_message', 'Proyecto creado correctamente!');
        } catch (\Exception $e) {
            return redirect()->route('contract.create')->with('notification_type', 'danger')->with('notification_message', 'Error al crear el Proyecto: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
        $data['project'] = Project::with('tasks')->find($project->id);
        return view('project.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
        $data['data'] = $project;
        return view('project.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
        $request->validate([
            'name' => 'required'
        ]);
        try {
            DB::transaction(function () use ($request,&$project) {
                $old_data = $project->getOriginal();
                $project->update([
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                ]);
                activity()
                    ->performedOn($project)
                    ->withProperties(['old_data' => $old_data, 'new_data' => $project])
                    ->causedBy(Auth::user())
                    ->event('update')
                    ->log('update project');
            });
            return redirect()->route('project.edit',$project->id)
            ->with('notification_type', 'success')
            ->with('notification_message', '¡Proyecto actualizado correctamente!');
        } catch (\Exception $e) {
            return redirect()->route('project.edit',$project->id)->with('notification_type', 'danger')->with('notification_message', 'Error al actualizar el proyecto: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
        try {
            DB::transaction(function () use (&$project) { 
                $data = Project::find($project->id);
                $data->delete();
            });            
            activity()
            ->performedOn($project)
            ->causedBy(Auth::user())
            ->event('delete')
            ->log('delete project');
            return redirect()->route('project.index')
            ->with('notification_type', 'success')
            ->with('notification_message', '¡Proyecto eliminado correctamente!');
            //return response()->json(['success' => TRUE,'message' => '¡Proyecto eliminado con éxito!']);
        } catch (\Exception $e) {
            return redirect()->route('project.index')->with('notification_type', 'danger')->with('notification_message', 'Error al eliminar el proyecto: ' . $e->getMessage());
            //return response()->json(['success' => FALSE,'message' => '¡Error al eliminar el proyecto!'.$e->getMessage()]);               
        }
    }
}
