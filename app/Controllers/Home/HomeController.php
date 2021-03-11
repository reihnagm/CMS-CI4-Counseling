<?php

namespace App\Controllers\Home;

use App\Controllers\Base\BaseController;
use Config\Services;

class HomeController extends BaseController {
  public function index() {
    return redirect()->to('admin/dashboard'); 
  }
}
