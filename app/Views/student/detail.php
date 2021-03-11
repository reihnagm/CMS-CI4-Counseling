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
            <div class="card card-primary card-outline card-tabs">
              <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-info-tab" data-toggle="pill" href="#custom-tabs-one-info" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false">Info</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-comments-tab" data-toggle="pill" href="#custom-tabs-one-comments" role="tab" aria-controls="custom-tabs-one-comments" aria-selected="false">Comments</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-status" role="tab" aria-controls="custom-tabs-one-status" aria-selected="false">Status</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-one-info" role="tabpanel" aria-labelledby="custom-tabs-one-info-tab">
                    <button id="edit-student-btn" type="button" class="btn btn-sm btn-primary" style="float: right;"><i class="fa fa-edit"></i> Edit
                    </button>
                    <table class="table">
                      <tbody>
                        <input type="hidden" id="id-student" value="<?= $student[0]->id ?>">
                        <tr>
                          <td scope="row">Source</td>
                          <td><?= $student[0]->source ?: "-" ?></td>
                        </tr>
                        <tr>
                          <td scope="row">SSA No.</th>
                          <td><?= $student[0]->ssa_no ?: "-" ?></td>
                        </tr>
                        <tr>
                          <td scope="row">Fullname</th>
                          <td><?= $student[0]->first_name ?: "-" ?> <?= $student[0]->last_name ?></td>
                        </tr>
                        <tr>
                          <td scope="row">No Handphone</th>
                          <td><?= $student[0]->msisdn ?: "-" ?></td>
                        </tr>
                        <tr>
                          <td scope="row">Email</th>
                          <td><?= $student[0]->email ?: "-" ?></td>
                        </tr>
                        <tr>
                          <td scope="row">Birth Date</th>
                          <td><?= $student[0]->birth_date ?: "-" ?></td>
                        </tr>
                        <tr>
                          <td scope="row">Birth Place</th>
                          <td><?= $student[0]->birth_place ?: "-" ?></td>
                        </tr>
                        <tr>
                          <td scope="row">City</th>
                          <td><?= $student[0]->city ?: "-" ?></td>
                        </tr>
                        <tr>
                          <td scope="row">Postal Code</th>
                          <td><?= $student[0]->postal_code ?: "-" ?></td>
                        </tr>
                        <tr>
                          <td scope="row">Adress</th>
                          <td><?= $student[0]->address ?: "-" ?></td>
                        </tr>
                        <tr>
                          <td scope="row">Parents</th>
                          <td><?= $student[0]->parents ?: "-" ?></td>
                        </tr>
                        <tr>
                          <td scope="row">School</th>
                          <td><?= $student[0]->school ?: "-" ?></td>
                        </tr>
                        <?php if (session('authenticated')->role == "1" || session('authenticated')->role == "3") : ?>
                          <tr>
                            <td scope="row">University Name</td>
                            <td><?= isset($criteria[0]) ? $criteria[0]->name : "-" ?></td>
                          </tr>
                          <tr>
                            <td scope="row">Country University</td>
                            <td><?= isset($criteria[0]) ? $criteria[0]->country_university : "-" ?></td>
                          </tr>
                          <tr>
                            <td scope="row">Period of Study</td>
                            <td><?= isset($criteria[0]) ? $criteria[0]->period_of_study : "-" ?></td>
                          </tr>
                          <tr>
                            <td scope="row">Univ Program of Study</td>
                            <td><?= isset($criteria[0]) ? $criteria[0]->univ_program_of_study : "-" ?></td>
                          </tr>
                          <tr>
                            <td scope="row">Current Level of Study</td>
                            <td><?= isset($criteria[0]) ? $criteria[0]->current_level_of_study : "-" ?></td>
                          </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-comments" role="tabpanel" aria-labelledby="custom-tabs-one-comments-tab">
                    <div class="row is-marginless">
                      <div id="comment-content">
                        <!-- Use Ajax -->
                      </div>
                    </div>
                    <nav>
                      <ul class="pagination comment justify-content-center">
                        <!-- Use Ajax -->
                      </ul>
                    </nav>
                    <textarea class="form-control" id="comment-textarea" rows="3"></textarea>
                    <div class="col-sm-12 is-paddingless text-md-right">
                      <!-- <input type="hidden" name="studentUsername" value="<?= $student[0]->first_name ?>">
                      <input type="hidden" name="studentId" value="<?= $student[0]->id ?>"> -->
                      <input class="btn btn-info mt-2" id="comment-btn" type="submit" value="Komentar">
                    </div>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-status" role="tabpanel" aria-labelledby="custom-tabs-one-messages-status">
                    <?php if (session('authenticated')->role == "2" || session('authenticated')->role == "3") : ?>
                      <div style="margin-bottom: 15px;">
                        <h3> Counselor </h3>
                        <?php foreach ($statusCounselor as $stat) : ?>
                          <?php
                          if ($student[0]->status == 1) {
                            $disabled = $stat->id == 2 ?: "";
                          }
                          if ($student[0]->status == 2) {
                            $disabled = $stat->id == 3 ?: "";
                          }
                          if ($student[0]->status == 3) {
                            $disabled = $stat->id == 4 ?: "";
                          }
                          if ($student[0]->status == 4) {
                            $disabled = $stat->id == 5 ?: "";
                          }
                          if ($student[0]->status == 5) {
                            $disabled = $stat->id == 7 ?: "";
                          }
                          if ($student[0]->status == 6) {
                            $disabled = "disabled";
                          }
                          if ($student[0]->status == 7) {
                            $disabled = $stat->id == 7 ?: "";
                            if ($stat->id == 6) {
                              $disabled = "disabled";
                            }
                          } else {
                            if ($stat->id == 6) {
                              $disabled = "";
                            }
                          }
                          ?>
                          <div class="form-check">
                            <?php if ($stat->name != "Prospect") : ?>
                              <input class="form-check-input" type="radio" name="follow-up-status-counselor" id="follow-up-status-counselor" data-status-name="<?= $stat->name ?>" value="<?= $stat->id ?>" <?= $stat->id == $student[0]->status ? 'checked' : $disabled ?>>
                              <label class="form-check-label" for="follow-up-status-counselor">
                                <?= $stat->name ?>
                              </label>
                            <?php endif; ?>
                          </div>
                        <?php endforeach; ?>
                        <?php if (session('authenticated')->role == "2") : ?>
                          <div class="col-sm-12 is-paddingless text-md-left">
                            <input class="btn btn-info mt-2" id="change-status-follow-up-counselor-btn" type="submit" value="Submit">
                          </div>
                        <?php endif; ?>
                        <br>
                        <div id="select-staff-admission-wrapper" class="form-group">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label>University Name</label>
                                  <input type="text" placeholder="University Name" class="form-control" list="list-univ" id="university_name" name="university_name" autocomplete="off">
                                  <datalist id="list-univ">
                                    <?php foreach ($universities as $row) : ?>
                                      <option data-value="<?= $row->id ?>" value="<?= $row->name ?>">
                                      <?php endforeach; ?>
                                  </datalist>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label>Country University</label>
                                  <input type="text" class="form-control" name="country_university" id="country_university" placeholder="Country University" required>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <div class="col-sm-6">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label>Period of Study</label>
                                      <input type="text" class="form-control" name="period_of_study" id="period_of_study" required placeholder="Period of Study">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="" style="color: white;">Halo</label>
                                      <input type="text" class="form-control" name="period_to" id="period_to" required placeholder="Period To Study">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label>Univ Program of Study</label>
                                  <input type="text" class="form-control" name="univ_program" id="univ_program" placeholder="Univ Program of study" required>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Current Level of study</label>
                            <input type="text" class="form-control" name="current_level" id="current_level" placeholder="Current Level of study" required>
                          </div>
                          <div class="form-group">
                            <label for="select-staff-admission">Select Staff Want You Delegate</label>
                            <select class="form-control" id="select-staff-admission">
                              <option value="0"> Select Staff </option>
                              <?php foreach ($users as $user) : ?>
                                <option value="<?= $user->id ?>"><?= $user->username ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <input id="btn-apply-staff-admission" type="submit" class="btn btn-info" value="Delegate">
                      <?php endif; ?>
                      <?php if (session('authenticated')->role == "1" || session('authenticated')->role == "3") : ?>
                        <h3> Admission </h3>
                        <?php foreach ($statusAdmission as $statAdmission) : ?>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="status-admission" id="status-admission" data-status-name="<?= $statAdmission->name ?>" value="<?= $statAdmission->id ?>" <?= $statAdmission->id == $student[0]->status ? 'checked' : "" ?>>
                            <label class="form-check-label" for="status-admission">
                              <?= $statAdmission->name ?>
                            </label>
                          </div>
                        <?php endforeach; ?>
                        <?php if (session('authenticated')->role == "1") : ?>
                          <div class="col-sm-12 is-paddingless text-md-left">
                            <input class="btn btn-info mt-2" id="change-status-admission-btn" type="submit" value="Submit">
                          </div>
                        <?php endif; ?>
                      <?php endif; ?>
                      </div>
                  </div>
                </div>
              </div>
      </section>
    </div>
  </div>

  <div class="modal fade" id="edit-student" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Leads</h5>
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
                      <label>Birthdate</label>
                      <input type="text" class="form-control" name="birthdate" id="birthdate" placeholder="Birthdate">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Birthplace</label>
                      <input type="text" class="form-control" name="birthplace" id="birthplace" placeholder="Birthplace">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>City</label>
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
                  <input type="text" id="select-id-sch" hidden>
                  <input type="text" class="form-control" list="list-school" id="select-sch" name="school" autocomplete="off">
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
                        <?php foreach ($statuses as $row) : ?>
                          <option value="<?= $row->id ?>"><?= $row->name ?></option>
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
          <button type="button" id="update-student-btn" class="btn btn-primary">Update</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="future-prospect" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Future Prospect</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-future">
            <div class="card-body">
              <div class="form-group">
                <label>Date Future</label>
                <input type="text" class="form-control" name="future" id="future" placeholder="Date Future">
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="button" id="submit-future-prospect" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>

  <!-- REQUIRED SCRIPTS -->
  <?= view('template-master-admin/foot'); ?>

  <script>
    var status = $("#follow-up-status-counselor:checked").val()
    if (status == 7 || status == 6) {
      $("#change-status-follow-up-counselor-btn").css("display", "none")
    }
    $("#btn-apply-staff-admission").css("display", "none")
    $("#smartwizard").smartWizard({
      selected: 0,
      theme: 'arrows'
    })
    $("#select-staff-admission-wrapper").css("display", "none")
    $("#btn-apply-staff-admission").prop("disabled", true)
    var studentId = '<?= $student[0]->id ?>';
    var studentUsername = '<?= $student[0]->first_name ?>';
    var username = '<?= session('authenticated')->username ?>';

    function initializeCommentList() {
      $.ajax({
        url: `${baseUrl}/admin/student/list-comment`,
        type: "POST",
        data: {
          studentId: studentId
        },
        success: function(data) {
          var result = JSON.parse(data)
          $("#comment-content").html(result.comments)
          $(".pagination.comment").html(result.totalComment)
        },
        error: function(data) {
          console.log(data)
        }
      })
    }

    initializeCommentList()

    $(document).on("change", "#follow-up-status-counselor", function() {
      if ($(this).val() == 7) {
        $("#select-staff-admission-wrapper").css("display", "block")
        $("#btn-apply-staff-admission").css("display", "block")
        $("#change-status-follow-up-counselor-btn").css("display", "none")
      } else {
        $("#select-staff-admission-wrapper").css("display", "none")
        $("#btn-apply-staff-admission").css("display", "none")
        $("#change-status-follow-up-counselor-btn").css("display", "block")
      }
      if ($(this).val() == 5) {
        $("#change-status-follow-up-counselor-btn").css("display", "none")
        $("#future-prospect").modal("show")
        var id = $("#id-student").val()

        $.ajax({
          url: `${baseUrl}/admin/student/edit-student`,
          type: "POST",
          data: {
            id: id
          },
          success: function(data) {
            var result = JSON.parse(data)
          },
          error: function(data) {
            console.log(data)
          }
        })
      }
    });

    $(document).on('change', '#select-staff-admission', function() {
      if ($(this).val() == "0") {
        $("#btn-apply-staff-admission").prop("disabled", true)
      } else {
        $("#btn-apply-staff-admission").prop("disabled", false)
      }
    })

    $("#change-status-follow-up-counselor-btn").click(function(e) {
      e.preventDefault()
      var statusName = $("#follow-up-status-counselor:checked").attr("data-status-name")
      var status = $("#follow-up-status-counselor:checked").val();
      $("#change-status-follow-up-counselor-btn").val("Process")
      $.ajax({
        url: `${baseUrl}/admin/follow-up-change-status`,
        type: "POST",
        data: {
          statusName: statusName,
          studentId: studentId,
          studentUsername: studentUsername,
          status: status
        },
        success: function(data) {
          if (data === "true") {
            $("#change-status-follow-up-counselor-btn").val("Submit")
            swal("Successful", "Change Status", "success")
            window.location.reload()
          } else {
            $("#change-status-follow-up-counselor-btn").val("Submit")
            swal("Error", "There is something wrong", "error")
          }
        },
        error: function(data) {
          console.log(data)
        }
      })
    })

    $("#submit-future-prospect").click(function(e) {
      e.preventDefault()
      var statusName = $("#follow-up-status-counselor:checked").attr("data-status-name")
      var future = $("#future").val()
      try {
        if (future.trim() === "") {
          throw new Error("Date Required")
        }
        $("#submit-future-prospect").text("Loading...")
        $.ajax({
          url: `${baseUrl}/admin/follow-up-future`,
          type: "POST",
          data: {
            statusName: statusName,
            studentId: studentId,
            studentUsername: studentUsername,
            future: future
          },
          success: function(data) {
            if (data === "true") {
              swal("Successful", "Create Future Prospect", "success")
              $("#form-attachment").trigger("reset")
              window.location.reload()
            }
          },
          error: function(data) {
            console.log(data)
          }
        })
      } catch (err) {
        swal("Error", `${err.message}`, "error")
      }
    })

    $("#btn-apply-staff-admission").click(function(e) {
      e.preventDefault();
      var selectStaffAdmission = $("#select-staff-admission").val()
      var status = $("#follow-up-status-counselor:checked").val();
      var country_univ = $("#country_university").val();
      var period_study = $("#period_of_study").val();
      var period_to = $("#period_to").val();
      var univ_program = $("#univ_program").val();
      var current_level = $("#current_level").val();
      var string = period_study + " " + "-" + " " + period_to
      var list_univ = $("#university_name").val();
      var univ_name = $("#list-univ option[value='" + list_univ + "']").attr('data-value');

      if (typeof univ_name === "undefined") {
        univ_name = list_univ
      }

      try {
        if (selectStaffAdmission.trim() === "") {
          throw new Error("Staff Required")
        }
        if (status.trim() === "") {
          throw new Error("Status Required")
        }
        if (univ_name.trim() === "") {
          throw new Error("Univ Name Required")
        }
        if (country_univ.trim() === "") {
          throw new Error("Country Univ Required")
        }
        if (period_study.trim() === "") {
          throw new Error("Period of Study Required")
        }
        if (period_to.trim() === "") {
          throw new Error("Period to Study Required")
        }
        if (current_level.trim() === "") {
          throw new Error("Current Level Required")
        }
        $("#btn-apply-staff-admission").prop("disabled", true)
        $.ajax({
          url: `${baseUrl}/admin/delegate-staff-admission`,
          type: "POST",
          data: {
            studentId: studentId,
            admissionBy: selectStaffAdmission,
            status: status,
            univ_name: univ_name,
            country_univ: country_univ,
            period_study: string,
            univ_program: univ_program,
            current_level: current_level
          },
          success: function(data) {
            if (data === "true") {
              $("#btn-apply-staff-admission").prop("disabled", false)
              swal("Sucessfuly", "Delegate to Admission", "success")
              window.location.reload()
            } else {
              $("#btn-apply-staff-admission").prop("disabled", false)
              swal("Error", "There is something wrong", "error")
            }
          },
          error: function(data) {
            console.log(data)
          }
        })
      } catch (e) {
        swal("Error", `${e.message}`, "error")
      }
    })

    $("#comment-btn").click(function(e) {
      e.preventDefault()
      var commentContent = $("#comment-textarea").val()
      var commentDate = moment(new Date()).format("YYYY-MM-DD H:mm:ss")
      $.ajax({
        url: `${baseUrl}/admin/student/send-comment`,
        type: "POST",
        data: {
          studentId: studentId,
          studentUsername: studentUsername,
          commentContent: commentContent
        },
        success: function(data) {
          if (data === "true") {
            initializeCommentList()
            $("#comment-content").append(`<div style="margin-bottom: 25px;"> <p class='user-comment'>${username}</p><p class='spacer-comment'>${commentContent}</p><p class='date-comment'>${commentDate}</p> </div>`)
            $("#comment-textarea").val("")
          }
        },
        error: function(data) {
          console.log(data)
        }
      })
    })

    function togglePagination(page) {
      $.ajax({
        url: `${baseUrl}/admin/student/list-comment`,
        type: "post",
        data: {
          studentId: studentId,
          pageComment: page
        },
        success: function(data) {
          var result = JSON.parse(data)
          $("#comment-content").html(result.comments)
          $(".pagination.comment").html(result.totalComment)
        },
        error: function(data) {
          console.log(data)
        }
      })
    }
  </script>

</body>

</html>