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
                  <?php if((int) session('authenticated')->role == 1 || (int) session('authenticated')->role == 2): ?>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-comments-tab" data-toggle="pill" href="#custom-tabs-one-comments" role="tab" aria-controls="custom-tabs-one-comments" aria-selected="false">Comments</a>
                  </li>
                  <?php endif; ?>
                  <?php if((int) session('authenticated')->role == 1 || (int) session('authenticated')->role == 2): ?>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-status" role="tab" aria-controls="custom-tabs-one-status" aria-selected="false">Status</a>
                  </li>
                  <?php endif; ?>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-one-info" role="tabpanel" aria-labelledby="custom-tabs-one-info-tab">
                    <button id="edit-student-btn-admission" type="button" class="btn btn-sm btn-primary" style="float: right;"><i class="fa fa-edit"></i> Edit
                    </button>
                    <table class="table">
                      <tbody>
                        <input type="hidden" id="id-student" value="<?= isset($student[0]->id) ?>">
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
                          <td><?= isset($student[0]->first_name) ? $student[0]->first_name : "-" ?> <?= isset($student[0]->last_name) ? $student[0]->last_name : "-"  ?></td>
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
                        <tr>
                          <td scope="row">University Name</td>
                          <td><?= isset($criteria[0]->name) ? $criteria[0]->name : "-" ?></td>
                        </tr>
                        <tr>
                          <td scope="row">Country University</td>
                          <td><?= isset($criteria[0]->country_university) ? $criteria[0]->country_university : "-" ?></td>
                        </tr>
                        <tr>
                          <td scope="row">Period of Study</td>
                          <td><?= isset($criteria[0]->period_of_study) ? $criteria[0]->period_of_study : "-" ?></td>
                        </tr>
                        <tr>
                          <td scope="row">Univ Program of Study</td>
                          <td><?= isset($criteria[0]->univ_program_of_study) ? $criteria[0]->univ_program_of_study : "-" ?></td>
                        </tr>
                        <tr>
                          <td scope="row">Current Level of Study</td>
                          <td><?= isset($criteria[0]->current_level_of_study) ? $criteria[0]->current_level_of_study : "-" ?></td>
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
                  <div class="tab-pane fade" id="custom-tabs-one-status" role="tabpanel" aria-labelledby="custom-tabs-one-messages-status">
                    <?php
                    $totalStatusAdmission = count($statusAdmission);
                    $i = 1;
                    ?>
                    <input type="hidden" id="status-admission-length" value="<?= $totalStatusAdmission ?>" />
                    <?php foreach ($statusAdmission as $stat) : ?>
                      <?php
                      if ($student[0]->status == "13") {
                        $disabled = $stat->id == "14" || $stat->id == "15" ? "disabled" : "";
                      } else {
                        $disabled = "";
                      }
                      ?>
                      <?php $i++; ?>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="status-admission" id="status-admission-<?= $i ?>" data-status-name="<?= $stat->name ?>" value="<?= $stat->id ?>" <?= $stat->id == $student[0]->status ? 'checked' :  $disabled ?>>
                        <label class="form-check-label" for="status-admission-<?= $i ?>">
                          <?= $stat->name ?>
                        </label>
                      </div>
                    <?php endforeach; ?>
                    <div class="col-sm-12 is-paddingless text-md-left">
                      <input class="btn btn-info mt-2" id="change-status-admission-btn" type="submit" value="Submit">
                    </div>
                  </div>
                </div>
              </div>
            </div>
      </section>
    </div>
  </div>

  <div class="modal fade" id="edit-student-admission" tabindex="-1" role="dialog">
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
                      <label>First Name</label>
                      <input type="text" class="form-control" name="first-name" id="fname" placeholder="First Name" minlength="2" required>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Last Name</label>
                      <input type="text" class="form-control" name="last-name" id="lname" placeholder="Last Name" minlength="2" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>No Handphone</label>
                      <input type="text" class="form-control" name="msisdn" id="msisdn" placeholder="No Handphone">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Email</label>
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
  <!-- REQUIRED SCRIPTS -->
  <?= view('template-master-admin/foot'); ?>

  <script>
    var studentId = '<?= $student[0]->id ?>';
    var studentUsername = '<?= $student[0]->first_name ?>';
    var statusChecked = '<?= $student[0]->status ?>';
    var username = '<?= session('authenticated')->username ?>';
    var statusAdmission = $("#status-admission-length").val()

    initializeSelectedAdmission()

    function initializeSelectedAdmission() {
      var z = 1
      for (var i = 0; i < statusAdmission; i++) {
        z++
        var admission = $(`#status-admission-${z}`)
        if (typeof admission.val() !== "undefined") {
          if (admission.val() === statusChecked) {
            $(`#status-admission-${z}`).prop("checked", true)
            break;
          }
        }
      }
    }

    $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
      var target = $(e.target).attr("href")
      if (target === "#custom-tabs-one-status") {
        initializeSelectedAdmission()
      }
    });
    initializeCommentList()

    function initializeCommentList() {
      $.ajax({
        url: `${baseUrl}/admin/student/list-comment`,
        type: "post",
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

    $("#change-status-admission-btn").click(function(e) {
      e.preventDefault()
      var arr = []
      var z = 1
      for (var i = 0; i < statusAdmission; i++) {
        z++
        var statusName = $(`#status-admission-${z}:checked`).attr("data-status-name")
        var status = $(`#status-admission-${z}:checked`).val()
        if (typeof statusName !== "undefined" && typeof status !== "undefined") {
          arr.push({
            statusName: statusName,
            status: status
          })
        }
      }
      $("#change-status-admission-btn").val("Process")
      $("#change-status-admission-btn").prop("disabled", true)
      $.ajax({
        url: `${baseUrl}/admin/admission-change-status`,
        type: "POST",
        data: {
          statusName: arr[0].statusName,
          studentId: studentId,
          studentUsername: studentUsername,
          status: arr[0].status
        },
        success: function(data) {
          if (data === "true") {
            $("#change-status-admission-btn").val("Submit")
            $("#change-status-admission-btn").prop("disabled", false)
            swal("Successfully", "Change Status", "success")
            window.location.reload()
          } else {
            $("#change-status-admission-btn").val("Submit")
            $("#change-status-admission-btn").prop("disabled", false)
            swal("Oops!", "There is something wrong", "error")
          }
        },
        error: function(data) {
          console.log(data)
        }
      })
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
    
    
    $("#edit-student-btn-admission").click(function (e) {
      e.preventDefault()
      $("#edit-student-admission").modal("show")
      $.ajax({
        url: `${baseUrl}/admin/student/edit-student-admission`,
        type: "POST",
        data: {
          studentId: studentId
        },
        success: function (data) {
          var result = JSON.parse(data)
          $("#fname").val(result.data[0].first_name)
          $("#lname").val(result.data[0].last_name)
          $("#msisdn").val(result.data[0].msisdn)
          $("#email").val(result.data[0].email)
          $("#birthdate").val(result.data[0].birth_date)
          $("#birthplace").val(result.data[0].birth_place)
          $("#city").val(result.data[0].city)
          $("#postal-code").val(result.data[0].postal_code)
          $("#address").val(result.data[0].address)
          $("#parents").val(result.data[0].parents)
          $("#select-sch").val(result.data[0].school)
          $("#select-id-sch").val(result.data[0].id_school)
          $("#select-source").val(result.data[0].source)
        },
        error: function (data) {
          swal("Oops!", "There is something wrong!", "error")
        }
      })
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