<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Category;

class CategoryController extends BaseController
{
    protected $categoryModel;
    public function __construct()
    {
        $this->categoryModel = new Category();
    }

    public function getListCategory()
    {
        $title = "Danh sách danh mục";
        $listCate = $this->categoryModel->listCategory();
        $this->render('admin.category.list', compact('listCate', 'title'));
    }

    public function renderAddCategory($message = '')
    {
        $title = "Thêm mới danh mục";

        $this->render('admin.category.add', compact('title', 'message'));
    }

    public function renderEditCategory($id, $message = '')
    {
        $title = "Sửa danh mục";
        $category = $this->categoryModel->getCateById($id);

        $this->render('admin.category.edit', compact('category', 'title', 'message'));
    }

    public function updateCategory($id)
    {
        $valid = 1;
        $error_message = "";
        if (empty($_POST['namedm'])) {
            $valid = 0;
            $error_message .= "Tên danh mục không được để trống<br>";
        } else {
            $total = $this->categoryModel->checkExist($_POST['namedm']);
            if ($total) {
                $valid = 0;
                $error_message .= "Danh mục đã tồn tại<br>";
            }
        }

        if ($valid == 1) {
            $tendm = $_POST['namedm'];
            $id = $_POST['cate_id'];
            $this->categoryModel->updateCate($id, $tendm);
            header("Location:" . route("admin/category"));
        } else {
            $this->renderEditCategory($_POST['cate_id'], $error_message );
        }
    }


    public function insertCategory()
    {
        $error_message = "";
        $valid = 1;
        if (empty($_POST['tendm'])) {
            $valid = 0;
            $error_message .= "Tên danh mục không được để trống<br>";
        } else {
            $total = $this->categoryModel->checkExist($_POST['tendm']);
            if ($total) {
                $valid = 0;
                $error_message .= "Danh mục đã tồn tại<br>";
            }
        }

        if ($valid == 1) {
            $tendm = $_POST['tendm'];
            $this->categoryModel->insertCate($tendm);
            header("Location:" . route("admin/category"));
        } else {
            $this->renderAddCategory($error_message);
        }
    }

    public function deleteCategory($id)
    {
        $this->categoryModel->deleteCate($id);
        header("Location:" . route("admin/category"));
    }
}
