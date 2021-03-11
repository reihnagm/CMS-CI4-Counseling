<?= view('template-master-admin/head'); ?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?= view('template-master-admin/nav'); ?>

    <!-- Main Sidebar Container -->
    <?= view('template-master-admin/aside'); ?>

    <div class="content-wrapper">

      <section class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <h1>Dashboard</h1>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="row">
                  <div class="col-sm-12 col-md-4">
                    <div class="form-group">
                      <label for="start-date-and-end-date-report">Date</label>
                      <input class="form-control" id="start-date-and-end-date-report" type="text" />
                    </div>
                  </div>
                  <?php if ((int) session('authenticated')->role == 3) : ?>
                    <div class="col-sm-12 col-md-4">
                      <div class="form-group">
                        <label for="select-staff-report">All Staff</label>
                        <select class="form-control" id="select-staff-report">
                          <?php foreach ($users as $user) : ?>
                            <option value="<?= $user->id; ?>"><?= $user->username; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  <?php endif; ?>
                  <div class="col-sm-12 col-md-4">
                    <button type="submit" class="btn btn-primary" id="apply-filter-report" style="margin-top: 32px;">Apply</button>
                  </div>
                </div>
              </div>
            </div>
            <table id="dt-report" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Date</th>
                  <th>User</th>
                  <th>Student</th>
                  <th>Status</th>
                  <th>Comment</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </section>
    </div>
  </div>

  <!-- REQUIRED SCRIPTS -->
  <?= view('template-master-admin/foot'); ?>

</body>

</html>