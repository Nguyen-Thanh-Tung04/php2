<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Product;
use Exception;

class ProductUserController extends BaseController
{
    protected $productModel;
    public function __construct()
    {
        $this->productModel = new Product();
    }

    public function renderProductDetail($id)
    {
        $title = "Chi tiết sản phẩm";
        $productDetail = $this->productModel->getOneProductById($id);
        $productSameCate = $this->productModel->getSameCategory($productDetail['cate_id']);
        $this->render('user.productDetail', compact('title', 'productDetail', 'productSameCate'));
    }


}