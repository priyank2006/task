<?php

namespace App\Http\Controllers;

use App\Models\SubTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubTaskController extends Controller
{

    public function updateOrder(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'rows' => 'required|array',
            'rows.*.id' => 'required|integer|exists:sub_tasks,id',
            'rows.*.index' => 'required|integer'
        ]);

        // Begin a database transaction to ensure all updates are applied atomically
        DB::beginTransaction();

        try {
            // Iterate over the rows array and update each SubTask's offset
            foreach ($validatedData['rows'] as $row) {
                SubTask::where('id', $row['id'])->update(['offset' => $row['index']]);
            }

            // Commit the transaction
            DB::commit();

            // Return a success response
            return response()->json(['status' => 200, 'message' => 'Row order updated successfully.']);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollback();

            // Return an error response
            return response()->json(['status' => 500, 'message' => 'Error updating row order.', 'error' => $e->getMessage()], 500);
        }
    }

    public function addTaskNote($id, Request $request)
    {
        SubTask::find($id)->update(['note' => $request["note"]]);

        return response()->json(['status' => 200]);
    }

    public function createEmptyTask($id, Request $request)
    {
        SubTask::create(['task_id' => $id, 'title' => $request["title"]]);

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
