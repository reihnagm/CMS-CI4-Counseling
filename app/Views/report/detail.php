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
                  <?php if((int) session('authenticated')->role == 2 || (int) session('authenticated')->role == 1): ?>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-comments-tab" data-toggle="pill" href="#custom-tabs-one-comments" role="tab" aria-controls="custom-tabs-one-comments" aria-selected="false">Comments</a>
                    </li>
                  <?php endif; ?>
                  <!--<li class="nav-item">-->
                  <!--  <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-status" role="tab" aria-controls="custom-tabs-one-status" aria-selected="false">Status</a>-->
                  <!--</li>-->
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-one-info" role="tabpanel" aria-labelledby="custom-tabs-one-info-tab">
                    <table class="table">
                      <tbody>
                        <input type="hidden" id="id-student" value="<?= isset($student[0]->id) ? $student[0]->id : "" ?>">
                        <tr>
                          <td scope="row">Source</td>
                          <td><?= isset($student[0]->source) ? $student[0]->source : "-" ?></td>
                        </tr>
                        <tr>
                          <td scope="row">SSA No.</th>
                          <td><?= isset($student[0]->ssa_no) ? $student[0]->ssa_no : "-" ?></td>
                        </tr>
                        <tr>
                          <td scope="row">Fullname</th>
                          <td><?= isset($student[0]->first_name) ? $student[0]->first_name : "-" ?> <?= isset($student[0]->last_name) ? $student[0]->last_name : "-" ?></td>
                        </tr>
                        <tr>
                          <td scope="row">No Handphone</th>
                          <td><?= isset($student[0]->msisdn) ? $student[0]->msisdn : "-" ?></td>
                        </tr>
                        <tr>
                          <td scope="row">Email</th>
                          <td><?= isset($student[0]->email) ? $student[0]->email : "-" ?></td>
                        </tr>
                        <tr>
                          <td scope="row">Birth Date</th>
                          <td><?= isset($student[0]->birth_date) ? $student[0]->birth_date : "-" ?></td>
                        </tr>
                        <tr>
                          <td scope="row">Birth Place</th>
                          <td><?= isset($student[0]->birth_place) ? $student[0]->birth_place : "-" ?></td>
                        </tr>
                        <tr>
                          <td scope="row">City</th>
                          <td><?= isset($student[0]->city) ? $student[0]->city : "-" ?></td>
                        </tr>
                        <tr>
                          <td scope="row">Postal Code</th>
                          <td><?= isset($student[0]->postal_code) ? $student[0]->postal_code : "-" ?></td>
                        </tr>
                        <tr>
                          <td scope="row">Address</th>
                          <td><?= isset($student[0]->address) ? $student[0]->address : "-" ?></td>
                        </tr>
                        <tr>
                          <td scope="row">Parents</th>
                          <td><?= isset($student[0]->parents) ? $student[0]->parents : "-" ?></td>
                        </tr>
                        <tr>
                          <td scope="row">School</th>
                          <td><?= isset($student[0]->school) ? $student[0]->school : "-" ?></td>
                        </tr>
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
                      <input class="btn btn-info mt-2" id="comment-btn" type="submit" value="Komentar">
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
    var studentId = '<?= $student[0]->id ?>';
    var studentUsername = '<?= $student[0]->first_name ?>';
    var statusChecked = '<?= $student[0]->status ?>';
    var username = '<?= session('authenticated')->username ?>';
    $("#select-universities-by-country").prop("disabled", true)
    $("#select-country").on("change", function(e) {
      var country = $("#select-country").val()
      $.ajax({
        url: `${baseUrl}/admin/get-universities-name-by-country`,
        type: "POST",
        data: {
          country: country,
        },
        success: function(data) {
          if (data === "false") {
            $("#select-universities-by-country").prop("disabled", true)
            $("#select-universities-by-country").html("<option value='0'> Select Universities</option>")
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
    var followUpStatusCounselor = $("#follow-up-status-counselor-length").val()
    var z = 1
    for (var i = 0; i < followUpStatusCounselor; i++) {
      z++
      var status = $(`#follow-up-status-counselor-${z}:checked`).val()
      if (typeof status !== "undefined") {
        if (status == 7 || status == 6) {
          $("#change-status-follow-up-counselor-btn").css("display", "none")
        }
      }
    }

    initializeSelectedCounselor()

    function initializeSelectedCounselor() {
      var z = 1
      for (var i = 0; i < followUpStatusCounselor; i++) {
        z++
        var followup = $(`#follow-up-status-counselor-${z}`)
        if (typeof followup.val() !== "undefined") {
          if (followup.val() === statusChecked) {
            $(`#follow-up-status-counselor-${z}`).prop("checked", true)
            break;
          }
        }
      }
    }

    $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
      var target = $(e.target).attr("href")
      if (target === "#custom-tabs-one-status") {
        initializeSelectedCounselor()
      }
    });

    $("#btn-apply-staff-admission").css("display", "none")
    $("#select-staff-admission-wrapper").css("display", "none")
    $("#btn-apply-staff-admission").prop("disabled", true)
    initializeCommentList()

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
          if (result.comments !== "") {
            $(".pagination.comment").html(result.totalComment)
          }
        },
        error: function(data) {
          console.log(data)
        }
      })
    }

    var z = 1
    for (var i = 0; i < followUpStatusCounselor; i++) {
      z++
      $(document).on("change", `#follow-up-status-counselor-${z}`, function() {
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
    }

    $(document).on('change', '#select-staff-admission', function() {
      if ($(this).val() == 0) {
        $("#btn-apply-staff-admission").prop("disabled", true)
      } else {
        $("#btn-apply-staff-admission").prop("disabled", false)
      }
    })

    $("#change-status-follow-up-counselor-btn").click(function(e) {
      e.preventDefault()
      var arr = []
      var z = 1
      for (var i = 0; i < followUpStatusCounselor; i++) {
        z++
        var statusName = $(`#follow-up-status-counselor-${z}:checked`).attr("data-status-name")
        var status = $(`#follow-up-status-counselor-${z}:checked`).val()
        if (typeof statusName !== "undefined" && typeof status !== "undefined") {
          arr.push({
            statusName: statusName,
            status: status
          })
        }
      }
      $("#change-status-follow-up-counselor-btn").val("Process")
      $("#change-status-follow-up-counselor-btn").prop("disabled", true)
      $.ajax({
        url: `${baseUrl}/admin/follow-up-change-status`,
        type: "POST",
        data: {
          statusName: arr[0].statusName,
          studentId: studentId,
          studentUsername: studentUsername,
          status: arr[0].status
        },
        success: function(data) {
          if (data === "true") {
            $("#change-status-follow-up-counselor-btn").prop("disabled", false)
            $("#change-status-follow-up-counselor-btn").val("Submit")
            swal("Successfully", "Change Status", "success")
            window.location.reload()
          } else {
            $("#change-status-follow-up-counselor-btn").prop("disabled", false)
            $("#change-status-follow-up-counselor-btn").val("Submit")
            swal("Oops!", "There is something wrong", "error")
          }
        },
        error: function(data) {
          console.log(data)
        }
      })
    })

    $("#submit-future-prospect").click(function(e) {
      e.preventDefault()
      var arr = []
      var z = 1
      for (var i = 0; i < followUpStatusCounselor; i++) {
        z++
        var statusName = $(`#follow-up-status-counselor-${z}:checked`).attr("data-status-name")
        if (typeof statusName !== "undefined") {
          arr.push({
            statusName: statusName
          })
        }
      }
      var future = $("#future").val()
      try {
        if (future.trim() === "") {
          throw new Error("Date Required")
        }
        $("#submit-future-prospect").text("Process")
        $("#submit-future-prospect").prop("disabled", true)
        $.ajax({
          url: `${baseUrl}/admin/follow-up-future`,
          type: "POST",
          data: {
            statusName: arr[0].statusName,
            studentId: studentId,
            studentUsername: studentUsername,
            future: future
          },
          success: function(data) {
            if (data === "true") {
              swal("Successfully", "Create Future Prospect", "success")
              $("#submit-future-prospect").text("Submit")
              $("#submit-future-prospect").prop("disabled", false)
              window.location.reload()
            }
          },
          error: function(data) {
            console.log(data)
          }
        })
      } catch (err) {
        swal("Oops!", `${err.message}`, "error")
      }
    })


    $("#btn-apply-staff-admission").click(function(e) {
      e.preventDefault();
      var country = $("#select-country").val()
      var universities = $("#select-universities-by-country").val()
      var selectStaffAdmission = $("#select-staff-admission").val()
      var arr = []
      var z = 1
      for (var i = 0; i < followUpStatusCounselor; i++) {
        z++
        var status = $(`#follow-up-status-counselor-${z}:checked`).val()
        if (typeof status !== "undefined") {
          arr.push({
            status: status
          })
        }
      }
      var country_univ = $("#country_university").val();
      var period_study = $("#period_of_study").val();
      var period_to = $("#period_to").val();
      var univ_program = $("#univ_program").val();
      var current_level = $("#current_level").val();
      var period_study_period_to = period_study + " " + "-" + " " + period_to
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
        if (universities.trim() === "") {
          throw new Error("Univ Name Required")
        }
        if (country.trim() === "") {
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
            status: arr[0].status,
            univ_name: universities,
            country_univ: country,
            period_study: period_study_period_to,
            univ_program: univ_program,
            current_level: current_level
          },
          success: function(data) {
            if (data === "true") {
              $("#btn-apply-staff-admission").prop("disabled", false)
              swal("Successfully", "Delegate to Admission", "success")
              window.location.reload()
            } else {
              $("#btn-apply-staff-admission").prop("disabled", false)
              swal("Oops!", "There is something wrong", "error")
            }
          },
          error: function(data) {
            console.log(data)
          }
        })
      } catch (err) {
        swal("Oops!", `${err.message}`, "error")
      }
    })

    $("#comment-btn").click(function(e) {
      e.preventDefault()
      var commentContent = $("#comment-textarea").val()
      var commentDate = moment(new Date()).format("YYYY-MM-DD H:mm:ss")
      try {
        if (commentContent === "") {
          throw new Error("Comment Required")
        }
        $("#comment-btn").val("Process")
        $("#comment-btn").prop("disabled", true)
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
              $("#comment-btn").prop("disabled", false)
              $("#comment-btn").val("Komentar")
              $("#comment-content").append(`<div style="margin-bottom: 25px;"> <p class='user-comment'>${username}</p><p class='spacer-comment'>${commentContent}</p><p class='date-comment'>${commentDate}</p> </div>`)
              $("#comment-textarea").val("")
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