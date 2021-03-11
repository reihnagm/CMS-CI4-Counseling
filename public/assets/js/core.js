$(function () {
  var yestDate = moment().subtract(1, "days").format("YYYY-MM-DD")
  var tommDate = moment().add(1, "days").format("YYYY-MM-DD")
  $.ajaxSetup({
    cache: false
  })
  $("#calendar").datetimepicker({
    format: "L",
    inline: true,
    timepicker: false
  })
  $("#dt-admission").DataTable({
    searching: true,
    pagination: true,
    lengthChange: false,
    pageLength: 10
  })
  $("#dt-report").DataTable({
    dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4 mt-3 text-center export-button'B><'col-sm-12 col-md-4 mt-4 text-right'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    responsive: true,
    serverSide: true,
    retrieve: true,
    searching: true,
    processing: true,
    pagination: true,
    buttons: [
      {
        extend: "collection",
        text: "Export",
        className: "btn btn-success",
        buttons: [
          {
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
    ajax: {
      url: `${baseUrl}/admin/getDtReport/${yestDate}/${tommDate}/null`,
      dataType: "json",
      type: "POST",
      deferRender: true
    },
    language: {
      lengthMenu: "Show _MENU_ Per Page",
      processing: "Sedang memuat data... Mohon Tunggu"
    },
    columns: [
      {
        data: "no",
        searchable: false,
        orderable: false,
        render: function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1
        }
      },
      {
        data: "date"
      },
      {
        data: "user"
      },
      {
        data: "student"
      },
      {
        data: "status"
      },
      {
        data: "comment"
      }
    ]
  })

  $("#data-user").DataTable({
    dom: "<'row'<'col-sm-12 col-md-8'l><'col-sm-12 col-md-4 mt-4 text-right'>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    responsive: true,
    serverSide: true,
    retrieve: true,
    order: [],
    searching: false,
    // serverSide: true, DataTables stuck on “Processing” when sorting
    processing: true,
    buttons: [
      {
        extend: "collection",
        text: "Export",
        className: "btn btn-success",
        buttons: [
          {
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
      url: `${baseUrl}/admin/get-user`,
      dataType: "json",
      type: "POST",
      deferRender: true,
      dataSrc: function (json) {
        var data = {}
        data.draw = json.draw
        data.recordsTotal = json.recordsTotal
        data.recordsFiltered = json.recordsFiltered
        data.data = json.data
        return data.data
      }
    },
    columns: [
      {
        data: "no",
        searchable: false,
        orderable: false,
        render: function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1
        }
      },
      {
        data: "username"
      },
      {
        data: "fullname"
      },
      {
        data: "role"
      },
      {
        data: "branch"
      },
      {
        data: "status"
      },
      {
        data: "actions"
      }
    ]
  })
  // .on("processing.dt", function (e, settings, processing) {
  //   $("#processingIndicator").css("display", processing ? "block" : "none")
  // }) // If you want manually custom processing indicator

  // Detect tab trigger on URL

  // var url = document.location.toString()
  // if (url.match("#")) {
  //   $('.nav-tabs a[href="#' + url.split("#")[1] + '"]')
  //     .tab("show")
  //     .trigger("click")
  // }
  // $(".nav-tabs a").on("shown.bs.tab", function (e) {
  //   window.scrollTo(0, 0)
  //   window.location.hash = e.target.hash
  // })

  // Detect tab trigger on URL
  // var hash = window.location.hash
  // hash && $('ul.nav a[href="' + hash + '"]').tab("show")

  // $(".nav-tabs a").click(function (e) {
  //   e.preventDefault()
  //   $(this).tab("show")
  //   var scrollmem = $("body").scrollTop() || $("html").scrollTop()
  //   window.location.hash = this.hash
  //   $("html,body").scrollTop(scrollmem)
  // })

  $("#apply-filter-dt-siswa").click(function (e) {
    e.preventDefault()
    var startDateAndEndDate = $("#start-date-and-end-date").val()
    var year = $("#dropdown-birthyear").val()
    var startDate = new Date(startDateAndEndDate.split("-")[0])
    var endDate = new Date(startDateAndEndDate.split("-")[1].trim())
    var domain = $("#select-universities-by-country").val()
    var branch = $("#filter-city-datatables-siswa").val()
    if (branch === "") {
      branch = "all"
    }
    var startDateF = moment(startDate).format("YYYY-MM-DD")
    var endDateF = moment(endDate).format("YYYY-MM-DD")
    var selectStaffDt = $("#select-staff-datatables").val()
    $("#apply-filter-dt-siswa").prop("disabled", true)
    $("tr .odd").html('<td colspan="11" class="dataTables_empty" valign="top">No data available in table</td>')
    $("#dt-siswa").DataTable().ajax.url(`${baseUrl}/admin/getDtSiswa/${domain}/${branch}/${startDateF}/${endDateF}/${year}/${selectStaffDt}`).load()
  })

  $("#apply-filter-reset").click(function (e) {
    e.preventDefault()
    var defYestDate = moment().subtract(7, "days").format("YYYY-MM-DD")
    var defTommDate = moment().format("YYYY-MM-DD")
    $("#select-country-datatables").val("select-country")
    $("#select-universities-by-country").prop("disabled", true)
    $("#select-universities-by-country").html("<option value='all'> Select Universities </option>")
    $("#select-staff-datatables").val("all")
    $("#filter-city-datatables-siswa").val("all")
    $("#apply-filter-reset").prop("disabled", true)
    $("#dt-siswa").DataTable().ajax.url(`${baseUrl}/admin/getDtSiswa/all/all/${defYestDate}/${defTommDate}/2003/all`).load()
  })

  $("#apply-filter-report").click(function (e) {
    e.preventDefault()
    var startDateAndEndDate = $("#start-date-and-end-date-report").val()
    var staff = $("#select-staff-report").val()
    var startDate = new Date(startDateAndEndDate.split("-")[0])
    var endDate = new Date(startDateAndEndDate.split("-")[1].trim())
    var startDateF = moment(startDate).format("YYYY-MM-DD")
    var endDateF = moment(endDate).format("YYYY-MM-DD")
    $("#dt-report").DataTable().ajax.url(`${baseUrl}/admin/getDtReport/${startDateF}/${endDateF}/${staff}`).load()
  })

  $("#start-date-and-end-date").daterangepicker(
    {
      startDate: moment().subtract(7, "days"),
      endDate: moment(),
      opens: "top",
      drops: "up"
    },
    function (start, end, label) {
      start.format("YYYY-MM-DD")
      end.format("YYYY-MM-DD")
    }
  )
  $("#dropdown-birthyear").datepicker({
    format: "yyyy",
    viewMode: "years",
    minViewMode: "years"
  })
  $("#future").datepicker({
    format: "mm-yyyy",
    viewMode: "months",
    minViewMode: "months"
  })
  $("#start-date-and-end-date-report").daterangepicker(
    {
      startDate: moment().subtract(10, "days"),
      endDate: moment().add(10, "days"),
      opens: "left"
    },
    function (start, end, label) {
      start.format("YYYY-MM-DD")
      end.format("YYYY-MM-DD")
    }
  )

  $("#period_of_study").datepicker({
    format: "mm-yyyy",
    viewMode: "months",
    minViewMode: "months"
  })
  $("#period_to").datepicker({
    format: "mm-yyyy",
    viewMode: "months",
    minViewMode: "months"
  })
  $("#dropdown-birthyear-report").datepicker({
    format: "yyyy",
    viewMode: "years",
    minViewMode: "years"
  })
  $("#add-achievement-year").datepicker({
    format: "yyyy",
    viewMode: "years",
    minViewMode: "years"
  })
  $("#birthdate").datepicker({
    format: "yyyy-mm-dd"
  })
})

new Swiper(".swiper-container", {
  autoplay: {
    delay: 2800,
    disableOnInteraction: false
  }
})

$("#add-achievement-btn").click(function (e) {
  e.preventDefault()
  $("#add-achievement-modal").modal("show")
})

$("#store-achievement-btn").click(function (e) {
  e.preventDefault()
  var target = $("#add-achievement-target").val()
  var year = $("#add-achievement-year").val()
  var staff = $("#select-add-achievement-staff").val()
  try {
    if (target === "") {
      throw new Error("Target Required")
    }
    if (year === "") {
      throw new Error("Year Required")
    }
    if (staff === "") {
      throw new Error("Staff Required")
    }
    $("#store-achievement-btn").text("Process")
    $("#store-achievement-btn").prop("disabled", true)
    $.ajax({
      url: `${baseUrl}/admin/store-achievement`,
      type: "POST",
      data: {
        target: target,
        year: year,
        staff: staff
      },
      success: function (data) {
        if (data === "true") {
          swal("Successful", "Create Achievement Successful", "success")
          $("#store-achievement-btn").prop("disabled", false)
          $("#store-achievement-btn").text("Create")
          $("#form-add-achievement").trigger("reset")
          $("#store-achievement-btn").text("Create")
          window.location.reload()
        }
      },
      error: function (data) {
        swal("Oops!", "There is something wrong!", "error")
        $("#store-achievement-btn").prop("disabled", false)
      }
    })
  } catch (err) {
    swal("Oops!", err.message, "error")
  }
})

$("#new-leads-btn").click(function (e) {
  e.preventDefault()
  $("#new-leads-modal").modal("show")
})

$("#link-attachment-btn").click(function (e) {
  e.preventDefault()
  $("#attachment-modal").modal("show")
})

$("#edit-student-btn").click(function (e) {
  e.preventDefault()
  $("#edit-student").modal("show")
  var id = $("#id-student").val()
  $.ajax({
    url: `${baseUrl}/admin/student/edit-student`,
    type: "POST",
    data: {
      id: id
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

$("#update-student-btn").click(function (e) {
  e.preventDefault()
  var id = $("#id-student").val()
  var fname = $("#fname").val()
  var lname = $("#lname").val()
  var email = $("#email").val()
  var msisdn = $("#msisdn").val()
  var address = $("#address").val()
  var birthdate = $("#birthdate").val()
  var birthplace = $("#birthplace").val()
  var city = $("#city").val()
  var postalCode = $("#postal-code").val()
  var parents = $("#parents").val()
  var source = $("#select-source").val()
  var list_school = $("#select-sch").val()
  var sch = $("#list-school option[value='" + list_school + "']").attr("data-value")
  if (typeof sch === "undefined") {
    sch = list_school
  }
  $("#update-student-btn").text("Process")
  $("#update-student-btn").prop("disabled", true)
  $.ajax({
    url: `${baseUrl}/admin/student/update-student`,
    type: "POST",
    data: {
      id: id,
      fname: fname,
      lname: lname,
      email: email,
      msisdn: msisdn,
      address: address,
      city: city,
      birthdate: birthdate,
      birthplace: birthplace,
      postalCode: postalCode,
      parents: parents,
      source: source,
      sch: sch
    },
    success: function (data) {
      if (data === "true") {
        swal("Successful", "Update", "success")
        $("#update-student-btn").prop("disabled", false)
        $("#update-student-btn").text("Update")
        $("#form-new-leads").trigger("reset")
        window.location.reload()
      }
    },
    error: function (data) {
      swal("Oops!", "There is something wrong!", "error")
    }
  })
})

function validateEmail(email) {
  const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
  return re.test(String(email).toLowerCase())
}

$("#store-new-leads-btn").click(function (e) {
  e.preventDefault()
  var fname = $("#fname").val()
  var lname = $("#lname").val()
  var email = $("#email").val()
  var msisdn = $("#msisdn").val()
  var address = $("#address").val()
  var birthdate = $("#birthdate").val()
  var birthplace = $("#birthplace").val()
  var city = $("#city").val()
  var postalCode = $("#postal-code").val()
  var parents = $("#parents").val()
  var source = $("#select-source").val()
  var list_school = $("#select-sch").val()
  var sch = $("#list-school option[value='" + list_school + "']").attr("data-value")

  if (typeof sch === "undefined") {
    sch = list_school
  }

  try {
    if (fname.trim() === "") {
      throw new Error("First Name Required")
    }
    if (lname.trim() === "") {
      throw new Error("Last Name Required")
    }
    if (msisdn.trim() === "") {
      throw new Error("No Handphone Required")
    }
    if (email.trim() === "") {
      throw new Error("Email Required")
    }
    if (!validateEmail(email)) {
      throw new Error("Invalid Email, Ex :johndoe@gmail.com")
    }
    if (birthdate.trim() === "") {
      throw new Error("Birthdate Required")
    }
    if (birthplace.trim() === "") {
      throw new Error("Birthplace Required")
    }
    if (city.trim() === "") {
      throw new Error("City Required")
    }
    if (address.trim() === "") {
      throw new Error("Address Required")
    }
    if (source.trim() === "") {
      throw new Error("Source Required")
    }
    if (sch.trim() === "") {
      throw new Error("School Required")
    }
    $("#store-new-leads-btn").text("Process")
    $("#store-new-leads-btn").prop("disabled", true)
    $.ajax({
      url: `${baseUrl}/admin/store-new-leads`,
      type: "POST",
      data: {
        fname: fname,
        lname: lname,
        email: email,
        msisdn: msisdn,
        address: address,
        city: city,
        birthdate: birthdate,
        birthplace: birthplace,
        postalCode: postalCode,
        parents: parents,
        source: source,
        sch: sch
      },
      success: function (data) {
        if (data === "true") {
          swal("Successful", "Create New Lead", "success")
          $("#form-new-leads").trigger("reset")
          $("#store-new-leads-btn").text("Add New Leads")
          $("#store-new-leads-btn").prop("disabled", false)
          window.location.reload()
        }
      },
      error: function (data) {
        console.log(data)
      }
    })
  } catch (err) {
    swal("Oops!", `${err.message}`, "error")
  }
})

$("#logout").click(function (e) {
  e.preventDefault()
  var logout = confirm("Are you sure to logout?")
  if (logout) {
    location.href = baseUrl + "/admin/auth/logout"
  }
})

$("#submit-user").click(function (e) {
  e.preventDefault()
  var username = $("#username").val()
  var fullname = $("#fullname").val()
  var password = $("#password").val()
  var role = $("#role").val()
  var branch = $("#branch").val()
  try {
    if (username.trim() === "") {
      throw new Error("Username Required")
    }
    if (fullname.trim() == "") {
      throw new Error("Fullname Required")
    }
    if (password.trim() == "") {
      throw new Error("Password Required")
    }
    if (role.trim() == "") {
      throw new Error("Role Required")
    }
    if (branch.trim() == "") {
      throw new Error("Branch Required")
    }
    $("#submit-user").text("Process")
    $("#submit-user").prop("disabled", true)
    $.ajax({
      url: `${baseUrl}/admin/store-user`,
      type: "POST",
      data: {
        username: username,
        fullname: fullname,
        password: password,
        role: role,
        branch: branch
      },
      success: function (data) {
        if (data === "true") {
          swal("Successful", "Create User", "success")
          $("#form-add-user").trigger("reset")
          $("#submit-user").text("Submit")
          $("#submit-user").prop("disabled", false)
          window.location.reload()
        }
      },
      error: function (data) {
        console.log(data)
      }
    })
  } catch (err) {
    swal("Error", `${err.message}`, "error")
  }
})

function getUserByID(id) {
  $("#edit-user").modal("show")
  $.ajax({
    url: `${baseUrl}/admin/edit-user`,
    type: "POST",
    data: {
      id: id
    },
    success: function (data) {
      var result = JSON.parse(data)
      $("#id_user").val(result.data[0].id_user)
      $("#eusername").val(result.data[0].username)
      $("#efullname").val(result.data[0].fullname)
      $("#erole").val(result.data[0].role_id)
      $("#ebranch").val(result.data[0].branch_id)
      $("#estatus").val(result.data[0].status)
    },
    error: function (data) {
      swal("Oops!", "There is something wrong!", "error")
    }
  })
}

$("#submit-update-user").click(function (e) {
  e.preventDefault()
  var id_user = $("#id_user").val()
  var username = $("#eusername").val()
  var fullname = $("#efullname").val()
  var password = $("#epassword").val()
  var role = $("#erole").val()
  var branch = $("#ebranch").val()
  var status = $("#estatus").val()
  try {
    if (username.trim() === "") {
      throw new Error("Username Required")
    }
    if (fullname.trim() == "") {
      throw new Error("Fullname Required")
    }
    if (role.trim() == "") {
      throw new Error("Role Required")
    }
    if (branch.trim() == "") {
      throw new Error("Branch Required")
    }
    if (status.trim() == "") {
      throw new Error("Status Required")
    }
    $("#submit-update-user").text("Process")
    $("#submit-update-user").prop("disabled", true)
    $.ajax({
      url: `${baseUrl}/admin/update-user`,
      type: "POST",
      data: {
        id_user: id_user,
        username: username,
        fullname: fullname,
        password: password,
        role: role,
        branch: branch,
        status: status
      },
      success: function (data) {
        if (data === "true") {
          swal("Successful", "Update User", "success")
          $("#submit-update-user").text("Submit")
          $("#submit-update-user").prop("disabled", false)
          window.location.reload()
        }
      },
      error: function (data) {
        swal("Oops!", "There is something wrong!", "error")
      }
    })
  } catch (err) {
    swal("Oops!", `${err.message}`, "error")
  }
})

$("#attachment-btn").click(function (e) {
  e.preventDefault()
  var attachment = $("#attachment").val()
  var content = $("#content").val()
  var branch = $("#select-branch-attachment").val()
  try {
    if (attachment.trim() === "") {
      throw new Error("Attachment Required")
    }
    if (content.trim() === "") {
      throw new Error("Attachment Required")
    }
    $("#attachment-btn").text("Process")
    $("#attachment-btn").prop("disabled", true)
    $.ajax({
      url: `${baseUrl}/admin/store-attachment`,
      type: "POST",
      data: {
        attachment: attachment,
        content: content,
        branch: branch
      },
      success: function (data) {
        if (data === "true") {
          swal("Successful", "Create Link Attachment", "success")
          $("#form-attachment").trigger("reset")
          $("#attachment-btn").text("Submit")
          $("#attachment-btn").prop("disabled", false)
        }
      },
      error: function (data) {
        console.log(data)
      }
    })
  } catch (err) {
    swal("Oops!", `${err.message}`, "error")
  }
})

$("#student").bind("keypress", function (e) {
  if (e.keyCode == 13) {
    return false
  }
})

// $("#search-student").click(function (e) {
//   e.preventDefault()
//   var student = $("#student").val()
//   try {
//     if (student.trim() === "") {
//       throw new Error("Student Required")
//     }
//     $.ajax({
//       url: `${baseUrl}/admin/student/search-student`,
//       type: "POST",
//       data: {
//         student: student
//       },
//       success: function (data) {
//         var studentId = JSON.parse(data)
//         location.href = `${baseUrl}/admin/student/search-student/${studentId}`
//       },
//       error: function (data) {
//         console.log(data)
//       }
//     })
//   } catch (e) {
//     swal("Error", `${e.message}`, "error")
//   }
// })
