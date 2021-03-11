<?php

namespace Config;

$routes = Services::routes();
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
  require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('DashboardController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

// Home
$routes->get('/', 'HomeController::index', ['namespace' => 'App\Controllers\Home']);

$routes->group('admin', function ($routes) {

  // Dashboard
  $routes->get('/', 'DashboardController::redirect', ['namespace' => 'App\Controllers\Admin\Dashboard']);
  $routes->get('dashboard', 'DashboardController::index', ['namespace' => 'App\Controllers\Admin\Dashboard']);

  // Auth
  $routes->group('auth', function ($routes) {
    $routes->get('login', 'AuthController::loginView', ['namespace' => 'App\Controllers\Admin\Auth']);
    $routes->post('login', 'AuthController::loginPost', ['namespace' => 'App\Controllers\Admin\Auth']);
    $routes->get('logout', 'AuthController::logout', ['namespace' => 'App\Controllers\Admin\Auth']);
  });

  // Student 
  $routes->group('student', function ($routes) {
    $routes->post('list-comment', 'StudentController::listComment', ['namespace' => 'App\Controllers\Admin\Student']);
    $routes->post('send-comment', 'StudentController::sendComment', ['namespace' => 'App\Controllers\Admin\Student']);
    $routes->get('search', 'StudentController::search', ['namespace' => 'App\Controllers\Admin\Student']);
    // $routes->get('search-student/(:any)', 'StudentController::searchStudentByID/$1', ['namespace' => 'App\Controllers\Admin\Student']);
    $routes->post('edit-student', 'StudentController::editStudent', ['namespace' => 'App\Controllers\Admin\Student']);
    $routes->post('edit-student-admission', 'StudentController::editStudentAdmission', ['namespace' => 'App\Controllers\Admin\Student']);
    $routes->post('update-student', 'StudentController::updateStudent', ['namespace' => 'App\Controllers\Admin\Student']);
  });
  
  // Branch
  $routes->post('store-branch', 'DashboardController::storeBranch', ['namespace' => 'App\Controllers\Admin\Dashboard']);
  
  // Qoute
  $routes->post('edit-qoutes', 'DashboardController::editQoutes', ['namespace' => 'App\Controllers\Admin\Dashboard']);
  $routes->post('store-qoutes', 'DashboardController::storeQoutes', ['namespace' => 'App\Controllers\Admin\Dashboard']);
  $routes->post('update-qoutes', 'DashboardController::updateQoutes', ['namespace' => 'App\Controllers\Admin\Dashboard']);

  // Ajax
  $routes->post('get-universities-by-country', 'DashboardController::getUniversitiesByCountry', ['namespace' => 'App\Controllers\Admin\Dashboard']);
  $routes->post('get-universities-name-by-country', 'DashboardController::getUniversitiesNameByCountry', ['namespace' => 'App\Controllers\Admin\Dashboard']);

  // Datatables
  $routes->post('getDtReport/(:any)/(:any)/(:any)', 'ReportController::getDtReport/$1/$2/$3', ['namespace' => 'App\Controllers\Admin\Report']);
  $routes->post('getDtSiswa/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)', 'DashboardController::getDtSiswa/$1/$2/$3/$4/$5/$6', ['namespace' => 'App\Controllers\Admin\Dashboard']);
  $routes->post('getDtSiswaEmpty', 'DashboardController::getDtSiswaEmpty', ['namespace' => 'App\Controllers\Admin\Dashboard']);
  $routes->post('follow-up-datatables/(:any)/(:any)', 'FollowUpController::getStudentByFollowUpStatusDatatables/$1/$2', ['namespace' => 'App\Controllers\Admin\FollowUp']);

  // Staff
  $routes->post('store-new-leads', 'DashboardController::storeNewLeads', ['namespace' => 'App\Controllers\Admin\Dashboard']);
  $routes->post('delegate-staff', 'DashboardController::delegateStaff', ['namespace' => 'App\Controllers\Admin\Dashboard']);
  $routes->post('delegate-staff-admission', 'DashboardController::delegateStaffAdmission', ['namespace' => 'App\Controllers\Admin\Dashboard']);

  // Admission
  $routes->get('admission/(:any)', 'AdmissionController::getStudentByAdmission/$1', ['namespace' => 'App\Controllers\Admin\Admission']);
  $routes->get('admission-detail/(:any)', 'AdmissionController::detail/$1', ['namespace' => 'App\Controllers\Admin\Admission']);
  $routes->post('admission-change-status', 'AdmissionController::changeStatus', ['namespace' => 'App\Controllers\Admin\Admission']);

  // Follow Up
  $routes->get('follow-up/(:any)', 'FollowUpController::getStudentByFollowUpStatus/$1', ['namespace' => 'App\Controllers\Admin\FollowUp']);
  $routes->get('follow-up-detail/(:any)', 'FollowUpController::detail/$1', ['namespace' => 'App\Controllers\Admin\FollowUp']);
  $routes->post('follow-up-change-status', 'FollowUpController::changeStatus', ['namespace' => 'App\Controllers\Admin\FollowUp']);
  $routes->post('follow-up-future', 'FollowUpController::futureProspect', ['namespace' => 'App\Controllers\Admin\FollowUp']);

  // Event 
  $routes->get('get-event-delegate', 'DashboardController::getEventDelegate', ['namespace' => 'App\Controllers\Admin\Dashboard']);
  $routes->get('get-event', 'DashboardController::getEvent', ['namespace' => 'App\Controllers\Admin\Dashboard']);
  $routes->post('store-event', 'DashboardController::storeEvent', ['namespace' => 'App\Controllers\Admin\Dashboard']);

  // Achievement
  $routes->get('get-achievement', 'DashboardController::getAchievement', ['namespace' => 'App\Controllers\Admin\Dashboard']);
  $routes->post('store-achievement', 'DashboardController::storeAchievement', ['namespace' => 'App\Controllers\Admin\Dashboard']);

  // Report
  $routes->get('report', 'ReportController::index', ['namespace' => 'App\Controllers\Admin\Report']);
  $routes->get('report/detail/(:any)', 'ReportController::detailReport/$1', ['namespace' => 'App\Controllers\Admin\Report']);

  // User Management
  $routes->get('user', 'UserController::index', ['namespace' => 'App\Controllers\Admin\User']);
  $routes->post('get-user', 'UserController::getUser', ['namespace' => 'App\Controllers\Admin\User']);
  $routes->post('store-user', 'UserController::storeUser', ['namespace' => 'App\Controllers\Admin\User']);
  $routes->post('edit-user', 'UserController::editUser', ['namespace' => 'App\Controllers\Admin\User']);
  $routes->post('update-user', 'UserController::updateUser', ['namespace' => 'App\Controllers\Admin\User']);

  // Attachment
  $routes->post('store-attachment', 'AttachmentController::storeAttachment', ['namespace' => 'App\Controllers\Admin\Attachment']);
});

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
  require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
