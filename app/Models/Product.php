<?php

namespace App\Models;

use App\Models\db;

class Product extends db
{
    public function listProduct()
    {
        $sql = "select 
            p.p_id, p.p_name, p.p_current_price, p.p_old_price, p.p_quantity, p.p_featured_photo, p.p_status, c.cate_name
            from 
            product p left join category c on p.cate_id = c.cate_id  
            order by p.p_id desc";
        $list_product = $this->pdo_query($sql);
        return  $list_product;
    }

    public function getTopNew() {
        $sql = "select * from product limit 8";
        $list_product = $this->pdo_query($sql);
        return  $list_product;
    }

    public function getTopPrice() {
        $sql = "select * from product order by p_current_price desc limit 4";
        $list_product = $this->pdo_query($sql);
        return  $list_product;
    }

    public function getSameCategory($cate_id) {
        $sql = "select * from product where cate_id =$cate_id";
        $list_product = $this->pdo_query($sql);
        return  $list_product;
    }

    public function getOneProductById($id) {
        $sql = "select * from product where p_id=" . $id;
        $list_product = $this->pdo_query_one($sql);
        return  $list_product;
    }

    function insertProduct($name, $old_price, $current_price, $quantity, $featured_photo, $desc, $short_desc, $status, $cate_id)
    {
        $sql = "INSERT INTO product(
            p_name,
            p_old_price,
            p_current_price,
            p_quantity,
            p_featured_photo,
            p_description,
            p_short_description,
            p_status,
            cate_id
        ) VALUES ('$name', '$old_price', '$current_price', '$quantity','$featured_photo','$desc','$short_desc', $status, $cate_id)";
        $this->pdo_execute($sql);
    }

    function getProductId()
    {
        $sql = "SHOW TABLE STATUS LIKE 'product'";
        $list_status = $this->pdo_query($sql);
        foreach ($list_status as $row) {
            $p_id = $row[10];
        }
        return  $p_id;
    }

    function getProductPhotoId()
    {
        $sql = "SHOW TABLE STATUS LIKE 'product_img'";
        $list_status = $this->pdo_query($sql);
        foreach ($list_status as $row) {
            $img_id = $row[10];
        }
        return  $img_id;
    }

    function insertProductImg($p_id, $img_name)
    {
        $sql = "INSERT INTO product_img (img_name,p_id) VALUES ('$img_name', '$p_id')";
        $this->pdo_execute($sql);
    }

    function deleteProduct($id)
    {
        $sql = "SELECT * FROM product WHERE p_id=" . $id;
        $product = $this->pdo_query_one($sql);
        $p_featured_photo = $product['p_featured_photo'];
        unlink(UPLOAD . '/upload/' . $p_featured_photo);

        $sql = "SELECT * FROM product_img WHERE p_id=" . $id;
        $result = $this->pdo_query($sql);
        foreach ($result as $row) {
            $img_name = $row['img_name'];
            unlink(UPLOAD . '/upload/product_photos/' . $img_name);
        }

        $sql = "DELETE FROM product_img WHERE p_id=" . $id;
        $this->pdo_execute($sql);

        $sql = "DELETE FROM product WHERE p_id=" . $id;
        $this->pdo_execute($sql);
    }

    function getProductById($id)
    {
        $sql = "select * from product where p_id=" . $id;
        $product = $this->pdo_query($sql);
        return $product;
    }

    function getProductImg($id)
    {
        $sql = "select * from product_img where p_id=" . $id;
        $list_img = $this->pdo_query($sql);
        return $list_img;
    }

    function updateProductNoImg($p_id, $name, $old_price, $current_price, $quantity, $desc, $short_desc, $status, $cate_id)
    {
        $check_old_price = !empty($old_price) ? $old_price : 'NULL';
        $sql = "UPDATE product SET 
        p_name='$name', 
        p_old_price=$check_old_price, 
        p_current_price=$current_price, 
        p_quantity=$quantity,
        p_description='$desc',
        p_short_description='$short_desc',
        p_status=$status,
        cate_id=$cate_id
        WHERE p_id=$p_id";
        $this->pdo_execute($sql);
    }


    function updateProductWithImg($p_id, $name, $old_price, $current_price, $quantity, $featured_photo, $desc, $short_desc, $status, $cate_id)
    {
        $check_old_price = !empty($old_price) ? $old_price : 'NULL';
        $sql = "UPDATE product SET 
        p_name='$name', 
        p_old_price=$check_old_price, 
        p_current_price=$current_price, 
        p_quantity=$quantity,
        p_featured_photo='$featured_photo',
        p_description='$desc',
        p_short_description='$short_desc',
        p_status=$status,
        cate_id=$cate_id
        WHERE p_id=$p_id";
        $this->pdo_execute($sql);
    }

    function insertOrder($user_id,$paid_amount,  $payment_id)
    {
        $sql = "insert into `orders`(user_id, paid_amount,payment_id) 
            values ($user_id, $paid_amount, '$payment_id')";
        return $this->pdo_execute($sql);
    }


    function insertOrderDetail($p_id, $quantity, $price, $payment_id)
    {
        $sql = "insert into order_detail(p_id, payment_id, price,quantity) 
         values ($p_id, '$payment_id', $price, $quantity)";
        return $this->pdo_execute($sql);
    }

}