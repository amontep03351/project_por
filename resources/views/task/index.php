<br>
<h2>: จัดการข้อมูล Task</h2>
<div class="container mt-5">
    <button id="addTaskBtn" class="btn btn-primary">เพิ่ม Task ใหม่</button>
    <table id="taskTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Project ID</th>
                <th>Task Name</th>
                <th>Task Description</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="TaskModal" tabindex="-1" aria-labelledby="TaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TaskModalLabel">เพิ่ม Task ใหม่</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addTaskForm">
                    <div class="mb-3">
                        <label for="userID" class="form-label">User</label>
                        <select class="form-control" name="userID" id="userID" required>
                          <option value="">===เลือก Head Task ===</option>
                            <?php foreach ($User as $user): ?>
                                <option value="<?php echo $user->id ?>"><?php echo $user->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="projectID" class="form-label">Project</label>
                        <select class="form-control" name="projectID" id="projectID" required>
                          <option value="">===เลือก Project ===</option>
                            <?php foreach ($Projects as $project): ?>
                                <option value="<?php echo $project->project_id  ?>"><?php echo $project->project_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="taskName" class="form-label">Task Name</label>
                        <input type="text" class="form-control" id="taskName" name="taskName" required>
                    </div>
                    <div class="mb-3">
                        <label for="taskDesc" class="form-label">Task Description</label>
                        <textarea class="form-control" id="taskDesc" name="taskDesc" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editTaskModal" tabindex="-1"   aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTaskModalLabel">แก้ไข Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editTaskForm">
                    <div class="mb-3">
                        <label for="editUserID" class="form-label">Head Project</label>
                        <input type="text" class="form-control" id="editUserID" name="editUserID" required>
                    </div>
                    <div class="mb-3">
                        <label for="editProjectID" class="form-label">Project</label>
                        <input type="text" class="form-control" id="editProjectID" name="editProjectID" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTaskName" class="form-label">Project Name</label>
                        <input type="text" class="form-control" id="editTaskName" name="editTaskName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTaskDesc" class="form-label">Task Description</label>
                        <textarea class="form-control" id="editTaskDesc" name="editTaskDesc" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var table = $('#taskTable').DataTable({
            ajax: {
                url: '/api/Tasks',
                dataSrc: ''
            },
            columns: [
                { data: 'task_id' },
                { data: 'user_id' },
                { data: 'project_id' },
                { data: 'task_name' },
                { data: 'task_desc' },
                { data: 'created_at' },
                {
                    data: null,
                    render: function(data, type, row) {
                         return '<button type="button" class="btn btn-sm btn-warning" onclick="editTask(' + data.task_id + ')">แก้ไข</button>';
                     }
                 }
            ]
        });
    });

    $('#addTaskBtn').click(function() {
         $("#TaskModal").modal("show");
    });

    $('#addTaskForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: '/tasks/store',
            type: 'post',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $("#TaskModal").modal("hide");
                    $('#taskTable').DataTable().ajax.reload();
                    toastr.success(response.message);
                } else {
                    $.each(response.errors, function(key, value) {
                        toastr.error(value[0]);
                    });
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                toastr.error('เกิดข้อผิดพลาด: ' + xhr.responseText);
            }
        });
    });

    function editTask(id) {
        $.ajax({
            url: '/tasks/edit/' + id,
            type: 'get',
            success: function(response) {
                $('#editTaskModal').modal('show');
                $('#editUserID').val(response.user_id);
                $('#editProjectID').val(response.project_id);
                $('#editTaskName').val(response.task_name);
                $('#editTaskDesc').val(response.task_desc);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    $('#editTaskForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: '/tasks/update',
            type: 'post',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $("#editTaskModal").modal("hide");
                    $('#taskTable').DataTable().ajax.reload();
                    toastr.success(response.message);
                } else {
                    $.each(response.errors, function(key, value) {
                        toastr.error(value[0]);
                    });
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                toastr.error('เกิดข้อผิดพลาด: ' + xhr.responseText);
            }
        });
    });
</script>
