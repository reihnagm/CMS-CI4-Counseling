<?php

namespace App\Controllers\Admin\Student;

use App\Controllers\Base\BaseController;
use Config\Services;

class StudentController extends BaseController
{

  public function listComment()
  {
    $db = db_connect();
    $authid = session('authenticated')->id;
    $studentId = $_POST['studentId'];
    $limit = 5;
    $page = isset($_POST['pageComment']) ? (int) $_POST['pageComment'] : 1;
    $currentPage = ($page > 1) ? ($page * $limit) - $limit : 0;
    // $previous = $page - 1;
    // $next = $page + 1;
    $result = $db->query("SELECT * FROM omega_comments WHERE student_id = '$studentId'");
    $total = count($result->getResult());
    $totalPage = ceil($total / $limit);
    $resultLimit = $db->query("SELECT * FROM omega_comments WHERE student_id = '$studentId' AND comment_by = '$authid' LIMIT $currentPage, $limit");
    $comments = $resultLimit->getResult();
    $tempComment = "";
    foreach ($comments as $comment) {
      $tempComment .= "
      <div style='margin-bottom: 25px;'>
        <p class='user-comment'>" . $comment->username . "<p/>
        <p class='spacer-comment'>" . $comment->comment . "<p/>
        <p class='date-comment'>" . $comment->created . "</p>
      </div>
      ";
    }
    $tempCommentPagination = "";
    for ($i = 1; $i <= $totalPage; $i++) {
      $tempCommentPagination .= "<li class='page-item'> <a onClick='togglePagination($i)' class='page-link' href='javascript:void(0)'>" . $i . "</a> </li>";
    }

    return json_encode([
      "comments" => $tempComment,
      "totalComment" =>  $tempCommentPagination
    ]);
  }

  public function sendComment()
  {
    $db = db_connect();
    $req = Services::request();
    $userId = session('authenticated')->id;
    $username = session('authenticated')->username;
    $studentUsername = $req->getPost('studentUsername');
    $studentId = $req->getPost('studentId');
    $commentContent = $req->getPost('commentContent');
   
    $db->query("INSERT INTO omega_reports (date, user_id, student_id, student, comment) VALUES(NOW(), '$userId', '$studentId', '$studentUsername', '$commentContent') ");
   
    $result = $db->simpleQuery("INSERT INTO omega_comments (username, comment, created, updated, student_id, comment_by) 
    VALUES ('$username', '$commentContent', NOW(), NOW(), '$studentId', '$userId') ");
    
    if ($result) {
      return json_encode(true);
    } else {
      return json_encode(false);
    }
    
  }

  public function searchStudent()
  {
    $db = db_connect();
    $request = Services::request();
    $student = $request->getPost('student');
    $result = $db->query("SELECT * FROM omega_students WHERE first_name LIKE '%$student%'")->getResult();
    $studentId = $result[0]->id;
    return json_encode($studentId);
  }

  public function search()
  {
    $db = db_connect();
    $session = Services::session();
    $id_user = session('authenticated')->id;
    $nameStudent = $_GET['name-student'];
    $msisdn = isset($_GET['msisdn']) ? $_GET['msisdn'] : null;

    if (session('authenticated')->role == "1") {
      $result = $db->query("SELECT a.id, a.msisdn, a.first_name, a.last_name, a.email,
      a.birth_date, a.birth_place, a.address, a.city, a.postal_code, a.parents, a.status,
      a.ssa_no, b.name as source, c.name as school 
      FROM omega_students a
      LEFT JOIN omega_statuses_sources b
      ON b.id = a.source
      LEFT JOIN omega_schools c
      ON c.id = a.school_id  
      WHERE a.first_name LIKE '%$nameStudent%' AND a.msisdn LIKE '%$msisdn%'")->getResult();
    }
    if (session('authenticated')->role == "2") {
      $result = $db->query("SELECT a.id, a.msisdn, a.first_name, a.last_name, a.email,
      a.birth_date, a.birth_place, a.address, a.city, a.postal_code, a.parents, a.status,
      a.ssa_no, b.name as source, c.name as school 
      FROM omega_students a
      LEFT JOIN omega_statuses_sources b
      ON b.id = a.source
      LEFT JOIN omega_schools c
      ON c.id = a.school_id  
      WHERE a.first_name LIKE '%$nameStudent%' AND a.msisdn LIKE '%$msisdn%'")->getResult();
    }
    if (session('authenticated')->role == "3") {
      $result = $db->query("SELECT a.id, a.msisdn, a.first_name, a.last_name, a.email,
      a.birth_date, a.birth_place, a.address, a.city, a.postal_code, a.parents, a.status,
      a.ssa_no, b.name as source, c.name as school 
      FROM omega_students a
      LEFT JOIN omega_statuses_sources b
      ON b.id = a.source
      LEFT JOIN omega_schools c
      ON c.id = a.school_id  
      WHERE a.first_name LIKE '%$nameStudent%' AND a.msisdn LIKE '%$msisdn%'")->getResult();
    }


    if (!isset($result[0]->id)) {
      $session->setFlashdata('msg_err', 'Student not found!');
      return redirect()->to(base_url('admin/dashboard'));
    }

    if (session('authenticated')->role == "1") {
      $resultStatusAdmission = $db->query("SELECT * FROM omega_statuses_admission");
      if (count($result) > 1) {
        $resultStudent = $result;
        $data["student"] = $resultStudent;
        $data["statusAdmission"] = $resultStatusAdmission->getResult();
      } else {
        $studentId = $result[0]->id;
        $resultStudent = $db->query("SELECT a.id, a.msisdn, a.first_name, a.last_name, a.email,
        a.birth_date, a.birth_place, a.address, a.city, a.postal_code, a.parents, a.status,
        a.ssa_no, b.name as source, c.name as school 
        FROM omega_students a
        LEFT JOIN omega_statuses_sources b
        ON b.id = a.source
        LEFT JOIN omega_schools c
        ON c.id = a.school_id  
        WHERE a.id = '$studentId'
        AND a.admission_by = '$id_user'")->getResult();
        $resultCriteria = $db->query("SELECT * FROM omega_criteria a
        LEFT JOIN omega_universities b
        ON a.university_name = b.id
        WHERE student = '$studentId'");
        $resultSch = $db->query("SELECT * FROM omega_schools");
        $resultSource = $db->query("SELECT * FROM omega_statuses_sources");
        $resultUniv = $db->query("SELECT * FROM omega_universities");
        $data["universities"] = $resultUniv->getResult();
        $data["statuses"] = $resultSource->getResult();
        $data["student"] = $resultStudent;
        $data["schools"] = $resultSch->getResult();
        $data["criteria"] = $resultCriteria->getResult();
        $data["statusAdmission"] = $resultStatusAdmission->getResult();
      }
    } else if (session('authenticated')->role == "2") {
      $resultStatusCounselor = $db->query("SELECT * FROM omega_statuses_counselor");
      if (count($result) > 1) {
        $resultStudent = $result;
        $data["student"] = $resultStudent;
        $data["statusCounselor"] = $resultStatusCounselor->getResult();
      } else {
        $studentId = $result[0]->id;
        $resultStudent = $db->query("SELECT a.id, a.msisdn, a.first_name, a.last_name, a.email,
        a.birth_date, a.birth_place, a.address, a.city, a.postal_code, a.parents, a.status,
        a.ssa_no, b.name as source, c.name as school 
        FROM omega_students a
        LEFT JOIN omega_statuses_sources b
        ON b.id = a.source
        LEFT JOIN omega_schools c
        ON c.id = a.school_id   
        WHERE a.id = '$studentId'
        AND a.handled_by = '$id_user'")->getResult();
        $resultSch = $db->query("SELECT * FROM omega_schools");
        $resultSource = $db->query("SELECT * FROM omega_statuses_sources");
        $resultCriteria = $db->query("SELECT * FROM omega_criteria a
        LEFT JOIN omega_universities b
        ON a.university_name = b.id
        WHERE student = '$studentId'");
        $resultUniv = $db->query("SELECT * FROM omega_universities");
        $data["universities"] = $resultUniv->getResult();
        $data["statuses"] = $resultSource->getResult();
        $data["schools"] = $resultSch->getResult();
        $data["criteria"] = $resultCriteria->getResult();
        $data["student"] = $resultStudent;
        $data["statusCounselor"] = $resultStatusCounselor->getResult();
      }
    } else {
      $resultStatusAdmission = $db->query("SELECT * FROM omega_statuses_admission");
      $resultStatusCounselor = $db->query("SELECT * FROM omega_statuses_counselor");
      if (count($result) > 1) {
        $resultStudent = $result;
        $data["student"] = $resultStudent;
        $data["statusAdmission"] = $resultStatusAdmission->getResult();
        $data["statusCounselor"] = $resultStatusCounselor->getResult();
      } else {
        $studentId = $result[0]->id;
        $resultStudent =  $db->query("SELECT a.id, a.msisdn, a.first_name, a.last_name, a.email,
        a.birth_date, a.birth_place, a.address, a.city, a.postal_code, a.parents, a.status,
        a.ssa_no, b.name as source, c.name as school 
        FROM omega_students a
        LEFT JOIN omega_statuses_sources b
        ON b.id = a.source
        LEFT JOIN omega_schools c
        ON c.id = a.school_id   
        WHERE a.id = '$studentId'")->getResult();
        $resultSch = $db->query("SELECT * FROM omega_schools");
        $resultSource = $db->query("SELECT * FROM omega_statuses_sources");
        $resultCriteria = $db->query("SELECT * FROM omega_criteria a
        LEFT JOIN omega_universities b
        ON a.university_name = b.id
        WHERE student = '$studentId'");
        $resultUniv = $db->query("SELECT * FROM omega_universities");
        $data["universities"] = $resultUniv->getResult();
        $data["statuses"] = $resultSource->getResult();
        $data["schools"] = $resultSch->getResult();
        $data["criteria"] = $resultCriteria->getResult();
        $data["student"] = $resultStudent;
        $data["statusAdmission"] = $resultStatusAdmission->getResult();
        $data["statusCounselor"] = $resultStatusCounselor->getResult();
      }
    }

    if (count($resultStudent) == 0) {
      $session->setFlashdata('msg_err', 'Student not found!');
      return redirect()->to(base_url('admin/dashboard'));
    }

    $resultUsers = $db->query("SELECT * FROM omega_users");
    $data["users"] = $resultUsers->getResult();
    return view('student/detail', $data);
  }

  public function editStudent()
  {
    $db = db_connect();
    $request = Services::request();
    $id = $request->getPost("id");
    $queryStudent = $db->query("SELECT a.id, a.msisdn, a.first_name, a.last_name, a.email,
    a.birth_date, a.birth_place, a.address, a.city, a.postal_code, a.parents, a.status,
    a.ssa_no, b.id as source, c.name as school, c.id as id_school
    FROM omega_students a
    LEFT JOIN omega_statuses_sources b
    ON b.id = a.source
    LEFT JOIN omega_schools c
    ON c.id = a.school_id  
    WHERE  a.id = '$id'");

    $data = [];
    foreach ($queryStudent->getResult() as $key => $value) {
      $nestedData['id'] = $value->id;
      $nestedData['msisdn'] = $value->msisdn;
      $nestedData['first_name'] = $value->first_name;
      $nestedData['last_name'] = $value->last_name;
      $nestedData['email'] = $value->email;
      $nestedData['birth_date']  = $value->birth_date;
      $nestedData['birth_place']  = $value->birth_place;
      $nestedData['address'] = $value->address;
      $nestedData['city'] = $value->city;
      $nestedData['postal_code']  = $value->postal_code;
      $nestedData['parents']  = $value->parents;
      $nestedData['status']  = $value->status;
      $nestedData['source']  = $value->source;
      $nestedData['school']  = $value->school;
      $nestedData['id_school']  = $value->id_school;
      $data[] = $nestedData;
    }
    echo json_encode([
      "data" => $data
    ]);
  }
  
  public function editStudentAdmission()
  {
    $db = db_connect();
    $request = Services::request();
    $id = $request->getPost("studentId");
    
    $queryStudent = $db->query("SELECT a.id, a.msisdn, a.first_name, a.last_name, a.email,
    a.birth_date, a.birth_place, a.address, a.city, a.postal_code, a.parents, a.status,
    a.ssa_no, b.id as source, c.name as school, c.id as id_school
    FROM omega_students a
    LEFT JOIN omega_statuses_sources b ON b.id = a.source
    LEFT JOIN omega_schools c ON c.id = a.school_id  
    WHERE a.id = '$id'");
    
    $data = [];
    foreach ($queryStudent->getResult() as $key => $value) {
      $nestedData['id'] = $value->id;
      $nestedData['msisdn'] = $value->msisdn;
      $nestedData['first_name'] = $value->first_name;
      $nestedData['last_name'] = $value->last_name;
      $nestedData['email'] = $value->email;
      $nestedData['birth_date']  = $value->birth_date;
      $nestedData['birth_place']  = $value->birth_place;
      $nestedData['address'] = $value->address;
      $nestedData['city'] = $value->city;
      $nestedData['postal_code']  = $value->postal_code;
      $nestedData['parents']  = $value->parents;
      $nestedData['status']  = $value->status;
      $nestedData['source']  = $value->source;
      $nestedData['school']  = $value->school;
      $nestedData['id_school']  = $value->id_school;
      $data[] = $nestedData;
    }
    echo json_encode([
      "data" => $data
    ]);
  }

  public function updateStudent()
  {
    $db = db_connect();
    $req = Services::request();
    $id = $req->getPost("id");
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
    $sch = $req->getPost("sch");

    $checkSchool = $db->query("SELECT id FROM omega_schools WHERE name = '$sch' OR id = '$sch'")->getResult();
    if ($checkSchool == null) {
      $db->query("INSERT INTO omega_schools (name) VALUES ('$sch')");
      $sch = $db->insertID();
    }

    $data = [
      'first_name' => $fname,
      'last_name' => $lname,
      'email' => $email,
      'msisdn' => $msisdn,
      'birth_date' => $birthdate,
      'birth_place' => $birthplace,
      'address' => $address,
      'city' => $city,
      'postal_code' => $postalCode,
      'parents' => $parents,
      'school_id' => $sch,
      'source' => $source,
    ];

    $builder = $db->table('omega_students');
    $builder->where('id', $id);
    $result = $builder->update($data);

    if ($result) {
      return json_encode(true);
    }
  }
}
