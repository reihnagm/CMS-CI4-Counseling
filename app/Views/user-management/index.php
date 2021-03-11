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
                            <h1>User Management</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card">
                    <div class="card-body">
                        <button type="submit" id="new-leads-btn" class="btn btn-primary">Add User</button>
                         <div>
                         <?php if(session('authenticated')->role == 3): ?>
                             <button id="add-branch-btn" type="button" 
                             class="btn btn-primary mb-3"> Add Branch </button>
                        <?php endif; ?>
                        </div>
                        <table id="data-user" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Fullname</th>
                                    <th>Role</th>
                                    <th>Branch</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                
              <div class="modal fade" id="modal-add-branch" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Add Branch</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="form-add-branch">
                          <div class="form-group">
                            <label>Branch Code</label>
                            <input type="number" class="form-control" name="add-branch-code" id="add-branch-code">
                          </div>
                          <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="add-branch-name" id="add-branch-name">
                          </div>
                          <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" name="add-branch-name" id="add-branch-city">
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" id="store-add-branch-btn" class="btn btn-primary">Create</button>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="modal fade" id="new-leads-modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card card-primary">
                                    <form id="form-add-user">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Fullname</label>
                                                        <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Fullname" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Role</label>
                                                <select name="role" id="role" class="form-control">
                                                    <?php foreach ($roles as $row) : ?>
                                                        <option value="<?= $row->id ?>"><?= $row->name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Branch</label>
                                                <select name="branch" id="branch" class="form-control">
                                                    <?php foreach ($branches as $row) : ?>
                                                        <option value="<?= $row->id ?>"><?= $row->name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="button" id="submit-user" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="edit-user" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card card-primary">
                                    <form id="form-add-user">
                                        <div class="card-body">
                                            <div class="row">
                                                <input type="text" id="id_user" hidden>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <input type="text" class="form-control" name="eusername" id="eusername" placeholder="Username" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Fullname</label>
                                                        <input type="text" class="form-control" name="efullname" id="efullname" placeholder="Fullname" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="epassword" id="epassword" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <label>Role</label>
                                                <select name="erole" id="erole" class="form-control">
                                                    <?php foreach ($roles as $row) : ?>
                                                        <option value="<?= $row->id ?>"><?= $row->name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Branch</label>
                                                <select name="ebranch" id="ebranch" class="form-control">
                                                    <?php foreach ($branches as $row) : ?>
                                                        <option value="<?= $row->id ?>"><?= $row->name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="estatus" id="estatus" class="form-control">
                                                    <option value="enabled">Enabled</option>
                                                    <option value="disabled">disabled</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="button" id="submit-update-user" class="btn btn-primary">Submit</button>
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
        $("#add-branch-btn").click(function(e) {
            e.preventDefault()
            $("#modal-add-branch").modal("show")
        })
        $("#store-add-branch-btn").click(function(e) {
            e.preventDefault()
            var code = $("#add-branch-code").val()
            var name = $("#add-branch-name").val()
            var city = $("#add-branch-city").val()
            $("#store-add-branch-btn").prop("disabled", true)
            $("#store-add-branch-btn").text("Process")
            try {
                if(code == "") {
                    throw new Error("Branch Code Required.")
                }
                if(name == "") {
                    throw new Error("Name Required.")
                }
                if(city == "") {
                   throw new Error("City Required.") 
                }
                $.ajax({
                  url: `${baseUrl}/admin/store-branch`,
                  type: "POST",
                  data: {
                    code: code,
                    name: name,
                    city: city
                  },
                  success: function(data) {
                    var result = JSON.parse(data)
                    if (result === true) {
                      swal("Successful", "Add Branches", "success")
                      location.reload()
                      $("#store-add-branch-btn").prop("disabled", false)
                      $("#store-add-branch-btn").text("Create")
                    } else {
                      $("#store-add-branch-btn").prop("disabled", false)
                      $("#store-add-branch-btn").text("Create")
                    }
                    if(result === "duplicate") {
                      swal("Info", "Duplicate Branches", "info")
                    }
                  },
                  error: function(data) {
                    console.log(data)
                  }
                })
            } catch(err) {
                $("#store-add-branch-btn").prop("disabled", false)
                $("#store-add-branch-btn").text("Create")
                swal("Oops!", err.message ,"error")
            }
        })
    </script>

</body>

</html>