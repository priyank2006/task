@extends('layouts.master')

@section('title', 'Home')

@section('main')

    {{-- Include Tasks JS FIle --}}

    @include('modules.tasks.js')

    {{-- Header & Btn Part --}}

    <div class="row">
        <div class="col">
            {{-- Create Task Button --}}
            <button data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-primary"> <i
                    class="fa-solid fa-plus"></i> Add New Task </button>
        </div>
    </div>

    {{-- Main Card Section --}}

    <div class="row my-2">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    {{-- Main Accordion Which Will Hold Tasks --}}
                    <div class="accordion tasksAccordion" id="accordionExample">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Create New Task Modal -->
    <div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form name="createTaskForm" onsubmit="return handleTaskCreation(event)">
            @csrf
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">
                            Create New Task
                        </h1>
                        <button data-bs-dismiss="modal" aria-label="Close" type="button"
                            class="btn btn-close btn-primary rounded-pill"> <i class="fa-solid fa-circle-xmark"></i>
                        </button>
                        <button type="submit" class="btn btn-primary rounded-pill"> <i
                                class="fa-solid fa-circle-check"></i> </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-floating">
                                    <input required min="1" max="255" name="taskName" type="text" class="form-control">
                                    <label for=""> Task Name </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
