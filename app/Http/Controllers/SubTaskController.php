<?php

namespace App\Http\Controllers;

use App\Models\SubTask;
use Illuminate\Http\Request;

class SubTaskController extends Controller
{

    public function addTaskNote($id, Request $request)
    {
        SubTask::find($id)->update(['offset' => '', 'note' => $request["note"]]);

        return response()->json(['status' => 200]);
    }

    public function createEmptyTask($id, Request $request)
    {
        SubTask::create(['offset' => '', 'task_id' => $id, 'title' => $request["title"]]);

    }
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SubTask $subTask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubTask $subTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $formData = $request->input();
        $formData["offset"] = '';
        SubTask::find($id)->update($formData);

        return response()->json(['status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubTask $subTask)
    {
        //
    }
}
