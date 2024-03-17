<!-- index.html -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Project Management System</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="styles.css" rel="stylesheet">
</head>
<body>

  <!-- Login Page -->
  <div class="container mt-5">
    <h2>Login</h2>
    <form>
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
  </div>

  <!-- Dashboard Page -->
  <div class="container mt-5 d-none" id="dashboard">
    <h2>Dashboard</h2>
    <!-- Add your dashboard content here -->
    <button class="btn btn-danger" id="logoutBtn">Logout</button>
  </div>

  <!-- Bootstrap JS Bundle (Popper.js included) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Custom JavaScript -->
  <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.querySelector('form');
    const dashboard = document.getElementById('dashboard');
    const logoutBtn = document.getElementById('logoutBtn');

    loginForm.addEventListener('submit', function(event) {
      event.preventDefault();
      const username = document.getElementById('username').value;
      const password = document.getElementById('password').value;

      // ตรวจสอบการลงชื่อเข้าใช้ ในที่นี้เรียบง่ายเพื่อตัวอย่าง
      // คุณสามารถใช้โค้ดที่ซับซ้อนขึ้นเพื่อตรวจสอบตามข้อมูลจริงได้
      if (username === 'admin' && password === 'password') {
        loginForm.reset();
        loginForm.classList.add('d-none');
        dashboard.classList.remove('d-none');
      } else {
        alert('Invalid username or password. Please try again.');
      }
    });

    logoutBtn.addEventListener('click', function() {
      dashboard.classList.add('d-none');
      loginForm.classList.remove('d-none');
    });
    });

  </script>
</body>
</html>
