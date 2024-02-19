<?php
namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\User;

class LoginController extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new User();
    }
    public function rendeRegister($error_message = "")
    {
        $title = "Đăng ký";

        $this->render('user.register', compact('title', 'error_message'));
    }

    public function renderForgotPassword($error_message = "")
    {
        $title = "Quên mật khẩu";

        $this->render('user.forgotPassword', compact('title', 'error_message'));
    }
    public function rendeLogin($error_message = "")
    {
        $title = "Đăng nhập";

        $this->render('user.login', compact('title', 'error_message'));
    }

   
    public function checkLogin()
    {
        $error_message = "";
        if (empty($_POST['email']) || empty($_POST['password'])) {
            $error_message = 'Email và Mật khẩu không được để trống <br>';
            $this->rendeLogin($error_message);
        } else {
    
            $email = strip_tags($_POST['email']);
            $password = strip_tags($_POST['password']);
    
            $checkuser = $this->userModel->getInfoUser($email);
    
            if (!$checkuser) {
                $error_message .= 'Email không đúng<br>';
                $this->rendeLogin($error_message);
            } else {
                $check = password_verify($password, $checkuser['user_password']);
                if ($check) {
                    if ($checkuser['user_status'] == 0) {
                        $error_message .= 'Tài khoản đã bị khóa<br>';
                        $this->rendeLogin($error_message);
                    } else {
                        $_SESSION['user'] = $checkuser;
                        if ($checkuser['role_id'] == 1) {
                            //admin
                            header("location:". route("admin/product"));
                        } else {
                            // Nếu người dùng 
                            header("location:". route(""));
                        }
                    }
                } else {
                    $error_message .= 'Password không đúng<br>';
                    $this->rendeLogin($error_message);
                }
            }
        }
    }

    public function registerUser() {
        $error_message = "";
        if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['re_password']) || empty($_POST['username'])) {
            $error_message = 'Không được để trống các trường <br>';
            $this->rendeRegister($error_message);
        } else {
            $email = strip_tags($_POST['email']);
            $password = strip_tags($_POST['password']);
            $re_password = strip_tags($_POST['re_password']);
            $username = strip_tags($_POST['username']);
            if ($password != $re_password) {
                $error_message = 'Mật khẩu không khớp <br>';
                $this->rendeRegister($error_message);
            } else {
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
                $this->userModel->insertUser($username, $email,  $hashed_password);
                header('Location:'. route("login"));
            }
        }
    }

    public function logout() {
        unset($_SESSION['user']);
        header('Location:'. route("login"));
    }

}
?>