<?php

namespace App\Http\Controllers;

use App\Models\SubTask;
use Exception;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (request()->expectsJson()) {
            $data = Task::with([
                'subTasks' => function ($query) {
                    $query->orderBy('offset', 'ASC'); // Replace 'name' with the column you want to sort by
                }
            ])->get();


            return response()->json(['data' => $data]);
        }

        // Redirecting Users to this main view file

        return view('welcome');
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
        $validated = $request->validate([
            'taskName' => 'required|string|max:255',
        ]);

        try {

            // Create The Task

            Task::create($validated);


        } catch (Exception $e) {

            return response()->json(['error' => $e->getMessage()]);

        }

        return response()->json([
            'status' => 200,
        ]);

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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
