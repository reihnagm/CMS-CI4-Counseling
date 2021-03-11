<?php

use Config\Services;

$request = Services::request();
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
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">

            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="row">
          <div class="col-12 col-sm-12">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <?php foreach ($statusAdmission as $stat) : ?>
                    <li class="nav-item">
                      <a class="nav-link <?= $request->uri->getSegment(3) == $stat->name ? "active" : "" ?>" href="<?= $stat->status == 0 ? "javascript:void(0)" : base_url('/admin/admission/' . urlencode($stat->name)); ?>">
                        <?= $stat->name ?> &nbsp;
                        <span class="badge bg-info float-right" style="margin-top: 4px;"> <?= $stat->status ?></span>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade active show" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                    <div class="mailbox-messages">
                      <div class="table-responsive mailbox-messages">
                        <div class="col-md-12">
                          <table class="table table-hover table-striped" id="dt-admission">
                            <thead>
                              <th></th>
                            </thead>
                            <tbody>
                              <?php foreach ($students as $student) : ?>
                                <tr>
                                  <td>
                                    <div class="name">
                                      <?php if (session('authenticated')->role == "1" || session('authenticated')->role == "3") : ?>
                                        <a href="<?= base_url('/admin/admission-detail/' . $student->id) ?>"">
                                        <?= $student->first_name; ?> <?= $student->last_name; ?>
                                      </a>
                                      <?php endif; ?>
                                      <?php if (session('authenticated')->role == "2") : ?>
                                        <a href=" #">
                                          <?= $student->first_name; ?> <?= $student->last_name; ?>
                                        </a>
                                      <?php endif; ?>
                                    </div>
                                    <div class=" content">
                                      <p>
                                        <?= $student->university; ?> <?= $student->country_university; ?>
                                        <?= $student->period_of_study; ?> <?= $student->univ_program_of_study; ?>
                                        <?= $student->current_level_of_study; ?>
                                      </p>
                                    </div>
                                    <div class="label" style="float: right;">
                                      <button class="btn btn-success btn-sm"><?= $student->fullname; ?></button>
                                      <button class="btn btn-default btn-sm"><?= $student->city; ?></button>
                                    </div>
                                  </td>
                                </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
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

</body>

</html>