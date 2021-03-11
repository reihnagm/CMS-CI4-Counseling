<?php

namespace App\Controllers\Admin\FollowUp;

use App\Controllers\Base\BaseController;
use Config\Services;

class FollowUpController extends BaseController
{

  public function getStudentByFollowUpStatus($followUpStatus)
  {
    $newFollowUpStatus = str_replace("-", " ", $followUpStatus);
    $db = db_connect();
    $role = (int) session('authenticated')->role;
    $userId = (int) session('authenticated')->id;
    $resultUsers = $db->query("SELECT id, username FROM omega_users WHERE role = 2");
    $resultStatuses = $db->query("SELECT * FROM omega_statuses_counselor WHERE name = '$newFollowUpStatus'");
    $status = $resultStatuses->getResult()[0]->id;
    if ($role == 3) {
      $resultStatFollowUp = $db->query("SELECT DISTINCT b.name, COUNT(a.status) status 
      FROM omega_students a
      RIGHT JOIN omega_statuses_counselor b ON a.status = b.id
      GROUP BY b.id");
      $resultStudents = $db->query("SELECT a.id, a.msisdn, a.first_name, b.username FROM omega_students a 
      LEFT JOIN omega_users b ON a.handled_by = b.id
      WHERE a.status = '$status'");
    } else {
      $resultStatFollowUp = $db->query("SELECT DISTINCT b.name, COUNT(a.status) status 
      FROM omega_students a
      RIGHT JOIN omega_statuses_counselor b ON a.status = b.id
      AND a.handled_by = '$userId'
      GROUP BY b.id");
      $resultStudents = $db->query("SELECT a.id, a.msisdn, a.first_name, b.username FROM omega_students a 
      LEFT JOIN omega_users b ON a.handled_by = b.id
      WHERE a.status = '$status' AND a.handled_by = '$userId'
      ");
    }
    $data["statusCounselor"] = $resultStatFollowUp->getResult();
    $data["users"] = $resultUsers->getResult();
    $data["students"] = $resultStudents->getResult();
    return view('followup/index', $data);
  }

  public function getStudentByFollowUpStatusDatatables($followUpStatus, $userCounselor)
  {
    $db = db_connect();
    $req = Services::request();
    $role = (int) session('authenticated')->role;
    $userId = (int) session('authenticated')->id;
    $newFollowUpStatus = str_replace("-", " ", $followUpStatus);
    $resultStatuses = $db->query("SELECT * FROM omega_statuses_counselor WHERE name = '$newFollowUpStatus'");
    $status = $resultStatuses->getResult()[0]->id;
    $columns = [
      0 => "username",
      1 => "msisdn",
      2 => "first_name"
    ];
    $search = $req->getPost("search")["value"];
    $limit = $req->getPost("length");
    $offset = $req->getPost("start");
    $order = $columns[$req->getPost("order")[0]["column"]];
    $dir = $req->getPost("order")[0]["dir"];
    if ($role == 3) {
      if ($search == "" && $userCounselor == "all") {
        $resultStudents = $db->query("SELECT a.id, a.msisdn, a.first_name, b.username FROM omega_students a 
        LEFT JOIN omega_users b ON a.handled_by = b.id
        WHERE a.status = '$status'
        ORDER BY $order $dir
        LIMIT $offset, $limit");
      } else if ($search == "" && $userCounselor != "all") {
        $resultStudents = $db->query("SELECT a.id, a.msisdn, a.first_name, b.username FROM omega_students a 
        LEFT JOIN omega_users b ON a.handled_by = b.id
        WHERE a.status = '$status'
        AND a.handled_by = '$userCounselor' 
        ORDER BY $order $dir
        LIMIT $offset, $limit");
      } else {
        $resultStudents = $db->query("SELECT a.id, a.msisdn, a.first_name, b.username FROM omega_students a 
        LEFT JOIN omega_users b ON a.handled_by = b.id
        WHERE a.status = '$status'
        AND a.handled_by = '$userId'
        OR a.first_name LIKE '%$search%' 
        OR a.msisdn LIKE '%$search%'
        OR b.username LIKE '%$search%'
        ORDER BY $order $dir
        LIMIT $offset, $limit");
      }
    } else {
      $resultStudents = $db->query("SELECT a.id, a.msisdn, a.first_name, b.username FROM omega_students a 
      LEFT JOIN omega_users b ON a.handled_by = b.id
      WHERE a.status = '$status' 
      AND a.handled_by = '$userId'
      ORDER BY $order $dir
      LIMIT $offset, $limit");
      // OR b.username = '$userCounselor'
      // OR a.first_name LIKE '%$search%' 
      // OR a.msisdn LIKE '%$search%'
      // OR b.username LIKE '%$search%'
    }
    $allTotal = count($resultStudents->getResult());
    $data = [];
    foreach ($resultStudents->getResult() as $result) {
      $nestedData['handledby'] = $result->username;
      $nestedData['msisdn'] = $result->msisdn;
      $nestedData['fullname'] = $result->first_name;
      $nestedData['action'] = '<a class="btn btn-sm btn-primary" href="' . base_url('/admin/follow-up-detail/' . $result->id) . '"><i class="fas fa-eye"></i> </a>';
      $data[] = $nestedData;
    }
    return json_encode([
      "draw" => intval($req->getPost('draw')),
      "recordsTotal" => intval($allTotal),
      "recordsFiltered" => intval($allTotal),
      "data" => $data
    ]);
  }

  public function detail($studentId)
  {
    $db = db_connect();
    $resultStudent = $db->query("SELECT a.id, a.msisdn, a.first_name, a.last_name, a.email,
    a.birth_date, a.birth_place, a.address, a.city, a.postal_code, a.parents, a.status,
    a.ssa_no, b.name as source, c.name as school 
    FROM omega_students a
    LEFT JOIN omega_statuses_sources b
    ON b.id = a.source
    LEFT JOIN omega_schools c
    ON c.id = a.school_id  
    WHERE a.id = '$studentId'");
    $resultStatusCounselor = $db->query("SELECT * FROM omega_statuses_counselor");
    $resultUsers = $db->query("SELECT * FROM omega_users WHERE role = '1'");
    $resultSch = $db->query("SELECT * FROM omega_schools");
    $resultSource = $db->query("SELECT * FROM omega_statuses_sources");
    $resultUniv = $db->query("SELECT * FROM omega_universities");
    $resultCountry = $db->query("SELECT DISTINCT id, country FROM omega_universities
    GROUP BY country");
    $data["universities"] = $resultUniv->getResult();
    $data["statuses"] = $resultSource->getResult();
    $data["schools"] = $resultSch->getResult();
    $data["users"] = $resultUsers->getResult();
    $data["countries"] = $resultCountry->getResult();
    $data["statusCounselor"] = $resultStatusCounselor->getResult();
    $data["student"] = $resultStudent->getResult();
    return view('followup/detail', $data);
  }

  public function changeStatus()
  {
    $db = db_connect();
    $req = Services::request();
    $userId = (int) session('authenticated')->id;
    $studentId = $req->getPost("studentId");
    $studentUsername = $req->getPost("studentUsername");
    $statusName = $req->getPost("statusName");
    $status = $req->getPost("status");
    $db->query("INSERT INTO omega_reports (date, user_id, student, status) VALUES(NOW(), '$userId', '$studentUsername', '$statusName')");
    $result = $db->simpleQuery("UPDATE omega_students SET status = '$status' WHERE id = '$studentId'");
    if ($result) {
      return json_encode(true);
    }
  }

  public function futureProspect()
  {
    $db = db_connect();
    $req = Services::request();
    $userId = (int) session('authenticated')->id;
    $studentId = $req->getPost("studentId");
    $studentUsername = $req->getPost("studentUsername");
    $future = $req->getPost("future");
    $statusName = $req->getPost("statusName");
    $db->query("INSERT INTO omega_reports (date, user_id, student, status) VALUES(NOW(), '$userId', '$studentUsername', '$statusName')");
    $result = $db->simpleQuery("UPDATE omega_students SET status = '5', future = '$future', date = NOW() WHERE id = '$studentId'");
    if ($result) {
      return json_encode(true);
    }
  }
}
