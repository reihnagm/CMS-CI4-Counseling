<?php

namespace App\Controllers\Admin\Auth;

use App\Controllers\Base\BaseController;
use Config\Services;

class AuthController extends BaseController
{
  public function loginView()
  {
    return view('auth/login');
  }
  public function loginPost()
  {
    $db = db_connect();
    $session = Services::session();
    $request = Services::request();
    $username = $request->getPost('username');
    $password = $request->getPost('password');
    $result = $db->query("SELECT * FROM omega_users WHERE username = '$username'");
    if ($result->connID->affected_rows == 0) {
      return view("auth/login", [
        "msg_error" => "Incorrect username and password"
      ]);
    } else {
      $passwordDb = $result->getResult()[0]->password;
      if (password_verify($password, $passwordDb)) {
        $session->set("authenticated", $result->getResult()[0]);
      } else {
        return redirect()->to(base_url('admin/dashboard'));
      }
    }
  }
  public function logout()
  {
    $session = Services::session();
    $session->destroy();
    return redirect()->to(base_url('/'));
  }
}
