<?php
namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Product;

class HomeController extends BaseController
{
    protected $productModel;
    public function __construct()
    {
        $this->productModel = new Product();
    }

    public function renderHome()
    {
        $title = "Trang chủ";
        $topNew = $this->productModel->getTopNew();
        $topPrice = $this->productModel->getTopPrice();
        $this->render('user.home', compact('title', 'topNew', 'topPrice'));
    }



}
?>