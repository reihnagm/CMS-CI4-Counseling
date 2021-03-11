<?php

namespace App\Controllers\Admin\User;

use App\Controllers\Base\BaseController;
use Config\Services;

class UserController extends BaseController
{
    public function index()
    {
        $db = db_connect();
        $roles = $db->query("SELECT * FROM omega_roles");
        $branch = $db->query("SELECT * FROM omega_branches");
        $data["roles"] = $roles->getResult();
        $data["branches"] = $branch->getResult();
        return view('user-management/index', $data);
    }

    public function storeUser()
    {
        $db = db_connect();
        $request = Services::request();
        $username = $request->getPost("username");
        $fullname = $request->getPost("fullname");
        $password = $request->getPost("password");
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $role = $request->getPost("role");
        $branch = $request->getPost("branch");
        $result = $db->simpleQuery("INSERT INTO omega_users
        (username, password, fullname, role, status, created, branch_id) 
        VALUES ('$username', '$passwordHash', '$fullname', '$role', 'enabled', NOW(), '$branch')");
        if ($result) {
            return json_encode(true);
        }
    }

    public function getUser()
    {
        $request = Services::request();
        $db = db_connect();
        $users = $db->query("SELECT a.id, a.username, a.fullname, a.status, b.name as name_role, 
                                    c.name as branch_name
                                FROM omega_users a 
                                    JOIN omega_roles b 
                                        ON b.id = a.role
                                    JOIN omega_branches c
                                        ON c.id = a.branch_id");

        $total = (int) count($users->getResult());
        $data = [];
        foreach ($users->getResult() as $key => $value) {
            $nestedData['username'] = $value->username;
            $nestedData['fullname'] = $value->fullname;
            $nestedData['role']  = $value->name_role;
            $nestedData['branch'] = $value->branch_name;
            $nestedData['status']  = $value->status;
            $nestedData['actions'] = "<button onclick='getUserByID($value->id)' id='btn-edit-user' class='btn btn-sm btn-primary'>
            <i class='fa fa-edit'><i></button>";
            $data[] = $nestedData;
        }
        echo json_encode([
            "draw" => intval($request->getPost('draw')),
            "recordsTotal" => intval($total),
            "recordsFiltered" => intval($total),
            "data" => $data
        ]);
    }

    public function editUser()
    {
        $db = db_connect();
        $request = Services::request();
        $id = $request->getPost("id");
        $users = $db->query("SELECT a.id as id_user, a.password, a.username, a.fullname, a.status, b.name as name_role, 
                                    b.id as role_id, c.id as branch_id, c.name as branch_name
                                FROM omega_users a 
                                    JOIN omega_roles b 
                                        ON b.id = a.role
                                    JOIN omega_branches c
                                        ON c.id = a.branch_id
                                    WHERE a.id = '$id'");
        $data = [];
        foreach ($users->getResult() as $key => $value) {
            $nestedData['id_user'] = $value->id_user;
            $nestedData['password'] = $value->password;
            $nestedData['username'] = $value->username;
            $nestedData['fullname'] = $value->fullname;
            $nestedData['role']  = $value->name_role;
            $nestedData['role_id']  = $value->role_id;
            $nestedData['branch'] = $value->branch_name;
            $nestedData['branch_id'] = $value->branch_id;
            $nestedData['status']  = $value->status;
            $data[] = $nestedData;
        }
        echo json_encode([
            "data" => $data
        ]);
    }

    public function updateUser()
    {
        $db = db_connect();
        $request = Services::request();
        $id_user = $request->getPost("id_user");
        $username = $request->getPost("username");
        $fullname = $request->getPost("fullname");
        $password = $request->getPost("password");
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $role = $request->getPost("role");
        $status = $request->getPost("status");
        $branch = $request->getPost("branch");

        if ($password == "") {
            $data = [
                'username' => $username,
                'fullname'  => $fullname,
                'role' => $role,
                'status' => $status,
                'branch_id' => $branch
            ];
        } else {
            $data = [
                'username' => $username,
                'fullname'  => $fullname,
                'password'  => $passwordHash,
                'role' => $role,
                'status' => $status,
                'branch_id' => $branch
            ];
        }

        $builder = $db->table('omega_users');
        $builder->where('id', $id_user);
        $result = $builder->update($data);

        if ($result) {
            return json_encode(true);
        }
    }
}
