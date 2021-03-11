<?php

use Config\Services;

$req = Services::request();
?>

<?= view('template-master-admin/head'); ?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?= view('template-master-admin/nav'); ?>

    <!-- Main Sidebar Container -->
    <?= view('template-master-admin/aside'); ?>

    <div class="content-wrapper">

      <section class="content-header">
      </section>

      <section class="content">
        <div class="row">
          <div class="col-md-3">
            <div class="card card-primary card-outline card-tabs">
              <div class="card-header">
                <h3 class="card-title">Follow Up</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                  <?php foreach ($statusCounselor as $stat) : ?>
                    <li class="nav-item">
                      <?php $statusFollowUpName = str_replace(" ", "-", $stat->name); ?>
                      <a href="<?= $stat->status == 0 ? "javascript:void(0)" : base_url('/admin/follow-up/' . urlencode($statusFollowUpName)); ?>" class="nav-link">
                        <?= $stat->name; ?>
                        <span class="badge bg-success float-right"><?= $stat->status; ?></span>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-9">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">List Student</h3>
              </div>
              <div class="card-body">
                <?php if (session('authenticated')->role == 3) : ?>
                  <form class="form-inline" style="justify-content: end;">
                    <div class="mx-sm-3">
                      <label for="select-filter-handled-by" class="my-2">Filter Handled by</label>
                      <select id="select-filter-handled-by" class="form-control">
                        <option value="all">All</option>
                        <?php foreach ($users as $user) : ?>
                          <option value="<?= $user->id ?>"><?= $user->username ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <button type="submit" id="btn-filter-handled-by" class="btn btn-primary" style="margin-top: 47.5px;">Apply</button>
                  </form>
                <?php endif; ?>
                <div class="table-responsive mailbox-messages">
                  <div class="col-md-12">
                    <table id="dt-follow-up" class="table table-hover table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Handled by</th>
                          <th>No Handphone</th>
                          <th>Fullname</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>

  <!-- REQUIRED SCRIPTS -->
  <?= view('template-master-admin/foot'); ?>

  <script>
    var followUpStatus = '<?= $req->uri->getSegment(3) ?>'
    var table = $("#dt-follow-up").DataTable({
      responsive: true,
      serverSide: true,
      retrieve: true,
      searching: true,
      processing: true,
      pagination: true,
      ajax: {
        url: `${baseUrl}/admin/follow-up-datatables/${followUpStatus}/${$("#select-filter-handled-by").val()}`,
        dataType: "json",
        type: "POST",
        deferRender: true
      },
      language: {
        lengthMenu: "Show _MENU_ Per Page",
        processing: "Sedang memuat data... Mohon Tunggu"
      },
      columns: [{
          data: "no",
          searchable: false,
          orderable: false,
          render: function(data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1
          }
        },
        {
          data: "handledby"
        },
        {
          data: "msisdn"
        },
        {
          data: "fullname"
        },
        {
          data: "action"
        },
      ]
    })
    $("#btn-filter-handled-by").click(function(e) {
      e.preventDefault()
      var selecthandledby = $("#select-filter-handled-by").val()
      table.ajax.url(`${baseUrl}/admin/follow-up-datatables/${followUpStatus}/${selecthandledby}`).load()
    })
  </script>

</body>

</html>