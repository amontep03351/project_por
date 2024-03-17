<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">เพิ่มผู้ใช้ใหม่</div>

                <div class="card-body">
                    <form method="POST" id="userForm" >
                        <div class="form-group row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-right">ชื่อ</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">อีเมล</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-right">รหัสผ่าน</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
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

<script type="text/javascript">
  $('#userForm').submit(function(e) {
      e.preventDefault(); // ป้องกันการ submit ฟอร์มแบบปกติ
      var formData = $(this).serialize();
      $.ajax({
          url: '/users/store',
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
