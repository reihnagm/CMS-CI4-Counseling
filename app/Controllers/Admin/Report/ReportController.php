<?php

namespace App\Controllers\Admin\Report;

use App\Controllers\Base\BaseController;
use Config\Services;

class ReportController extends BaseController
{

  public function index()
  {
    $db = db_connect();
    $resultReports = $db->query("SELECT a.date, a.student, a.status, a.comment, b.username FROM omega_reports a LEFT JOIN omega_users b ON a.user_id = b.id");
    $resultUsers = $db->query("SELECT * FROM omega_users");
    $data["users"] = $resultUsers->getResult();
    $data["reports"] = $resultReports->getResult();
    return view('report/index', $data);
  }
  
  public function detailReport($studentId) 
  {
    
    $db = db_connect();
    
    $resultStudent = $db->query("SELECT a.id, a.msisdn, a.first_name, a.last_name, a.email,
    a.birth_date, a.birth_place, a.address, a.city, a.postal_code, a.parents, a.status,
    a.ssa_no, b.name as source, c.name as school 
    FROM omega_students a
    LEFT JOIN omega_statuses_sources b ON b.id = a.source
    LEFT JOIN omega_schools c ON c.id = a.school_id  
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
    
    return view('report/detail', $data);
  
      
  }

  public function getDtReport($startDate, $endDate, $staff)
  {
    $db = db_connect();
    $authid = session('authenticated')->id;
    $req = Services::request();
    $limit = $req->getPost('length');
    $offset = $req->getPost('start');
    $search = $req->getPost('search')['value'];
    $getTotal = $db->query("SELECT * FROM omega_reports")->getResult();
    $allTotal = (int) count($getTotal);
    if ($search) {
      $results = $db->query("SELECT a.date, a.student, a.student_id, a.status, a.comment, b.username 
      FROM omega_reports a 
      LEFT JOIN omega_users b ON a.user_id = b.id
      WHERE a.student LIKE '%$search%'
      LIMIT $offset, $limit");
      $allTotal = (int) count($results->getResult());
    } else {
      if ($staff == "null") {
        if ((int) session('authenticated')->role == 3) {
          $results = $db->query("SELECT a.date, a.student, a.student_id, a.status, a.comment, b.username 
          FROM omega_reports a 
          LEFT JOIN omega_users b ON a.user_id = b.id
          WHERE a.date BETWEEN '$startDate' AND '$endDate' 
          LIMIT $offset, $limit");
        } else {
          $results = $db->query("SELECT a.date, a.student, a.student_id, a.status, a.comment, b.username 
          FROM omega_reports a 
          LEFT JOIN omega_users b ON a.user_id = b.id
          WHERE a.date BETWEEN '$startDate' AND '$endDate' 
          AND a.user_id = '$authid'
          LIMIT $offset, $limit");
        }
      } else {
        if ((int) session('authenticated')->role == 3) {
          $results = $db->query("SELECT a.date, a.student, a.student_id, a.status, a.comment, b.username 
          FROM omega_reports a 
          LEFT JOIN omega_users b ON a.user_id = b.id
          WHERE a.date BETWEEN '$startDate' AND '$endDate' 
          AND a.user_id = '$staff'
          LIMIT $offset, $limit");
        } else {
          $results = $db->query("SELECT a.date, a.student, a.student_id, a.status, a.comment, b.username 
          FROM omega_reports a
          LEFT JOIN omega_users b ON a.user_id = b.id
          WHERE a.date BETWEEN '$startDate' AND '$endDate' 
          AND a.user_id = '$authid'
          LIMIT $offset, $limit");
        }
      }
    }
    $data = [];
    
    foreach ($results->getResult() as $result) {
      $baseurl = base_url() .'/admin/report/detail/'.$result->student_id;
      $nestedData['date'] = $result->date;
      $nestedData['user'] = $result->username;
      $nestedData['student'] = '<a href="'.$baseurl.'">'.$result->student.'</a>';
      $nestedData['status'] = $result->status;
      $nestedData['comment'] = $result->comment;
      $data[] = $nestedData;
    }
    return json_encode([
      "draw" => intval($req->getPost('draw')),
      "recordsTotal" => intval($allTotal),
      "recordsFiltered" => intval($allTotal),
      "data" => $data
    ]);
  }
}
