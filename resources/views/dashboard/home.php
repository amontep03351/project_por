<br>
<h2>:Dashboard</h2>
<div class="row">
    <?php foreach ($projects as $project): ?>
        <div class="col-md-3 mb-3">
          <a href="javascript:void(0)" onclick="function_getTask(<?php echo $project->project_id; ?>);"><div class="shadow-lg p-3 mb-2 bg-body rounded">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1"><h5><?php echo $project->project_name; ?> <i class="bi bi-list"></i></h5>
            </div>
            <small><?php echo $project->created_at; ?></small>
            </div>
          </a>
        </div>
    <?php endforeach; ?>
</div>
<hr>
<span class="badge rounded-pill bg-warning text-dark">Warning</span>
<span class="badge rounded-pill bg-warning text-dark">Warning</span>
<span class="badge rounded-pill bg-warning text-dark">Warning</span>
<span class="badge rounded-pill bg-warning text-dark">Warning</span>
<span class="badge rounded-pill bg-warning text-dark">Warning</span>
<span class="badge rounded-pill bg-warning text-dark">Warning</span>
<hr>
<div id="Lisk_Taskinproject">

</div>
<hr>
<div id="Lisk_dtd">
  <div class="container">
    <div class="row">
      <div class="col text-center">
        <div class="shadow p-3 mb-2  rounded" style="background-color:#FF923D">To Do</div>
        <div class="list-group container-vitleft">
          <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">List group item heading</h5>
              <small>3 days ago</small>
            </div>
            <p class="mb-1">Some placeholder content in a paragraph.</p>
            <small>And some small print.</small>
          </a>
          <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">List group item heading</h5>
              <small class="text-muted">3 days ago</small>
            </div>
            <p class="mb-1">Some placeholder content in a paragraph.</p>
            <small class="text-muted">And some muted small print.</small>
          </a>
          <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">List group item heading</h5>
              <small class="text-muted">3 days ago</small>
            </div>
            <p class="mb-1">Some placeholder content in a paragraph.</p>
            <small class="text-muted">And some muted small print.</small>
          </a>
        </div>
      </div>
      <div class="col text-center">
        <div class="shadow p-3 mb-2  rounded" style="background-color:#F0ED3B">Doing</div>
        <div class="list-group container-vitleft">
          <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">List group item heading</h5>
              <small>3 days ago</small>
            </div>
            <p class="mb-1">Some placeholder content in a paragraph.</p>
            <small>And some small print.</small>
          </a>
          <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">List group item heading</h5>
              <small class="text-muted">3 days ago</small>
            </div>
            <p class="mb-1">Some placeholder content in a paragraph.</p>
            <small class="text-muted">And some muted small print.</small>
          </a>
          <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">List group item heading</h5>
              <small class="text-muted">3 days ago</small>
            </div>
            <p class="mb-1">Some placeholder content in a paragraph.</p>
            <small class="text-muted">And some muted small print.</small>
          </a>
        </div>
      </div>
      <div class="col text-center">
        <div class="shadow p-3 mb-2  rounded" style="background-color:#3BF056">Done</div>
        <div class="list-group container-vitleft">
          <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">List group item heading</h5>
              <small>3 days ago</small>
            </div>
            <p class="mb-1">Some placeholder content in a paragraph.</p>
            <small>And some small print.</small>
          </a>
          <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">List group item heading</h5>
              <small class="text-muted">3 days ago</small>
            </div>
            <p class="mb-1">Some placeholder content in a paragraph.</p>
            <small class="text-muted">And some muted small print.</small>
          </a>
          <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">List group item heading</h5>
              <small class="text-muted">3 days ago</small>
            </div>
            <p class="mb-1">Some placeholder content in a paragraph.</p>
            <small class="text-muted">And some muted small print.</small>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<br><br><br><br><br><br>
<p>
<script type="text/javascript">
  function function_getTask(id) {
    $.ajax({
        url: '/Home/getListTask',
        type: "get",
        data:{'id':id},
        headers: {'X-Requested-With': 'XMLHttpRequest'},
        beforeSend: function() {
          var textLoading = '<div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div>';
          //$("#DashboardBody").html(textLoading);
          $("#Lisk_Taskinproject").html(textLoading);
        },
        success: function (response) {
          $("#Lisk_Taskinproject").html(response);
        },
        error: function(data) {
          jsRerror(data);
        }
    });
  }
</script>
