<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\User;

class AccountController extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new User();
    }

    public function getListAcounts()
    {
        $listUser = $this->userModel->getListUserCustomer();
        $listAdmin = $this->userModel->getListUserAdmin();
        $title = "Danh sách tài khoản";
        $this->render('admin.account.list', compact('listUser', 'title', 'listAdmin'));
    }

}
?>