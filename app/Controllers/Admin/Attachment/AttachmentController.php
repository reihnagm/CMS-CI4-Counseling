<?php

namespace App\Controllers\Admin\Attachment;

use App\Controllers\Base\BaseController;
use Config\Services;

class AttachmentController extends BaseController
{
  public function storeAttachment()
  {
    $db = db_connect();
    $req = Services::request();
    $attachment = $req->getPost("attachment");
    $content = $req->getPost("content");
    $branch = $req->getPost("branch");
    $user_id = session('authenticated')->id;
    $result = $db->simpleQuery("INSERT INTO omega_attachments (url, content, branch_id, created_by, created_at, updated_at) 
                                        VALUES ('$attachment', '$content', '$branch', '$user_id', NOW(), NOW())");
    if ($result) {
      return json_encode(true);
    }
  }
}
