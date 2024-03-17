<br>
<h2>: จัดการข้อมูล Project</h2>
<div class="container mt-5">
    <button id="addProjectBtn" class="btn btn-primary">เพิ่มผู้โปรเจคใหม่</button>
    <table id="projectTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Project Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="ProjectModal" tabindex="-1" aria-labelledby="ProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ProjectModalLabel">เพิ่มโปรเจคใหม่</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addProjectForm">
                    <div class="mb-3">
                        <label for="projectName" class="form-label">ชื่อโปรเจค</label>
                        <input type="text" class="form-control" id="projectName" name="projectName" required>
                    </div>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1"   aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="EditProjectForm">
                    <div class="mb-3">
                        <label for="EditprojectName" class="form-label">ชื่อโปรเจค</label>
                        <input type="hidden" name="Editid" id="Editid" value="">
                        <input type="text" class="form-control" id="EditProjectname" name="EditProjectname" required>
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
      // Initialize DataTables
      var table = $('#projectTable').DataTable({
          ajax: {
              url: '/api/Projects', // ตัวอย่าง URL ของ API ที่เราจะเรียกข้อมูล
              dataSrc: '' // ตั้งค่าให้ DataTables ใช้ข้อมูลตรงไปตรงมาจากฟิลด์ข้อมูลที่ส่งกลับมา
          },
          columns: [
              { data: 'project_id' },
              { data: 'project_name' },
              {
                data: null,
                render: function(data, type, row) {
                     return '<button type="button" class="btn btn-sm btn-warning " onclick="editProject(' + data.project_id + ')">แก้ไข</button>';
                 }
             }
          ]
      });
  });
  $('#addProjectBtn').click(function() {
     $("#ProjectModal").modal("show");
      $("#projectName").val("");
  });
  $('#addProjectForm').submit(function(e) {
      e.preventDefault(); // ป้องกันการ submit ฟอร์มแบบปกติ
      var formData = $(this).serialize();
      $.ajax({
          url: '/Projects/store',
          type: 'post',
          data: formData,
          dataType: 'json',
          success: function(response) {
              if (response.success) {
                  // ปิด Modal
                  $("#ProjectModal").modal("hide");
                  // รีเฟรชตารางหลัก
                  $('#projectTable').DataTable().ajax.reload();
                  // แสดงข้อความสำเร็จ
                  toastr.success(response.message);
              } else {
                  // แสดงข้อผิดพลาดจาก validation
                  $.each(response.errors, function(key, value) {
                      toastr.error(value[0]);
                  });
              }
          },
          error: function(xhr, textStatus, errorThrown) {
              // แสดงข้อความข้อผิดพลาดทั่วไป
              toastr.error('เกิดข้อผิดพลาด: ' + xhr.responseText);
          }
      });
  });
  function editProject(id) {
      $.ajax({
          url: '/Projects/editProjects/',
          type: 'post',
          data:{'id':id},
          success: function(response) {

              // นำข้อมูลที่ได้รับมาแสดงใน Modal
              $('#editModal').modal('show');
              $('#EditProjectname').val(response.project_name);
              $("#Editid").val(id);
              // และอื่น ๆ ตามต้องการ
          },
          error: function(xhr, status, error) {
              console.error(xhr.responseText);
              // จัดการเมื่อเกิดข้อผิดพลาด
          }
      });
  }
  $('#EditProjectForm').submit(function(e) {
      e.preventDefault(); // ป้องกันการ submit ฟอร์มแบบปกติ
      var formData = $(this).serialize();
      $.ajax({
          url: '/Projects/updateProjects',
          type: 'post',
          data: formData,
          dataType: 'json',
          success: function(response) {
              if (response.success) {
                  // ปิด Modal
                  $("#editModal").modal("hide");
                  // รีเฟรชตารางหลัก
                  $('#projectTable').DataTable().ajax.reload();
                  // แสดงข้อความสำเร็จ
                  toastr.success(response.message);
              } else {
                  // แสดงข้อผิดพลาดจาก validation
                  $.each(response.errors, function(key, value) {
                      toastr.error(value[0]);
                  });
              }
          },
          error: function(xhr, textStatus, errorThrown) {
              // แสดงข้อความข้อผิดพลาดทั่วไป
              toastr.error('เกิดข้อผิดพลาด: ' + xhr.responseText);
          }
      });
  });
</script>
