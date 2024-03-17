<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Project Management Dashboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <!-- โหลด CSS ของ Toastr.js จาก CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,100&family=Sarabun:wght@200&display=swap" rel="stylesheet">
  <style media="screen">
    body{
      font-family: 'Roboto', sans-serif;
      font-family: 'Sarabun', sans-serif;
      background-color:#D8D8D8;
    }
    thead {
       background-color: #85C7FF;
    }
    tbody{
      background-color: #FFFFFF;
    }
    a:link {
      text-decoration: none;
      color: black;
    }
    a:visited {
      text-decoration: none;
    }
    a:hover {
      text-decoration: none;
      color: blue;
    }
    a:active {
      text-decoration: none;
    }
    .container-vitleft{
      height: 500px;
      overflow: auto;
    }
  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Project Management Dashboard</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="function_menu('Home');" >Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="function_menu('ManageTasks');" >Tasks</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"  onclick="function_menu('ManageProjects');">Projects</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="function_menu('ManageUsers');">Users</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-4" style="background-color:#F0F0F0">


    <div id="DashboardBody" style="background-color:#F0F0F0">

    </div>
  </div>

  <!-- Bootstrap JS Bundle (Popper.js included) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
  <!-- โหลด Toastr.js จาก CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  <script type="text/javascript">
    function function_menu(Route) {
      $.ajax({
          url:Route,
          type: "get",
          headers: {'X-Requested-With': 'XMLHttpRequest'},
          beforeSend: function() {
            var textLoading = '<div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div>';
            $("#DashboardBody").html(textLoading);
          },
          success: function (response) {
            $("#DashboardBody").html(response);
          },
          error: function(data) {
            jsRerror(data);
          }
      });
    }
  </script>
</body>
</html>
