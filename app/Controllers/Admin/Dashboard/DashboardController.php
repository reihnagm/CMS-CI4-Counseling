<?php

namespace App\Controllers\Admin\Dashboard;

use App\Controllers\Base\BaseController;
use Config\Services;

class DashboardController extends BaseController
{

  public function redirect()
  {
    return redirect()->to(base_url('admin/dashboard'));
  }

  public function index()
  {
    $db = db_connect();
    $role = (int) session('authenticated')->role;
    $userId = (int) session('authenticated')->id;
    if ($role == 3) {
      $resultStatFollowUp = $db->query("SELECT DISTINCT a.name, COUNT(CASE WHEN b.status = 7 THEN null ELSE b.status END) as status
      FROM omega_statuses_counselor a
      LEFT JOIN omega_students b ON a.id = b.status
      GROUP BY a.id");
      $resultStatAdmission = $db->query("SELECT DISTINCT b.name, COUNT(a.status) status 
      FROM omega_students a
      RIGHT JOIN omega_statuses_admission b ON a.status = b.id
      GROUP BY b.id");
    } else if ($role == 2) {
      //   $resultStatFollowUp = $db->query("SELECT DISTINCT b.name, COUNT(a.status) status 
      //   FROM omega_students a
      //   RIGHT JOIN omega_statuses_counselor b ON a.status = b.id
      //   AND a.handled_by = '$userId' 
      //   GROUP BY b.id");
      $resultStatFollowUp = $db->query("SELECT DISTINCT a.name, COUNT(CASE WHEN b.status = 7 THEN null ELSE b.status END) as status
      FROM omega_statuses_counselor a
      LEFT JOIN omega_students b ON a.id = b.status
      AND b.handled_by = '$userId' 
      GROUP BY a.id");
      if ($role == 2) {
        $resultStatAdmission = $db->query("SELECT DISTINCT b.name, COUNT(a.status) status 
        FROM omega_students a
        RIGHT JOIN omega_statuses_admission b ON a.status = b.id
        AND a.handled_by = '$userId'  
        GROUP BY b.id");
      } else {
        $resultStatAdmission = $db->query("SELECT DISTINCT b.name, COUNT(a.status) status 
        FROM omega_students a
        RIGHT JOIN omega_statuses_admission b ON a.status = b.id
        AND a.admission_by = '$userId'  
        GROUP BY b.id");
      }
    } else {
      $resultStatFollowUp = $db->query("SELECT DISTINCT b.name, COUNT(a.status) status 
      FROM omega_students a
      RIGHT JOIN omega_statuses_counselor b ON a.status = b.id
      AND a.handled_by = '$userId'  
      GROUP BY b.id");
      $resultStatAdmission = $db->query("SELECT DISTINCT b.name, COUNT(a.status) status 
      FROM omega_students a
      RIGHT JOIN omega_statuses_admission b ON a.status = b.id
      AND a.admission_by = '$userId'  
      GROUP BY b.id");
    }
    // FOR ADMISSION AND COUNSELOR
    // SELECT DISTINCT b.name, COUNT(a.status) status 
    // FROM omega_students a
    // RIGHT JOIN omega_statuses_counselor b ON a.status = b.id
    // AND a.handled_by = 1 
    // GROUP BY b.id 
    // FOR ADMIN
    // SELECT DISTINCT  b.name, COUNT(a.status) status 
    // FROM omega_students a
    // RIGHT JOIN omega_statuses_counselor b ON a.status = b.id
    // GROUP BY b.id
    // $resultStatAdmissions = $db->query("SELECT * FROM omega_statuses_admission");

    $resultAttachment = $db->query("SELECT a.url, a.content, b.name FROM omega_attachments a
      INNER JOIN omega_branches b ON a.branch_id = b.id 
    ");
    $resultUniv = $db->query("SELECT * FROM omega_universities");
    $resultSch = $db->query("SELECT * FROM omega_schools");
    $resultSource = $db->query("SELECT * FROM omega_statuses_sources");
    $resultQoute = $db->query("SELECT * FROM omega_qoutes");
    $resultCountry = $db->query("SELECT DISTINCT id, country FROM omega_universities
    GROUP BY country");
    $resultUser = $db->query("SELECT a.*, b.name FROM omega_users a 
      INNER JOIN omega_branches b ON a.branch_id = b.id
      WHERE a.role != 3
      ORDER BY a.id DESC
    ");
    $counselors = $db->query("SELECT * FROM omega_users a 
    INNER JOIN omega_branches b ON a.branch_id = b.id
    WHERE role = 2
    ORDER BY a.id DESC");
    $resultBranch = $db->query("SELECT * FROM omega_branches");
    $resultDomain = curlHelper('https://68.183.190.135:8081/api/domain/school', 'GET', []);
    $data["attachments"] = $resultAttachment->getResult();
    $data["domains"] = $resultDomain;
    $data["branches"] = $resultBranch->getResult();
    $data["countries"] = $resultCountry->getResult();
    $data["universities"] = $resultUniv->getResult();
    $data["schools"] = $resultSch->getResult();
    $data["statuses"] = $resultSource->getResult();
    $data["statusesFollowUp"] = $resultStatFollowUp->getResult();
    $data["statusesAdmissions"] = $resultStatAdmission->getResult();
    $data["qoutes"] = $resultQoute->getResult();
    $data["counselors"] = $counselors->getResult();
    $data["users"] = $resultUser->getResult();
    return view('dashboard/index', $data);
  }

  public function storeNewLeads()
  {
    $db = db_connect();
    $req = Services::request();
    $fname = $req->getPost("fname");
    $lname = $req->getPost("lname");
    $email = $req->getPost("email");
    $msisdn = $req->getPost("msisdn");
    $birthdate = $req->getPost("birthdate");
    $birthplace = $req->getPost("birthplace");
    $address = $req->getPost("address");
    $city = $req->getPost("city");
    $postalCode = $req->getPost("postalCode");
    $parents = $req->getPost("parents");
    $source = $req->getPost("source");
    $flag = 1;
    $handledBy = session('authenticated')->id;
    $sch = $req->getPost("sch");

    $checkSchool = $db->query("SELECT id FROM omega_schools WHERE name = '$sch' OR id = '$sch'")->getResult();
    if ($checkSchool == null) {
      $db->query("INSERT INTO omega_schools (name) VALUES ('$sch')");
      $sch = $db->insertID();
    }

    $result = $db->simpleQuery("INSERT INTO omega_students 
    (first_name, last_name, email, msisdn, birth_date, birth_place, address, city, 
    postal_code, parents, status, flag, school_id,
     created, updated, handled_by, source 
    ) 
    VALUES ('$fname', '$lname', '$email', '$msisdn', '$birthdate', '$birthplace', 
      '$address', '$city', '$postalCode', '$parents', '1',
      '$flag', '$sch', NOW(), NOW(), '$handledBy', '$source'
    )");
    if ($result) {
      return json_encode(true);
    }
  }

  public function getDtSiswa($domain, $city, $startDate, $endDate, $birthyear, $delegate)
  {
    $columns = [
      0 => 'domain',
      1 => 'group',
      2 => 'mother',
      3 => 'address',
      4 => 'city',
      5 => 'firstName',
      6 => 'email',
      7 => 'birthYear'
    ];
    $db = db_connect();
    $req = Services::request();
    $order = $columns[$req->getPost("order")[0]["column"]];
    $dir = $req->getPost("order")[0]["dir"];
    $limit = $req->getPost('length');
    $offset = $req->getPost('start');
    if ($domain == "all" && $city == "all") {
      $results = curlHelper('https://68.183.190.135:8081/api/people/school?startDate=' . $startDate . '&endDate=' . $endDate . '&birthYear=' . $birthyear . '&offset=' . $offset . '&limit=' . $limit . '&sort=' . $order . ',' . $dir, 'GET', []);
    } else {
      if ($domain == "all" && $city != "all") {
        $results = curlHelper('https://68.183.190.135:8081/api/people/school?startDate=' . $startDate . '&endDate=' . $endDate . '&city=' . $city . '&birthYear=' . $birthyear . '&offset=' . $offset . '&limit=' . $limit . '&sort=' . $order . ',' . $dir, 'GET', []);
      }
      if ($domain != "all" && $city == "all") {
        $results = curlHelper('https://68.183.190.135:8081/api/people/school?startDate=' . $startDate . '&endDate=' . $endDate . '&birthYear=' . $birthyear . '&domain=' . $domain . '&offset=' . $offset . '&limit=' . $limit . '&sort=' . $order . ',' . $dir, 'GET', []);
      }
      if ($domain != "all" && $city != "all") {
        $results = curlHelper('https://68.183.190.135:8081/api/people/school?startDate=' . $startDate . '&endDate=' . $endDate . '&birthYear=' . $birthyear . '&domain=' . $domain . '&city=' . $city . '&offset=' . $offset . '&limit=' . $limit . '&sort=' . $order . ',' . $dir, 'GET', []);
      }
    }
    if ($results->code == 500 || $results->code == 503) {
      return $this->getDtSiswaEmpty();
    }
    if ($delegate == "all") {
      $resultS = $db->query("SELECT a.msisdn, b.username
      FROM omega_students a LEFT JOIN omega_users b ON a.handled_by = b.id")->getResult();
    } else {
      $resultS = $db->query("SELECT a.msisdn, b.username
      FROM omega_students a LEFT JOIN omega_users b ON a.handled_by = b.id
      WHERE a.handled_by LIKE '%$delegate%'")->getResult();
    }
    $total = (int) count($results->body);
    $totalRecords = (int) $results->total;
    $data = [];
    for ($i = 0; $i < $total; $i++) {
      if (strpos($results->body[$i]->msisdn, "62") !== false) {
        $nestedData['msisdn'] = str_replace("62", "0", $results->body[$i]->msisdn);
      } else {
        $nestedData['msisdn'] = $results->body[$i]->msisdn;
      }
      $nestedData['domain'] = $results->body[$i]->domain;
      $nestedData['group'] = $results->body[$i]->group;
      $nestedData['mother'] =  $results->body[$i]->mother;
      $nestedData['address'] =  $results->body[$i]->address;
      $nestedData['city'] =  $results->body[$i]->city;
      $nestedData['firstname'] =  $results->body[$i]->firstName;
      $nestedData['email'] = $results->body[$i]->email;
      $nestedData['birthyear'] =  $results->body[$i]->birthYear;
      $found = false;
      foreach ($resultS as $s) {
        if ($s->msisdn == str_replace("62", "0", $results->body[$i]->msisdn)) {
          $nestedData['delegateby'] = "Delegate To " . $s->username;
          $found = true;
        }
      }
      if (!$found) {
        $nestedData['delegateby'] = "";
      }
      $data[] = $nestedData;
    }

    return json_encode([
      "draw" => intval($req->getPost('draw')),
      "recordsTotal" => intval($totalRecords),
      "recordsFiltered" => intval($totalRecords),
      "data" => $data
    ]);
  }

  public function getDtSiswaEmpty()
  {
    echo json_encode([
      "draw" => 0,
      "recordsFiltered" => 0,
      "recordsTotal" => 0,
      "data" => [],
    ]);
    exit();
  }

  public function getUniversitiesByCountry()
  {
    $db = db_connect();
    $req = Services::request();
    $country = $req->getPost("country");
    $universities = $db->query("SELECT a.website FROM omega_universities a INNER JOIN omega_universities b ON a.country = '$country' GROUP BY a.website")->getResult();
    if (count($universities) == 0) {
      return json_encode(false);
    }
    $temp = "";
    foreach ($universities as $university) {
      $website1 = str_replace('http://', '',  rtrim($university->website, "/, "));
      $website2 = str_replace('https://', '',  $website1);
      $temp .= "<option value=" . $website2 . ">" . $website2 . "</option>";
    }
    return json_encode($temp);
  }

  public function getUniversitiesNameByCountry()
  {
    $db = db_connect();
    $req = Services::request();
    $country = $req->getPost("country");
    $universities = $db->query("SELECT a.id, a.name FROM omega_universities a INNER JOIN omega_universities b ON a.country = '$country' GROUP BY a.name")->getResult();
    if (count($universities) == 0) {
      return json_encode(false);
    }
    $temp = "";
    foreach ($universities as $university) {
      $temp .= "<option value=" . $university->id . ">" . $university->name . "</option>";
    }
    return json_encode($temp);
  }

  public function delegateStaff()
  {
    $db = db_connect();
    $req = Services::request();
    $data = json_decode($req->getPost("data"));
    // Optional - 2
    // $values = "";
    // $comma = "";
    // $numOfItems = count($data);
    // $numCount = 0;
    for ($i = 0; $i < count($data); $i++) {
      $fname = $data[$i]->firstname;
      $msisdn = $data[$i]->msisdn;
      $city = $data[$i]->city;
      $birthyear = $data[$i]->birthyear;
      $address = $data[$i]->address;
      $parents = $data[$i]->mother;
      $checkStudentsLength = $db->query("SELECT COUNT(*) total FROM omega_students WHERE msisdn = '$msisdn'")->getResult();
      if ((int) $checkStudentsLength[0]->total == 1) {
        return json_encode(false);
      }
      $status = 1; // Default value : Unhandled
      $flag = 1;
      $sch = 1;  // Hardcode Temporary
      $handledBy = $req->getPost("handledBy");
      $resultUser = $db->query("SELECT a.*, b.name, b.code FROM omega_users a
      INNER JOIN omega_branches b ON a.branch_id = b.id 
      WHERE a.id = '$handledBy'")->getResult();
      $password = substr(md5(microtime()), rand(0, 26), 5);
      $noSSA = $resultUser[0]->code . "/" . shortCityName($resultUser[0]->name) . "/" . strtoupper($resultUser[0]->username) . "/" . date("m") . "-" . date("y");
      $db->query("INSERT INTO omega_students 
      (first_name, msisdn, 
      status, city, flag, school_id, address, birth_date, parents,
      created, updated, handled_by, source, password, ssa_no) 
      VALUES ('$fname', '$msisdn', '$status', '$city', '$flag', '$sch', '$address', '$birthyear', '$parents', NOW(), NOW(), '$handledBy', 1, '$password', '$noSSA')");
      $studentId = $db->insertID();
      $db->query("INSERT INTO omega_report_calendar (date, admission_by, counselor_by, student_id) VALUES(NOW(), '0', '$handledBy', '$studentId')");
      // Optional - 2
      // $numCount = $numCount + 1;
      // if ($numCount < $numOfItems) {
      //   $comma = ", ";
      // } else {
      //   $comma = " ";
      // }
      // $values .= "('$fname', '$msisdn', '', 1,
      // '1', '3', '1', NOW(), NOW(), '7'
      // )$comma";
    }
    // Optional - 2
    // $sql = "INSERT INTO omega_students 
    // (first_name, msisdn, birth_date, 
    // status, flag, university_id, school_id,
    // created, updated, handled_by) 
    // VALUES $values";
    // $db->query($sql);
    return json_encode(true);
  }

  public function delegateStaffAdmission()
  {
    $db = db_connect();
    $userId = session('authenticated')->id;
    
    $req = Services::request();
    
    $studentId = $req->getPost("studentId");
    $studentUsername = $req->getPost("studentUsername");
    $admissionBy = $req->getPost("admissionBy");
    $status = $req->getPost("status");
    $univ_name = $req->getPost("univ_name");
    $country_univ = $req->getPost("country_univ");
    $period_study = $req->getPost("period_study");
    $univ_program = $req->getPost("univ_program");
    $current_level = $req->getPost("current_level");

    $checkUniv = $db->query("SELECT id FROM omega_universities WHERE name = '$univ_name' OR id = '$univ_name'")->getResult();
    if ($checkUniv == null) {
      $db->query("INSERT INTO omega_universities (name, country) VALUES ('$univ_name', '$country_univ')");
    }
    
    $db->query("INSERT INTO omega_criteria (university_name, country_university, period_of_study, univ_program_of_study, current_level_of_study, student, admission_by) 
    VALUES('$univ_name', '$country_univ', '$period_study', '$univ_program', '$current_level', '$studentId', '$admissionBy')");
    $result = $db->query("UPDATE omega_students SET admission_by = '$admissionBy', status = '$status' WHERE id = '$studentId'");
    $studentId = $db->insertID();
    
    $db->query("INSERT INTO omega_reports (date, user_id, student_id, student) VALUES(NOW(), '$userId', '$studentId', '$studentUsername') ");
        
    $db->query("INSERT INTO omega_report_calendar (date, admission_by, counselor_by, student_id) VALUES(NOW(), '$admissionBy', '0', '$studentId')");

    if ((int) $result->connID->affected_rows == 1) {
      return json_encode(true);
    } else {
      return json_encode(false);
    }
    
  }

  public function getEventDelegate()
  {
    $db = db_connect();
    if ((int) session('authenticated')->role == 3) {
      $resultEventDelegate = $db->query("SELECT DISTINCT COUNT(*) total, a.date, a.date, d.name AS branch, GROUP_CONCAT(b.first_name SEPARATOR ', ') first_name, c.username
      FROM omega_report_calendar a 
      INNER JOIN omega_students b ON a.student_id = b.id
      INNER JOIN omega_users c ON a.counselor_by = c.id
      INNER JOIN omega_branches d ON d.id = c.branch_id
      GROUP BY a.date")->getResult();
    }
    if ((int) session('authenticated')->role == 2) {
      $authid = session('authenticated')->id;
      $resultEventDelegate = $db->query("SELECT DISTINCT COUNT(*) total, a.date, d.name AS branch, GROUP_CONCAT(b.first_name SEPARATOR ', ') first_name
      FROM omega_report_calendar a 
      INNER JOIN omega_students b ON a.student_id = b.id
      INNER JOIN omega_users c ON a.counselor_by = c.id 
      INNER JOIN omega_branches d ON d.id = c.branch_id
      WHERE c.id = '$authid'
      GROUP BY a.date")->getResult();
    }
    if ((int) session('authenticated')->role == 1) {
      $authid = session('authenticated')->id;
      $resultEventDelegate = $db->query("SELECT COUNT(*) total, a.date, d.name AS branch, GROUP_CONCAT(b.first_name SEPARATOR ', ') first_name
      FROM omega_report_calendar a 
      INNER JOIN omega_students b ON a.student_id = b.id
      INNER JOIN omega_users c ON a.admission_by = '$authid'
      INNER JOIN omega_branches d ON d.id = c.branch_id
      WHERE c.id = '$authid'
      GROUP BY a.date")->getResult();
    }
    $data = [];
    foreach ($resultEventDelegate as $eventDelegate) {
      if ((int) session("authenticated")->role == 1) {
        $status = "Apply";
      }
      if ((int) session("authenticated")->role == 2) {
        $status = "Unhandled";
      }
      if ((int) session("authenticated")->role == 3) {
        $status = "Unhandled";
      }
      $nestedData["status"] = $status;
      if ((int) session('authenticated')->role == 3) {
        $nestedData["desc"] = "Admin telah Delegate kepada $eventDelegate->username \nSiswa yang terpilih : $eventDelegate->first_name";
      }
      if ((int) session('authenticated')->role == 2) {
        $nestedData["desc"] = "Siswa yang terpilih : $eventDelegate->first_name";
      }
      if ((int) session('authenticated')->role == 1) {
        $nestedData["desc"] = "Siswa yang terpilih : $eventDelegate->first_name";
      }
      $nestedData["title"] = "Delegate";
      $nestedData["dateCustom"] = $eventDelegate->date;
      $nestedData["date"] = $eventDelegate->date;
      $nestedData["branch"] = $eventDelegate->branch;
      $nestedData["total"] = $eventDelegate->total;
      $data[] = $nestedData;
    }
    return json_encode($data);
  }

  public function getAchievement()
  {
    $db = db_connect();
    $authId = (int) session('authenticated')->id;
    $authRole = session('authenticated')->role;
    if ((int) $authRole == 2) {
      $resultAchievement = $db->query("SELECT DISTINCT IFNULL(SUM(CASE WHEN c.status = 13 THEN 1 ELSE 0 END), 0) AS total, IFNULL(b.target, 0) AS target 
      FROM omega_users a 
      LEFT JOIN omega_achievements b ON a.id = b.user_staff
      LEFT JOIN omega_students c ON a.id = c.handled_by
      WHERE a.id = '$authId'
      GROUP BY b.id
      ORDER BY b.id DESC
      ")->getResult();
    }
    if ((int) $authRole == 1) {
      $resultAchievement = $db->query("SELECT DISTINCT IFNULL(SUM(CASE WHEN c.status = 13 THEN 1 ELSE 0 END), 0) AS total, IFNULL(b.target, 0) AS target 
      FROM omega_users a 
      LEFT JOIN omega_achievements b ON a.id = b.user_staff
      LEFT JOIN omega_students c ON a.id = c.admission_by
      WHERE a.id = '$authId'
      GROUP BY b.id
      ORDER BY b.id DESC
      ")->getResult();
    }
    return json_encode([
      "total" => isset($resultAchievement[0]) ? $resultAchievement[0]->total : "0",
      "target" => isset($resultAchievement[0]) ? $resultAchievement[0]->target : "0"
    ]);
  }

  public function getEvent()
  {
    $db = db_connect();
    $resultEvent = $db->query("SELECT a.event, a.date, b.name FROM omega_events a LEFT JOIN omega_branches b ON a.branch_id = b.id")->getResult();
    $data = [];
    foreach ($resultEvent as $event) {
      $nestedData["title"] = "Event";
      $nestedData["desc"] = $event->event;
      $nestedData["date"] = $event->date;
      $nestedData["branch"] = $event->name;
      $data[] = $nestedData;
    }
    return json_encode($data);
  }

  public function storeAchievement()
  {
    $db = db_connect();
    $req = Services::request();
    $staff = $req->getPost("staff");
    $target = $req->getPost("target");
    $year = $req->getPost("year");
    $result = $db->query("INSERT INTO omega_achievements (user_staff, target, year) VALUES('$staff', '$target', '$year')");
    if ($result->connID->affected_rows == 1) {
      return json_encode(true);
    } else {
      return json_encode(false);
    }
  }

  public function storeEvent()
  {
    $db = db_connect();
    $req = Services::request();
    $eventContent = $req->getPost("eventContent");
    $dateCalendar = $req->getPost("dateCalendar");
    $branches = $req->getPost("branches");
    $result = $db->query("INSERT INTO omega_events (date, event, branch_id) VALUES ('$dateCalendar', '$eventContent', '$branches')");
    if ((int) $result->connID->affected_rows == 1) {
      return json_encode(true);
    } else {
      return json_encode(false);
    }
  }

  public function editQoutes()
  {
    $db = db_connect();
    $req = Services::request();
    $qouteId = $req->getPost("qouteId");
    $results = $db->query("SELECT * FROM omega_qoutes WHERE id = '$qouteId'")->getResult()[0];
    return json_encode($results);
  }
  public function updateQoutes()
  {
    $db = db_connect();
    $req = Services::request();
    $qouteId = $req->getPost("qouteId");
    $content = $req->getPost("qouteContent");
    $username = $req->getPost("qouteUsername");
    $result = $db->query('UPDATE omega_qoutes SET content = "' . $content . '", username = "' . $username . '" WHERE id = "' . $qouteId . '"');
    if ((int) $result->connID->affected_rows == 1) {
      return json_encode(true);
    } else {
      return json_encode(false);
    }
  }
  public function storeQoutes()
  {
    $db = db_connect();
    $req = Services::request();
    $content = $req->getPost("qouteContent");
    $username = $req->getPost("qouteUsername");
    $result = $db->query('INSERT INTO omega_qoutes (content, username) VALUES("' . $content . '", "' . $username . '")');
    if ((int) $result->connID->affected_rows == 1) {
      return json_encode(true);
    } else {
      return json_encode(false);
    }
  }
  public function storeBranch()
  {
    $db = db_connect();
    $req = Services::request();
    $code = $req->getPost("code");
    $name = $req->getPost("name");
    $city = strtolower($req->getPost("city"));
    $checkBranch = $db->query("SELECT COUNT(*) total FROM omega_branches WHERE code = $code OR city = '$city'")->getResult();

    if ((int) $checkBranch[0]->total == 1) {
      return json_encode("duplicate");
    }
    $result = $db->query('INSERT INTO omega_branches (code, name, city) VALUES(" ' . $code . '","' . $name . '", "' . $city . '")');
    if ((int) $result->connID->affected_rows == 1) {
      return json_encode(true);
    } else {
      return json_encode(false);
    }
  }
}
