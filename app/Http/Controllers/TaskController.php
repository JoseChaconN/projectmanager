<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        //
        $data['project'] = Project::with('tasks')->find($project->id);
        $data['property_reception'] = new Task;
        return view('task.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            DB::transaction(function () use ($request) {
                $activity_name = $request->input('activity_name');
                $activity_description = $request->input('activity_description');
                $activity_start = $request->input('activity_start');
                $activity_end = $request->input('activity_end');
                $activity_document = $request->file('activity_document');
                //dd($activity_document);
                if(!empty($activity_name)){
                    foreach ($activity_name as $key => $value) {
                        $task=Task::create([
                            'project_id' => $request->input('project_id'),
                            'name' => $activity_name[$key],
                            'description' => $activity_description[$key],
                            'start_date' => $activity_start[$key],
                            'end_date' => $activity_end[$key],
                            //'document' => $activity_document[$key],
                        ]);
                        if(!empty($activity_document[$key])){
                            if (!empty($activity_document[$key])) {
                                if ($activity_document[$key]->isValid()) {
                                    $task->addMedia($activity_document[$key])
                                    ->toMediaCollection('project-task-file');
                                }
                            }
                        }
                    }
                } 
                $activity_h = $request->input('activity_h');
                $activity_name_h = $request->input('activity_name_h');
                $activity_finished_h = $request->input('activity_finished_h');
                $activity_description_h= $request->input('activity_description_h');
                $activity_start_h= $request->input('activity_start_h');
                $activity_end_h= $request->input('activity_end_h');
                $activity_document_h= $request->file('activity_document_h');
                if(!empty($activity_h)){
                    foreach ($activity_h as $key => $value) {
                        $task_h = Task::find($value);
                        $task_h->update([
                            'name' => $activity_name_h[$key],
                            'finished' => !empty($activity_finished_h[$key]) ? $activity_finished_h[$key] : null,
                            'description' => $activity_description_h[$key],
                            'start_date' => $activity_start_h[$key],
                            'end_date' => $activity_end_h[$key],
                        ]);
                        if(!empty($activity_document_h[$key])){
                            if (!empty($activity_document_h[$key])) {
                                if ($activity_document_h[$key]->isValid()) {
                                    $task_h->addMedia($activity_document_h[$key])
                                    ->toMediaCollection('project-task-file');
                                }
                            }
                        }
                    }
                }

            });
            return redirect()->route('task.create',$request->input('project_id'))
            ->with('notification_type', 'success')
            ->with('notification_message', 'Proyecto actualizado correctamente!');
        } catch (\Exception $e) {
            return redirect()->route('task.create',$request->input('project_id'))->with('notification_type', 'danger')->with('notification_message', 'Error al actualizar el Proyecto: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
