<?php

namespace App\Http\Controllers;

use App\Models\Activity as AppActivity;
use App\Models\Project;
use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Facades\LogBatch;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //
        $data['data'] = AppActivity::all();
        return view('activity.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['data'] = new AppActivity();
        $data['projects_activity'] = $data['data']->projects;
        $data['stages_activity'] = $data['data']->stages;
        $data['projects'] = Project::all();
        $data['stages'] = Stage::all();
        return view('activity.form',$data);
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
                $activity = AppActivity::create([
                    'name' => $request->input('name'),
                    'user_id' => Auth::user()->id,
                    'description' => $request->input('description')
                ]);
                $id = $activity->id;
                $projectIds = $request->input('project_ids', []);
                $stageIds = $request->input('stage_ids', []);
                $activity->projects()->sync($projectIds);
                $activity->stages()->sync($stageIds);
                /*if(!empty($request->input('projects'))){
                    $stageIds = $request->input('stage_ids', []);
                    // Sincronizar las relaciones en la tabla pivote
                    //$project->stages()->sync($stageIds);
                }*/
            });
            return redirect()->route('activity.edit',$id)
            ->with('notification_type', 'success')
            ->with('notification_message', 'Etapa creada correctamente!');
        } catch (\Exception $e) {
            return redirect()->route('activity.create')->with('notification_type', 'danger')->with('notification_message', 'Error al crear la Etapa: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AppActivity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AppActivity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AppActivity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AppActivity $activity)
    {
        //
    }
}
