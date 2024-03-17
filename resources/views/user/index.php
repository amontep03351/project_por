<br>
<h2>: จัดการข้อมูล User</h2>
<div class="container mt-5">
    <button id="addUserBtn" class="btn btn-primary">เพิ่มผู้ใช้ใหม่</button>
    <table id="userTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<!-- Modal -->
<div class="modal fade" id="UserModal" tabindex="-1" aria-labelledby="UserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="UserModalLabel">User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="User-modal-body" >

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1"   aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-md-8">
                          <div class="card">
                              <div class="card-header">แก้ไขข้อมูลผู้ใช้</div>

                              <div class="card-body">
                                <form method="POST" id="EdituserForm" >
                                    <div class="form-group row mb-3">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">ชื่อ</label>
                                        <input type="hidden" name="Editid" id="Editid" value="">
                                        <div class="col-md-6">
                                            <input id="Editname" type="text" class="form-control" name="Editname" required autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">อีเมล</label>

                                        <div class="col-md-6">
                                            <input id="Editemail" type="email" class="form-control" name="Editemail" required>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">รหัสผ่าน</label>

                                        <div class="col-md-6">
                                            <input id="Editpassword" type="password" class="form-control" name="Editpassword"  >
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                บันทึก
                                            </button>
                                        </div>
                                    </div>
                                </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>


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
      var table = $('#userTable').DataTable({
          ajax: {
              url: '/api/users', // ตัวอย่าง URL ของ API ที่เราจะเรียกข้อมูล
              dataSrc: '' // ตั้งค่าให้ DataTables ใช้ข้อมูลตรงไปตรงมาจากฟิลด์ข้อมูลที่ส่งกลับมา
          },
          columns: [
              { data: 'id' },
              { data: 'name' },
              { data: 'email' },
              {
                data: null,
                render: function(data, type, row) {
                     return '<button type="button" class="btn btn-sm btn-warning " onclick="editUser(' + data.id + ')">แก้ไข</button>';
                 }
             }
          ]
      });
  });
  $('#addUserBtn').click(function() {
    $("#UserModal").modal("show");
    $.ajax({
        url:'/users/create',
        type: "get",
        headers: {'X-Requested-With': 'XMLHttpRequest'},
        beforeSend: function() {
          var textLoading = '<div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div>';
          $("#User-modal-body").html(textLoading);
        },
        success: function (response) {
          $("#User-modal-body").html(response);
        },
        error: function(data) {
          jsRerror(data);
        }
    });
  });

  function editUser(id) {
      $.ajax({
          url: '/users/editUser/',
          type: 'post',
          data:{'id':id},
          success: function(response) {

              // นำข้อมูลที่ได้รับมาแสดงใน Modal
              $('#editModal').modal('show');
              $('#Editname').val(response.name);
              $('#Editemail').val(response.email);
              $("#Editpassword").val("");
              $("#Editid").val(id);
              // และอื่น ๆ ตามต้องการ
          },
          error: function(xhr, status, error) {
              console.error(xhr.responseText);
              // จัดการเมื่อเกิดข้อผิดพลาด
          }
      });
  }
  $('#EdituserForm').submit(function(e) {
      e.preventDefault(); // ป้องกันการ submit ฟอร์มแบบปกติ
      var formData = $(this).serialize();
      $.ajax({
          url: '/users/updateUser',
          type: 'post',
          data: formData,
          dataType: 'json',
          success: function(response) {
              if (response.success) {
                  // ปิด Modal
                  $("#UserModal").modal("hide");
                  // รีเฟรชตารางหลัก
                  $('#userTable').DataTable().ajax.reload();
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
