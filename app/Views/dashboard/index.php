<?= view('template-master-admin/head'); ?>

<?php

use Config\Services;

$session = Services::session();
?>

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
        <div class="row is-marginless">
          <div class="col-sm-12 col-md-4 is-paddingless">
            <div class="col-sm-12 col-md-12 is-paddingless">
              <div class="col-sm-12 col-md-12 is-paddingless">
                <div class="card card-primary card-outline card-tabs">
                  <div class="card-body p-3">
                    <div id="full-calendar">
                    </div>
                  </div>
                </div>
              </div>
              <?php if ((int) session('authenticated')->role == 2 || (int) session('authenticated')->role == 3) : ?>
                <button id="new-leads-btn" type="button" class="btn btn-primary btn-labeled mb-3" style="width: 100%;">
                  <span class="btn-label" style="background: transparent !important;"><i class="fas fa-hand-point-right"></i></span>New Leads
                </button>
              <?php endif; ?>
            </div>
            <!-- Counselor -->
            <?php if ((int) session('authenticated')->role == 2 || (int) session('authenticated')->role == 3) : ?>
              <div class="col-sm-12 col-md-12 is-paddingless">
                <div class="card card card-primary card-outline card-tabs">
                  <div class="card-header border-transparent">
                    <h3 class="card-title">Follow Up Status</h3>
                  </div>
                  <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                      <?php foreach ($statusesFollowUp as $statusFollowUp) : ?>
                        <li class="nav-item">
                          <?php $statusFollowUpName = str_replace(" ", "-", $statusFollowUp->name); ?>
                          <?php if ($statusFollowUp->name != "Prospect") : ?>
                            <a href="<?= $statusFollowUp->status == 0 ? "javascript:void(0)" : base_url('/admin/follow-up/' . urlencode($statusFollowUpName)); ?>" class="nav-link">
                              <?= $statusFollowUp->name; ?>
                              <span class="badge bg-success float-right"><?= $statusFollowUp->status; ?></span>
                            </a>
                          <?php endif; ?>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          </div>

          <!-- Admission -->
          <?php if ((int) session('authenticated')->role == 1 || (int) session('authenticated')->role == 3 || (int) session('authenticated')->role == 2) : ?>
            <div class="col-sm-12 col-md-4 is-paddingless">
              <div class="card card-primary card-outline card-tabs" style="margin-left: 20px;">
                <div class="card-header p-0 pt-1 border-bottom-0">
                  <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="custom-tabs-one-sap" data-toggle="pill" href="#custom-tabs-one-sap" role="tab" aria-controls="custom-tabs-one-sap" aria-selected="true">Admission Status</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-one-sap">
                    <div class="card-body p-0">
                      <ul class="nav nav-pills flex-column">
                        <?php foreach ($statusesAdmissions as $statusesAdmission) : ?>
                          <li class="nav-item">
                            <?php $statusAdmissionName = str_replace(" ", "-", $statusesAdmission->name); ?>
                            <a href="<?= $statusesAdmission->status == 0 ? "javascript:void(0)" : base_url('/admin/admission/' . urlencode($statusAdmissionName)); ?>" class="nav-link">
                              <?= $statusesAdmission->name; ?>
                              <span class="badge bg-success float-right"><?= $statusesAdmission->status; ?></span>
                            </a>
                          </li>
                        <?php endforeach; ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <?php if ((int) session('authenticated')->role == 3) : ?>
                <div style="margin-left: 20px;">
                  <button id="add-achievement-btn" type="button" class="btn btn-primary btn-labeled mb-3" style="width: 100%;">
                    <span class="btn-label" style="background: transparent !important;"><i class="fas fa-trophy"></i></span>Add Achievement to Staff
                  </button>
                </div>
              <?php endif ?>
            </div>

          <?php endif; ?>
          <div class="col-sm-12 col-md-4 is-paddingless">
            <div class="card card-primary card-outline card-tabs" style="margin-left: 20px;">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-info-circle mr-2"></i>
                  Important Announcement!
                </h3>
              </div>
              <div class="card-body">
                <button id="link-attachment-btn" type="button" class="btn btn-labeled mb-3" style="width: 100%; border: 1px solid black;">
                  <span class="btn-label-2"><i class="fas fa-link"></i></span>Link Attachment
                </button>
              </div>
            </div>
            <div class="card card-primary card-outline card-tabs" style="margin-left: 20px;">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-bookmark mr-2"></i>
                  Quotes
                </h3>
                <div class="row flex-row-reverse">
                  <div class="md-12 sm-12">
                    <?php if (session('authenticated')->role == 3) : ?>
                      <button id="add-qoutes-btn" type="button" class="btn btn-primary">
                        Add
                      </button>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="swiper-container">
                <div class="swiper-wrapper">
                  <?php foreach ($qoutes as $qoute) : ?>
                    <div class="swiper-slide">
                      <div class="card-body">
                        <p class="card-text">“<?= $qoute->content; ?>”</p>
                        <p>- <?= $qoute->username; ?></p>
                        <?php if (session('authenticated')->role == 3) : ?>
                          <button onclick="editQoutes('<?= $qoute->id ?>')" class="btn btn-primary">
                            Edit
                          </button>
                        <?php endif; ?>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
            <?php if ((int) session('authenticated')->role == 1 || (int) session('authenticated')->role == 2) : ?>
              <div class="card card card-primary card-outline card-tabs" style="margin-left: 20px;">
                <canvas id="my-pie-chart" style="position: relative; width: 110px; height: 100px; padding: 10px;"></canvas>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <div class="modal fade" id="modal-edit-qoutes" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Qoutes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="form-edit-qoutes">
                  <input type="hidden" id="edit-id-qoutes">
                  <div class="form-group">
                    <label>Content</label>
                    <textarea class="form-control" name="content-qoutes" id="edit-content-qoutes"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Author</label>
                    <input type="text" class="form-control" name="author-qoutes" id="edit-author-qoutes">
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" id="update-qoutes-btn" class="btn btn-primary">Update</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modal-store-qoutes" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Add Qoutes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="form-store-qoutes">
                  <div class="form-group">
                    <label>Content</label>
                    <textarea class="form-control" name="content-qoutes" id="store-content-qoutes"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Author</label>
                    <input type="text" class="form-control" name="author-qoutes" id="store-author-qoutes">
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" id="store-qoutes-btn" class="btn btn-primary">Create</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="add-achievement-modal" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Add Achievement to Staff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="form-add-achievement">
                  <div class="form-group">
                    <label>Target</label>
                    <select id="add-achievement-target" class="form-control">
                      <?php for($i = 1; $i <= 1000; $i++): ?>
                        <option value="<?= $i ?>"><?= $i; ?></option>
                      <?php endfor; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Year</label>
                    <input type="text" class="form-control" name="add-achievement-year" id="add-achievement-year">
                  </div>
                  <div class="form-group">
                    <label for="select-add-achievement-staff">All Staff</label>
                    <select class="form-control" id="select-add-achievement-staff">
                      <?php foreach ($users as $user) : ?>
                        <option value="<?= $user->id ?>"><?= $user->name ?> - <?= $user->username ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" id="store-achievement-btn" class="btn btn-primary">Create</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="event-info-modal" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Info Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="form-event-info-calendar">
                  <div class="form-group">
                    <label>Event</label>
                    <textarea name="event-info-name" id="event-info-name" class="form-control" readonly></textarea>
                  </div>
                  <div class="form-group">
                    <label>Date</label>
                    <input type="text" class="form-control" name="event-info-date-calendar" id="event-info-date-calendar" readonly>
                  </div>
                  <div class="form-group">
                    <label>Branch</label>
                    <input type="text" class="form-control" name="event-info-branch" id="event-info-branch" readonly>
                  </div>
                  <div id="event-info-status-wrapper" class="form-group">
                    <label>Status</label>
                    <input type="text" class="form-control" name="event-info-status" id="event-info-status" readonly>
                  </div>
                  <?php if ((int) session('authenticated')->role == 3) : ?>
                    <div id="wrapper-event-info-total" class="form-group">
                      <label>Total</label>
                      <input type="text" class="form-control" name="event-info-total" id="event-info-total" readonly>
                    </div>
                  <?php endif; ?>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="event-modal" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Create Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="form-event-calendar">
                  <div class="form-group">
                    <label>Event</label>
                    <textarea name="event-name-calendar" id="event-name-calendar" class="form-control" placeholder="Event"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Date</label>
                    <input type="text" class="form-control" name="date-calendar" id="date-calendar" placeholder="Date" readonly>
                  </div>
                  <div class="form-group">
                    <label for="select-branches-event-calendar">Branch</label>
                    <select class="form-control" id="select-branches-event-calendar">
                      <option value="0">All</option>
                      <?php foreach ($branches as $branch) : ?>
                        <option value="<?= $branch->id ?>"> <?= $branch->name ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" id="event-calendar-create-btn" class="btn btn-primary">Create</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="attachment-modal" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Link Attachment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <?php if (session('authenticated')->role == 3) : ?>
                  <form id="form-attachment">
                    <div class="col-sm-12 col-sm-12">
                      <div class="form-group">
                        <label>Link Attachment</label>
                        <input type="text" class="form-control" name="attachment" id="attachment" placeholder="Link Attachment" required>
                      </div>
                      <div class="form-group">
                        <label>Content</label>
                        <textarea name="content" id="content" class="form-control" placeholder="Content"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="select-branch-attachment">Branch</label>
                        <select id="select-branch-attachment" name="select-branch-attachment" class="form-control">
                          <?php foreach ($branches as $branch) : ?>
                            <option value="<?= strtolower($branch->id); ?>"><?= $branch->name ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </form>
                <?php else : ?>
                  <?php foreach ($attachments as $attachment) : ?>
                    <form id="form-attachment">
                      <div class="col-sm-12 col-sm-12">
                        <div class="form-group">
                          <label for="url">Url</label>
                          <input type="text" class="form-control" value="<?= $attachment->url ?>" name="attachment" id="url" readonly>
                        </div>
                        <div class="form-group">
                          <label for="content">Content</label>
                          <input type="text" class="form-control" value="<?= $attachment->content ?>" name="content" id="content" readonly>
                        </div>
                        <div class="form-group">
                          <label for="content">Name</label>
                          <input type="text" class="form-control" value="<?= $attachment->name ?>" name="name" id="name" readonly>
                        </div>
                      </div>
                    </form>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <?php if (session('authenticated')->role == 3) : ?>
                  <button type="button" id="attachment-btn" class="btn btn-primary">Create</button>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="staff-modal" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delegate to Staff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="form-select-delegate">
                  <div class="col-sm-12 col-sm-12">
                    <div class="form-group">
                      <label>Pilih Staff</label>
                      <select name="status-delegate" id="select-delegate" class="form-control">
                        <?php foreach ($users as $user) : ?>
                          <option value="<?= $user->id ?>"><?= $user->name ?> - <?= $user->username ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" id="delegate-btn" class="btn btn-primary">Delegate</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="new-leads-modal" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Leads</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="card card-primary">
                  <form id="form-new-leads">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>First Name*</label>
                            <input type="text" class="form-control" name="first-name" id="fname" placeholder="First Name" minlength="2" required>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Last Name*</label>
                            <input type="text" class="form-control" name="last-name" id="lname" placeholder="Last Name" minlength="2" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>No Handphone*</label>
                            <input type="text" class="form-control" name="msisdn" id="msisdn" placeholder="No Handphone">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Email*</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Birthdate*</label>
                            <input type="text" class="form-control" name="birthdate" id="birthdate" placeholder="Birthdate">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Birthplace*</label>
                            <input type="text" class="form-control" name="birthplace" id="birthplace" placeholder="Birthplace">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>City*</label>
                            <input type="text" class="form-control" name="city" id="city" placeholder="City">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Postal Code</label>
                            <input type="text" class="form-control" name="postal_code" id="postal-code" placeholder="Postal Code">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" id="address" class="form-control" placeholder="Address"></textarea>
                      </div>
                      <div class="form-group">
                        <label>Parents</label>
                        <input type="text" class="form-control" name="parents" id="parents" placeholder="Parents">
                      </div>
                      <div class="form-group">
                        <label>School</label>
                        <input type="text" class="form-control" placeholder="Select School" list="list-school" id="select-sch" name="school" autocomplete="off">
                        <datalist id="list-school">
                          <?php foreach ($schools as $school) : ?>
                            <option data-value="<?= $school->id ?>" value="<?= $school->name ?>">
                            <?php endforeach; ?>
                        </datalist>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 col-sm-12">
                          <div class="form-group">
                            <label>Source</label>
                            <select name="source" id="select-source" class="form-control">
                              <?php foreach ($statuses as $status) : ?>
                                <option value="<?= $status->id ?>"><?= $status->name ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" id="store-new-leads-btn" class="btn btn-primary">Add New Leads</button>
              </div>
            </div>
          </div>
        </div>

        <?php if (session('authenticated')->role == "3") : ?>
          <div class="card card-primary card-outline card-tabs">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-12 col-md-12">
                  <div class="row">
                    <div class="col-sm-12 col-md-4">
                      <div class="form-group">
                        <label for="start-date-and-end-date">Date</label>
                        <input class="form-control" id="start-date-and-end-date" type="text" />
                      </div>
                      <div class="form-group">
                        <label for="start-date-and-end-date">University</label>
                        <select name="select-universities-by-country" class="form-control" id="select-universities-by-country">
                          <option value="all">Select University</option>
                          <!-- Use Ajax -->
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="select-staff-datatables">Staff</label>
                        <select id="select-staff-datatables" name="select-staff-datatables" class="form-control">
                          <option value="all" selected>all</option>
                          <?php foreach ($counselors as $counselor) : ?>
                            <option value="<?= strtolower($counselor->id); ?>"><?= $counselor->name ?> - <?= $counselor->username; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                      <div class="form-group">
                        <label for="dropdown-birthyear">Year</label>
                        <input class="form-control" id="dropdown-birthyear" type="text" value="2003" />
                      </div>
                      <div class="form-group">
                        <label for="select-country-datatables">Country</label>
                        <select id="select-country-datatables" name="select-country-datatables" class="form-control">
                          <option value="select-country">Select Country</option>
                          <?php foreach ($countries as $country) : ?>
                            <option value="<?= $country->country ?>"><?= $country->country; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="filter-city-datatables-siswa">City</label>
                        <input class="form-control" id="filter-city-datatables-siswa" type="text" value="all" />
                      </div>
                      <!-- <select id="select-branch-dt-siswa" name="select-branch-dt-siswa" class="form-control">
                        <?php foreach ($branches as $branch) : ?>
                          <option value="<?= strtolower($branch->name); ?>"><?= $branch->name; ?></option>
                        <?php endforeach; ?>
                      </select> -->
                    </div>
                    <div class="col-sm-12 col-md-4">
                      <button type="submit" class="btn btn-primary" id="apply-filter-dt-siswa" style="margin-top: 95px;">Apply</button>
                      <button type="submit" class="btn btn-primary" id="apply-filter-reset" style="display: block; margin-top: 0px;">Reset</button>
                    </div>
                    <div id="custom-loading-dt-siswa">
                      <p>Sedang memuat data... Mohon Tunggu</p>
                    </div>
                  </div>
                </div>
              </div>
              <table id="dt-siswa" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Domain</th>
                    <th>Group</th>
                    <th>No HP</th>
                    <th>Mother</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Birth Year</th>
                    <th>Delegate By</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        <?php endif; ?>
      </section>

    </div>
  </div>

  <!-- REQUIRED SCRIPTS -->
  <?= view('template-master-admin/foot'); ?>

  <script>
    <?php if ($session->getFlashdata('msg_err')) { ?>
      swal("Oops!", "Student not found!", "info")
    <?php } ?>

    function editQoutes(qouteId) {
      $("#modal-edit-qoutes").modal("show")
      $.ajax({
        url: `${baseUrl}/admin/edit-qoutes`,
        type: "POST",
        data: {
          qouteId: qouteId
        },
        success: function(data) {
          var result = JSON.parse(data)
          $("#edit-id-qoutes").val(result.id)
          $("#edit-content-qoutes").val(result.content)
          $("#edit-author-qoutes").val(result.username)
        },
        error: function(data) {
          console.log(data)
        }
      })
    }

    $("#update-qoutes-btn").click(function(e) {
      e.preventDefault()
      var qouteId = $("#edit-id-qoutes").val()
      var qouteContent = $("#edit-content-qoutes").val()
      var qouteUsername = $("#edit-author-qoutes").val()
      try {
        if (qouteContent === "") {
          throw new Error("Content Required")
        }
        if (qouteUsername === "") {
          throw new Error("Username Required")
        }
        $("#update-qoutes-btn").prop("disabled", true)
        $("#update-qoutes-btn").text("Process")
        $.ajax({
          url: `${baseUrl}/admin/update-qoutes`,
          type: "POST",
          data: {
            qouteId: qouteId,
            qouteContent: qouteContent,
            qouteUsername: qouteUsername
          },
          success: function(data) {
            if (data === "true") {
              swal("Successful", "Update Qoutes", "success")
              location.reload()
              $("#update-qoutes-btn").prop("disabled", false)
              $("#update-qoutes-btn").text("Update")
            }
          },
          error: function(data) {
            console.log(data)
          }
        })
      } catch (err) {
        swal("Oops!", err.message, "error")
      }
    })

    $("#add-qoutes-btn").click(function(e) {
      e.preventDefault()
      $("#modal-store-qoutes").modal("show")
    })

    $("#store-qoutes-btn").click(function(e) {
      e.preventDefault()
      var qouteContent = $("#store-content-qoutes").val()
      var qouteUsername = $("#store-author-qoutes").val()
      try {
        if (qouteContent === "") {
          throw new Error("Content Required")
        }
        if (qouteUsername === "") {
          throw new Error("Username Required")
        }
        $("#store-qoutes-btn").prop("disabled", true)
        $("#store-qoutes-btn").text("Process")
        $.ajax({
          url: `${baseUrl}/admin/store-qoutes`,
          type: "POST",
          data: {
            qouteContent: qouteContent,
            qouteUsername: qouteUsername
          },
          success: function(data) {
            if (data === "true") {
              swal("Successful", "Add Qoutes", "success")
              location.reload()
              $("#store-qoutes-btn").prop("disabled", false)
              $("#store-qoutes-btn").text("Create")
            }
          },
          error: function(data) {
            console.log(data)
          }
        })
      } catch (err) {
        swal("Oops!", err.message, "error")
      }
    })
    var selectStaffDb = $("#select-staff-datatables").val()
    var defYestDate = moment().subtract(7, "days").format("YYYY-MM-DD")
    var defTommDate = moment().format("YYYY-MM-DD")
    $("#select-universities-by-country").prop("disabled", true)
    $("#event-info-status-wrapper").css("display", "none")
    $("#select-country-datatables").on("change", function(e) {
      var country = $("#select-country-datatables").val()
      $.ajax({
        url: `${baseUrl}/admin/get-universities-by-country`,
        type: "POST",
        data: {
          country: country,
        },
        success: function(data) {
          if (data === "false") {
            $("#select-universities-by-country").prop("disabled", true)
            $("#select-universities-by-country").html("<option value='all'> Select Universities</option>")
          } else {
            var result = JSON.parse(data)
            $("#select-universities-by-country").prop("disabled", false)
            $("#select-universities-by-country").html(result)
          }
        },
        error: function(data) {
          console.log(data)
        }
      })
    })
    $("#dt-siswa").DataTable({
      dom: "<'row'<'col-sm-12 col-md-8'><'col-sm-12 col-md-4 mt-4 text-right'B>>" + "<'row dtSiswa'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
      select: {
        style: "multi"
      },
      pageLength: 100,
      destroy: true,
      responsive: true,
      retrieve: true,
      searching: false,
      serverSide: true,
   // serverSide: true, DataTables stuck on “Processing” when sorting
      processing: true,
      buttons: [{
          text: "Delegate to Staff",
          className: "btn btn-primary",
          action: function(e, dt, node, config) {
            var data = $("#dt-siswa")
              .DataTable()
              .rows({
                selected: true
              })
              .data()
            if (data.length === 0) {
              swal("Oops!", "Please Select Data to Delegate Staff", "info")
            } else if (data.length >= 10) {
              swal("Oops!", "Can't Select More Than 10 Data", "info")
            } else {
              $("#staff-modal").modal("show")
              $("#delegate-btn").click(e => {
                e.preventDefault()
                var handledBy = $("#select-delegate").val()
                var dataAssign = []
                for (var i = 0; i < data.length; i++) {
                  dataAssign.push(data[i])
                }
                var dataJson = JSON.stringify(dataAssign)
                $("#delegate-btn").prop("disabled", true)
                $("#delegate-btn").text("Process")
                $.ajax({
                  url: `${baseUrl}/admin/delegate-staff`,
                  type: "POST",
                  data: {
                    handledBy: handledBy,
                    data: dataJson
                  },
                  success: function(data) {
                    if (data === "true") {
                      swal("Successful", "Delegating Staff", "success")
                      $("#delegate-btn").prop("disabled", false)
                      $("#delegate-btn").text("Delegate")
                      location.reload()
                    }
                    if (data === "false") {
                      swal("Info", "Duplicate MSISDN", "info")
                      $("#delegate-btn").prop("disabled", false)
                      $("#delegate-btn").text("Delegate")
                    }
                  },
                  error: function(data) {
                    console.log(data)
                  }
                })
              })
            }
          }
        },
        {
          extend: "collection",
          text: "Export",
          className: "btn btn-success",
          buttons: [{
              extend: "excel",
              className: "btn btn-primary"
            },
            {
              extend: "copy",
              className: "btn btn-primary"
            },
            {
              extend: "csv",
              className: "btn btn-primary"
            },
            {
              extend: "pdf",
              className: "btn btn-primary"
            },
            {
              extend: "print",
              className: "btn btn-primary"
            }
          ]
        }
      ],
      language: {
        lengthMenu: "Show _MENU_ Per Page",
        processing: "Sedang memuat data... Mohon Tunggu"
      },
      ajax: {
        url: `${baseUrl}/admin/getDtSiswa/all/all/${defYestDate}/${defTommDate}/2003/all`,
        dataType: "json",
        type: "POST",
        deferRender: true,
        dataSrc: function(json) {
          var data = {}
          if (json.data.length === 0) {
            $("#apply-filter-dt-siswa").prop("disabled", false)
            $("#apply-filter-reset").prop("disabled", false)
            $("tr .odd").html('<td colspan="11" class="dataTables_empty" valign="top">No data available in table</td>')
            // $(".dataTables_empty").css("display", "none") // use when data cannot show display "no data available"
            $(".dataTables_wrapper .dataTables_processing").css("display", "none")
          } else {
            $("#apply-filter-dt-siswa").prop("disabled", false)
            $("#apply-filter-reset").prop("disabled", false)
            $("tr .odd").html("")
            //$(".dataTables_empty").css("display", "block") // use when data cannot show display "no data available"
            $(".dataTables_wrapper .dataTables_processing").css("display", "none")
          }
          data.draw = json.draw
          data.recordsTotal = json.recordsTotal
          data.recordsFiltered = json.recordsFiltered
          data.data = json.data
          // Remove Duplicate MSISDN
          // const uniqueMsisdn = Array.from(new Set(data.data.map(a => a.msisdn))).map(id => {
          //   return data.data.find(a => a.msisdn === id)
          // })
          // return uniqueMsisdn
          return data.data
        }
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
          data: "domain",
        },
        {
          data: "group"
        },
        {
          data: "msisdn"
        },
        {
          data: "mother",
        },
        {
          data: "address"
        },
        {
          data: "city"
        },
        {
          data: "firstname"
        },
        {
          data: "email"
        },
        {
          data: "birthyear"
        },
        {
          data: "delegateby"
        }
      ]
    }).on("processing.dt", function(e, settings, processing) {
      $(".dataTables_processing").css("display", "none")
      if (processing) {
        $("#dt-siswa").css("display", "none")
        $("#custom-loading-dt-siswa").css("display", "block")
      } else {
        $("#dt-siswa").css("display", "block")
        $("#custom-loading-dt-siswa").css("display", "none")
      }
    })
    var ctx = document.getElementById('my-pie-chart');
    $.ajax({
      url: `${baseUrl}/admin/get-achievement`,
      type: "GET",
      success: function(data) {
        var result = JSON.parse(data)
        var total, target
        if (result.total === "1" && result.target === "0") {
          total = "0"
          target = "0"
        } else {
          total = result.total
          target = result.target
        }
        var pieChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ['Goal Achievement', 'Target Student Goal'],
            datasets: [{
              data: [total, target],
              backgroundColor: [
                '#55efc4',
                '#ff7675',
              ],
              borderColor: ['transparent', 'transparent'],
              borderWidth: [0, 0]
            }]
          },
          options: {
            tooltips: {
              callbacks: {
                label: function(tooltipItem, data) {
                  console.log(data)
                }
              }
            },
            maintainAspectRatio: true,
            responsive: true,
            legend: {
              position: 'top',
              onClick: (e) => e.stopPropagation() // Uncomment if you want click linethrough label
            },
            title: {
              display: true,
              fontSize: 17,
              text: 'Personal Achievement'
            },
            animation: {
              animateScale: true,
              animateRotate: true
            },
            tooltips: {
              enabled: true // Show label when hover
            },
            plugins: {
              labels: {
                precision: 0
              },
              datalabels: {
                formatter: (value, ctx) => {
                  var dataArr = ctx.chart.data.datasets[0].data
                  //   var sum = ctx.dataset._meta[0].total
                  //   var first = dataArr[0] // Goal Achievement
                  //   var second = dataArr[1] // Target Student Goal
                  //   var second = 
                  //   var percentage
                  //   if (first != 0) {
                  //     percentage = (value * 100 / 100 - first).toFixed(0) + "%"
                  //   } else {
                  //     percentage = (value * 100 / second).toFixed(0) + "%"
                  //   }
                  var first = parseInt(dataArr[0]) // Goal Achievement
                  var second = parseInt(dataArr[1]) // Target Student Goal
                  var goalAchievement = (first / second * 100).toFixed(0) + "%"
                  var targetStudentGoal = (100 - first / second * 100).toFixed(0) + "%"
                  if (first !== 0 && second === 0) {
                    return ctx.chart.data.labels[ctx.dataIndex] == "Goal Achievement" ? "0" : "0"
                  } else {
                    return ctx.chart.data.labels[ctx.dataIndex] == "Goal Achievement" ? goalAchievement : targetStudentGoal
                  }
                },
                color: '#fff',
                labels: {
                  title: {
                    font: {
                      size: 14
                    }
                  },
                }
              }
            }
          }
        });
      },
      error: function(data) {
        console.log(data)
      }
    })
    // Optional 1
    // document.addEventListener('DOMContentLoaded', function() {})
    $(function() {
      initializeCalendar()
      $("#event-calendar-create-btn").click(function(e) {
        e.preventDefault()
        var eventContent = $("#event-name-calendar").val()
        var dateCalendar = $("#date-calendar").val()
        var branches = $("#select-branches-event-calendar").val()
        try {
          if (eventContent == "") {
            throw new Error("Event Required")
          }
          if (dateCalendar == "") {
            throw new Error("Date Calendar Required")
          }
          if (branches == "") {
            throw new Error("Branch Required")
          }
          $("#event-calendar-create-btn").text("Process")
          $("#event-calendar-create-btn").prop("disabled", true)
          $.ajax({
            url: `${baseUrl}/admin/store-event`,
            type: "POST",
            data: {
              eventContent: eventContent,
              dateCalendar: dateCalendar,
              branches: branches
            },
            success: function(data) {
              if (data === "true") {
                initializeCalendar()
                swal("Successful", "Create Event", "success")
                $("#event-calendar-create-btn").text("Create")
                $("#event-calendar-create-btn").prop("disabled", false)
                $("#form-event-calendar").trigger("reset")
                $("#event-modal").modal('hide')
              } else {
                swal("Oops!", "There is something wrong!", "error")
                $("#event-calendar-create-btn").text("Create")
                $("#event-calendar-create-btn").prop("disabled", false)
              }
            },
            error: function(data) {
              console.log(data)
            }
          })
        } catch (err) {
          swal("Oops!", err.message, "error")
        }
      })

      function initializeCalendar() {
        var calendarEl = document.getElementById('full-calendar')
        var calendar = new FullCalendar.Calendar(calendarEl, {
          selectable: true,
          headerToolbar: {
            left: 'prev',
            center: 'next',
            right: 'title'
          },
          dateClick: function(info) {
            if (authRole == 3) {
              $("#event-modal").modal('show')
              $("#date-calendar").val(info.dateStr)
            }
          },
          select: function(info) {},
          eventClick: function(info) {
            info.jsEvent.preventDefault() // prevent to redirect url
            var date = moment(info.event.extendedProps.dateCustom).format("YYYY-MM-DD")
            $("#event-info-date-calendar").val(date)
            $("#event-info-modal").modal('show')
            if (authRole == 3 && typeof info.event.extendedProps.total !== "undefined") {
              $("#wrapper-event-info-total").css("display", "block")
              $("#event-info-total").val(info.event.extendedProps.total)
            } else {
              $("#wrapper-event-info-total").css("display", "none")
            }
            $("#event-info-name").val(info.event.extendedProps.desc)
            // if (typeof info.event.extendedProps.status == "undefined") {
            // $("#event-info-status-wrapper").css("display", "none")
            // } else {
            //  $("#event-info-status").val(info.event.extendedProps.status)
            // }
            if (typeof info.event.extendedProps.branch == "undefined" || info.event.extendedProps.branch == null) {
              $("#event-info-branch").val("All")
            } else {
              $("#event-info-branch").val(info.event.extendedProps.branch)
            }
            // console.log(info.event.title) // watching football
            // console.log(info.view.type) // in this case dayGridMonth
            // info.el.style.borderColor = 'red'; border color is red
          },
          // events: events
          eventSources: [{
              url: `${baseUrl}/admin/get-event`,
              method: 'GET',
              failure: function() {
                console.log('there was an error while fetching events!')
              },
              color: 'orange',
              textColor: 'white'
            },
            {
              url: `${baseUrl}/admin/get-event-delegate`,
              method: 'GET',
              failure: function() {
                console.log('there was an error while fetching events!')
              },
              color: 'blue',
              textColor: 'white'
            },
          ]
        });
        calendar.render();
      }
    })
  </script>

</body>

</html>