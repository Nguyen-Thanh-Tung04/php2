<?php

namespace App\Models;

use App\Models\db;

class User extends db
{
    function getInfoUser($email)
    {
        $sql = "select * from user where user_email='$email'";
        $user = $this->pdo_query_one($sql);
        return  $user;
    }

    function insertUser($username,  $email, $password)
    {
        $sql = "insert into user(user_name, user_email, user_password, user_status, role_id) 
            values('$username', '$email', '$password', '1', 2)";
            $this->pdo_execute($sql);
    }

    function getListUserCustomer() {
        $sql = "select user_id, user_name, user_email, user_phone, user_status, role_name 
                from user left join user_role on user.role_id = user_role.role_id where role_name = 'Customer'  order by user_id asc";
        $list_user = $this->pdo_query($sql);
        return $list_user;
    }
    
    function getListUserAdmin() {
        $sql = "select user_id, user_name, user_email, user_phone, user_status, role_name 
                from user left join user_role on user.role_id = user_role.role_id where role_name = 'Admin'  order by user_id asc";
        $list_user = $this->pdo_query($sql);
        return $list_user;
    }
}
