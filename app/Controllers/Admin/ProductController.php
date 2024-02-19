<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\Product;

class ProductController extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    public function __construct()
    {
        $this->productModel = new Product();
        $this->categoryModel = new Category();
    }

    public function renderListProduct()
    {
        //xử lý logic, validate dữ liệu
        $title = "Danh sách sản phẩm";
        $listProduct = $this->productModel->listProduct();

        $this->render('admin.product.list', compact('listProduct', 'title'));
    }

    public function renderAddproduct($message = '')
    {
        //xử lý logic, validate dữ liệu
        $title = "Thêm mới sản phẩm";
        $listCategory = $this->categoryModel->listCategory();

        $this->render('admin.product.add', compact('listCategory', 'title', 'message'));
    }

    public function renderEditproduct($id, $message = '')
    {
        $title = "Sửa sản phẩm";
        $product = $this->productModel->getProductById($id);
        $listImg = $this->productModel->getProductImg($id);
        $listCategory = $this->categoryModel->listCategory();

        $this->render('admin.product.edit', compact('listCategory', 'title', 'product', 'listImg', 'message'));
    }

    public function updateProduct($id)
    {
        $valid = 1;
        $message = '';
        if (empty($_POST['cate_id'])) {
            $valid = 0;
            $message .= "Bạn phải chọn dnah mục sản phẩm<br>";
        }
        if (empty($_POST['p_name'])) {
            $valid = 0;
            $message .= "Tên sản phẩm không được để trống<br>";
        }

        if (empty($_POST['p_current_price'])) {
            $valid = 0;
            $message .= "Giá hiện tại không được để trống<br>";
        }

        if (empty($_POST['p_quantity'])) {
            $valid = 0;
            $message .= "Số lượng sản phẩm không được để trống<br>";
        }

        $path = $_FILES['p_featured_photo']['name'];
        $path_tmp = $_FILES['p_featured_photo']['tmp_name'];

        if ($path != '') {
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $file_name = basename($path, '.' . $ext);
            if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
                $valid = 0;
                $message .= 'Bạn phải chọn ảnh có định dạng jpg, jpeg, gif or png<br>';
            }
        }

        if ($valid == 1) {
            $p_id = $_POST['p_id'];
            $name = $_POST['p_name'];
            $old_price = $_POST['p_old_price'];
            $current_price = $_POST['p_current_price'];
            $quantity = $_POST['p_quantity'];
            $desc = $_POST['p_description'];
            $short_desc = $_POST['p_short_description'];
            $status = $_POST['status'];
            $cate_id = $_POST['cate_id'];

            if ($path == '') {
                $this->productModel->updateProductNoImg($p_id, $name, $old_price, $current_price, $quantity, $desc, $short_desc, $status, $cate_id);
            } else {

                unlink(UPLOAD .'/upload/' . $_POST['current_photo']);

                $final_name = 'product-featured-' . $p_id . '.' . $ext;
                move_uploaded_file($path_tmp, UPLOAD .'/upload/' . $final_name);

                $this->productModel->updateProductWithImg($p_id, $name, $old_price, $current_price, $quantity, $final_name, $desc, $short_desc, $status, $cate_id);
            }



            if (isset($_FILES['photo']["name"]) && isset($_FILES['photo']["tmp_name"])) {
                $photo = array();
                $photo = $_FILES['photo']["name"];
                $photo = array_values(array_filter($photo));

                $photo_temp = array();
                $photo_temp = $_FILES['photo']["tmp_name"];
                $photo_temp = array_values(array_filter($photo_temp));

                $next_id = $this->productModel->getProductPhotoId();
                $z = $next_id;

                for ($i = 0; $i < count($photo); $i++) {
                    $my_ext1 = pathinfo($photo[$i], PATHINFO_EXTENSION);
                    if ($my_ext1 == 'jpg' || $my_ext1 == 'png' || $my_ext1 == 'jpeg' || $my_ext1 == 'gif') {
                        $final_name1[$i] = $z . '.' . $my_ext1;
                        move_uploaded_file($photo_temp[$i], UPLOAD ."/upload/product_photos/" . $final_name1[$i]);
                        $z++;
                    }
                }

                if (isset($final_name1)) {
                    for ($i = 0; $i < count($final_name1); $i++) {
                        $this->productModel->insertProductImg($p_id, $final_name1[$i]);
                    }
                }
            }
            header("Location:".route("admin/product"));
        } else
        {
            $this->renderEditproduct($id, $message);
        }
    }


    public function insertProduct()
    {
        $valid = 1;
        $message = "";
        if (empty($_POST['cate_id'])) {
            $valid = 0;
            $message .= "Bạn phải chọn danh mục<br>";
        }
        if (empty($_POST['p_name'])) {
            $valid = 0;
            $message .= "Tên sản phẩm không được để trống<br>";
        }

        if (empty($_POST['p_current_price'])) {
            $valid = 0;
            $message .= "Giá hiện tại không được để trống<br>";
        }

        if (empty($_POST['p_quantity'])) {
            $valid = 0;
            $message .= "Số lượng sản phẩm không được để trống<br>";
        }

        $path = $_FILES['p_featured_photo']['name'];
        $path_tmp = $_FILES['p_featured_photo']['tmp_name'];

        if ($path != '') {
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $file_name = basename($path, '.' . $ext);
            if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
                $valid = 0;
                $message .= 'Bạn phải chọn ảnh có định dạng jpg, jpeg, gif or png<br>';
            }
        } else {
            $valid = 0;
            $message .= 'Bạn phải chọn ảnh đại diện<br>';
        }

        if ($valid == 1) {
            $name = $_POST['p_name'];
            $old_price = $_POST['p_old_price'];
            $current_price = $_POST['p_current_price'];
            $quantity = $_POST['p_quantity'];
            $desc = $_POST['p_description'];
            $short_desc = $_POST['p_short_description'];
            $status = $_POST['status'];
            $cate_id = $_POST['cate_id'];

            $product_id = $this->productModel->getProductId();


            $featured_photo = 'product-featured-' . $product_id . '.' . $ext;
            move_uploaded_file($path_tmp, UPLOAD . '/upload/' . $featured_photo);

            $this->productModel->insertProduct($name, $old_price, $current_price, $quantity, $featured_photo, $desc, $short_desc, $status, $cate_id);


            if (isset($_FILES['photo']["name"]) && isset($_FILES['photo']["tmp_name"])) {
                $photo = array();
                $photo = $_FILES['photo']["name"];
                $photo = array_values(array_filter($photo));

                $photo_temp = array();
                $photo_temp = $_FILES['photo']["tmp_name"];
                $photo_temp = array_values(array_filter($photo_temp));

                $next_id = $this->productModel->getProductPhotoId();
                $z = $next_id;

                for ($i = 0; $i < count($photo); $i++) {
                    $my_ext1 = pathinfo($photo[$i], PATHINFO_EXTENSION);
                    if ($my_ext1 == 'jpg' || $my_ext1 == 'png' || $my_ext1 == 'jpeg' || $my_ext1 == 'gif') {
                        $final_name1[$i] = $z . '.' . $my_ext1;
                        move_uploaded_file($photo_temp[$i], UPLOAD . "/upload/product_photos/" . $final_name1[$i]);
                        $z++;
                    }
                }

                if (isset($final_name1)) {
                    for ($i = 0; $i < count($final_name1); $i++) {
                        $this->productModel->insertProductImg($product_id, $final_name1[$i]);
                    }
                }
            }
            header("Location:".route("admin/product"));
        } else {
            $this->renderAddproduct($message);
        }
    }

    public function deleteProduct($id)
    {
        $this->productModel->deleteProduct($id);
        header("Location:".route("admin/product"));
    }
}
