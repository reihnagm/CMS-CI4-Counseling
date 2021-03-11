<?php

namespace App\Controllers\Admin\Admission;

use App\Controllers\Base\BaseController;
use Config\Services;

class AdmissionController extends BaseController
{

  public function getStudentByAdmission($admissionStatus)
  {
    $newAdmissionStatus = str_replace("-", " ", $admissionStatus);
    $db = db_connect();
    $role = session('authenticated')->role;
    $authid = session('authenticated')->id;
    $resultStatuses = $db->query("SELECT * FROM omega_statuses_admission WHERE name = '$newAdmissionStatus'");
    $status = $resultStatuses->getResult()[0]->id;
    if ($role == 3) {
      $resultStatAdmission = $db->query("SELECT DISTINCT b.name, COUNT(a.status) status 
      FROM omega_students a
      RIGHT JOIN omega_statuses_admission b ON a.status = b.id
      GROUP BY b.id");
      $resultStudents = $db->query("SELECT a.id, a.msisdn, a.first_name, a.last_name, a.email, a.birth_date, a.birth_place,
      a.address, a.city, a.postal_code, a.parents, a.status, a.flag, a.school_id,
      a.created, a.updated, a.handled_by, a.admission_by, a.future, a.date, a.source, a.ssa_no,
      b.university_name, b.country_university, b.period_of_study, b.univ_program_of_study, b.current_level_of_study, c.fullname,
      d.name as university
      FROM omega_students a 
      LEFT JOIN omega_criteria b 
      ON b.student = a.id
      LEFT JOIN omega_users c 
      ON c.id = a.handled_by
      LEFT JOIN omega_universities d
      ON d.id = b.university_name
      WHERE a.status = '$status'");
    } else if ($role == 2) {
      $resultStatAdmission = $db->query("SELECT DISTINCT b.name, COUNT(a.status) status 
      FROM omega_students a
      RIGHT JOIN omega_statuses_admission b ON a.status = b.id
      GROUP BY b.id");
      $resultStudents = $db->query("SELECT a.id, a.msisdn, a.first_name, a.last_name, a.email, a.birth_date, a.birth_place,
      a.address, a.city, a.postal_code, a.parents, a.status, a.flag, a.school_id,
      a.created, a.updated, a.handled_by, a.admission_by, a.future, a.date, a.source, a.ssa_no,
      b.university_name, b.country_university, b.period_of_study, b.univ_program_of_study, b.current_level_of_study, c.fullname,
      d.name as university
      FROM omega_students a 
      LEFT JOIN omega_criteria b 
      ON b.student = a.id
      LEFT JOIN omega_users c 
      ON c.id = a.handled_by
      LEFT JOIN omega_universities d
      ON d.id = b.university_name
      WHERE a.status = '$status' AND a.handled_by = '$authid'");
    } else {
      $resultStatAdmission = $db->query("SELECT DISTINCT b.name, COUNT(a.status) status 
      FROM omega_students a
      RIGHT JOIN omega_statuses_admission b ON a.status = b.id
      GROUP BY b.id");
      $resultStudents = $db->query("SELECT a.id, a.msisdn, a.first_name, a.last_name, a.email, a.birth_date, a.birth_place,
      a.address, a.city, a.postal_code, a.parents, a.status, a.flag, a.school_id,
      a.created, a.updated, a.handled_by, a.admission_by, a.future, a.date, a.source, a.ssa_no,
      b.university_name, b.country_university, b.period_of_study, b.univ_program_of_study, b.current_level_of_study, c.fullname,
      d.name as university
      FROM omega_students a 
      LEFT JOIN omega_criteria b 
      ON b.student = a.id
      LEFT JOIN omega_users c 
      ON c.id = a.handled_by
      LEFT JOIN omega_universities d
      ON d.id = b.university_name
      WHERE a.status = '$status' AND a.admission_by = '$authid'");
    }
    $data["statusAdmission"] = $resultStatAdmission->getResult();
    $data["students"] = $resultStudents->getResult();
    return view('admission/index', $data);
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
    WHERE  a.id = '$studentId'");
    $resultStatusAdmission = $db->query("SELECT * FROM omega_statuses_admission");
    $resultUsers = $db->query("SELECT * FROM omega_users");
    $resultSch = $db->query("SELECT * FROM omega_schools");
    $resultSource = $db->query("SELECT * FROM omega_statuses_sources");
    $resultCriteria = $db->query("SELECT * FROM omega_criteria a
    LEFT JOIN omega_universities b
    ON a.university_name = b.id
    WHERE student = '$studentId'");
    $data["statuses"] = $resultSource->getResult();
    $data["schools"] = $resultSch->getResult();
    $data["users"] = $resultUsers->getResult();
    $data["statusAdmission"] = $resultStatusAdmission->getResult();
    $data["student"] = $resultStudent->getResult();
    $data["criteria"] = $resultCriteria->getResult();
    return view('admission/detail', $data);
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
}
