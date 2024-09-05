<script>
    function addSubTaskNote(id, note = '') {
        var taskNote = prompt('Enter Your Notes :-', note);

        if (taskNote) {
            $.ajax({
                url: '/addTaskNote/' + id,
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    taskId: id,
                    note: taskNote
                },
                success: function(response) {
                    showToast('Task Note added successfully');
                    loadTasks();
                }
            });
        }

    }

    function addNewSubTaskInTask(element) {
        //     let taskTR = `
        //     <tr>
        //         <td class="text-start text-wrap">
        //             <span class="d-inline-block text-truncate" style="max-width: 400px;">
        //                 <i class="fa-solid fa-arrows-up-down-left-right"></i>
        //                 No description available
        //             </span>
        //         </td>
        //         <td class="col-2">
        //             <input data-stid="123" type="date" name="date" class="subTaskDate form-control" value="123">
        //         </td>
        //         <td class="col-2">
        //             <select data-stid="1" name="status" class="subTaskSelect select2 form-select">
        //                 <option value="0">Pending</option>
        //                 <option value="1">In Progress</option>
        //                 <option value="2">Complete</option>
        //             </select>
        //         </td>
        //         <td class="col-2 text-center">
        //             <button class="btn btn-primary rounded-pill">
        //                 <i class="fa-regular fa-note-sticky"></i>
        //             </button>
        //         </td>
        //     </tr>
        // `;

        var currTaskID = $(element).closest('table').data('tid');
        var subTaskTitle = prompt('Enter task title');

        $.ajax({
            url: '/createEmptyTask/' + currTaskID,
            type: "GET",
            data: {
                'title': subTaskTitle
            },
            success: function(response) {
                loadTasks();
            }
        });

        // Find the closest table and insert the new row before the last row
        // $(element).closest('table').find('tbody').children('tr').last().before(taskTR);
    }


    // Getting SubTasks For Task

    function getSubTasks(tasks) {

        let finalTaskTR = '';

        tasks.forEach(function(task) {
            var taskID = task.id;
            var taskNote = task.note;
            var taskTitle = task.title;
            var taskDate = task.date;
            var taskStatus = task.status;

            let taskTR = `
                <tr data-id="${task.id}" >
                    <td class="text-start text-wrap">
                        <span class="d-inline-block text-truncate" style="max-width: 400px;">
                            <i class="fa-solid fa-arrows-up-down-left-right"></i>
                            ${taskTitle || 'No description available'}
                        </span>
                    </td>
                    <td class="col-2">
                        <input data-stid="${taskID}" type="date" name="date" class="subTaskDate form-control"
                            value="${taskDate || ''}">
                    </td>
                    <td class="col-2">
                        <select data-stid="${taskID}" name="status" class="subTaskSelect select2 form-select">
                            <option value="0" ${taskStatus==0 ? 'selected' : '' }>Pending</option>
                            <option value="1" ${taskStatus==1 ? 'selected' : '' }>In Progress</option>
                            <option value="2" ${taskStatus==2 ? 'selected' : '' }>Complete</option>
                        </select>
                    </td>
                    <td class="col-2 text-center">
                        <button onclick="addSubTaskNote('${taskID}','${taskNote}')" class="btn btn-primary rounded-pill">
                            <i class="fa-regular fa-note-sticky"></i>
                        </button>
                    </td>
                </tr>
                `;

            finalTaskTR += taskTR;

        });

        return finalTaskTR;
    }


    // Function to create the structure of a task accordion item
    function accordionItem(task) {

        let subTasks = getSubTasks(task.sub_tasks);

        return `<div class="accordion-item">
    <h2 class="accordion-header d-flex align-items-center">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseTask${task.id}" aria-expanded="false" aria-controls="collapseTask${task.id}">
            ${task.taskName || 'Untitled Task'}
        </button>
    </h2>
    <div id="collapseTask${task.id}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <div class="table-responsive">
                <table data-tid="${task.id}" class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${subTasks}
                        <tr onclick="addNewSubTaskInTask(this)" style="cursor: pointer"
                            class="defaultTRtoAddNewSubTask">
                            <th colspan="4" class="bg-primary-subtle text-center">
                                <i class="fa-solid fa-plus"></i> Add New Task
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>`;
    }

    // Function to load tasks from the server
    function loadTasks() {
        $.ajax({
            url: "{{ route('tasks.index') }}",
            type: "GET",
            success: function(response) {
                var tasks = response.data;
                var accordion = $(".tasksAccordion");
                accordion.empty(); // Clear previous tasks

                tasks.forEach(function(task) {
                    accordion.append(accordionItem(task)); // Append each task
                });
            },
            error: function(err) {
                alert("Failed to load tasks.");
            }
        });
    }

    // Function to handle task creation
    function handleTaskCreation(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('tasks.store') }}",
            type: "POST",
            data: new FormData(e.target),
            contentType: false,
            processData: false,
            success: function(response) {
                // Clear the form inputs
                $('input[type="text"], input[type="date"]').val('');
                $('.select2').val(null).trigger('change');

                // Clear any previous error messages
                $('.text-danger').remove();

                showToast("Successfully Created Task");

                // Reload the tasks after successful creation
                loadTasks();
            },
            error: function(err) {
                if (err.status === 422) { // Laravel validation error status
                    var errors = err.responseJSON.errors;

                    // Clear any previous error messages
                    $('.text-danger').remove();

                    // Loop through the errors and display them next to the relevant input fields
                    $.each(errors, function(field, messages) {
                        var input = $('input[name="' + field + '"]');
                        input.after('<span class="text-danger">' + messages[0] +
                            '</span>'); // Display the first error message
                    });
                }
                if (err.status == 500) {
                    alert("An Exception has occurred");
                }
            }
        });
    }

    // Load tasks when the page loads
    $(document).ready(function() {
        loadTasks();
    });
</script>


<script>
    $(document).on("change", ".subTaskDate", function() {
        var val = $(this).val();
        var stID = $(this).data('stid');

        $.ajax({
            url: "/subTask/" + stID,
            type: "PUT",
            data: {
                "_token": "{{ csrf_token() }}",
                id: stID,
                date: val
            },
            success: function(response) {
                showToast("Successfully updated Subtask Date");
            },
            error: function(err) {
                if (err.status == 500) {
                    alert("An Exception has occurred");
                }
            }
        });
    });

    $(document).on("change", ".subTaskSelect", function() {
        var val = $(this).val();
        var stID = $(this).data('stid');

        $.ajax({
            url: "/subTask/" + stID,
            type: "PUT",
            data: {
                "_token": "{{ csrf_token() }}",
                id: stID,
                status: val
            },
            success: function(response) {
                showToast("Successfully updated Subtask Status");
            },
            error: function(err) {
                if (err.status == 500) {
                    alert("An Exception has occurred");
                }
            }
        });
    });
</script>



