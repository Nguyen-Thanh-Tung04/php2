<?php

namespace App\Models;

use App\Models\db;

class Category extends db
{
   public function listCategory()
   {
      $sql = "select * from category order by cate_id asc";
      $listdanhmuc = $this->pdo_query($sql);
      return  $listdanhmuc;
   }

   public function getCateById($id)
   {
      $sql = "select * from category where cate_id=" . $id;
      $dm =  $this->pdo_query_one($sql);
      return $dm;
   }

   function insertCate($tendm)
   {
      $sql = "insert into category(cate_name) values('$tendm')";
      $this->pdo_execute($sql);
   }

   function updateCate($id, $tendm)
   {
      $sql = "update category set cate_name='" . $tendm . "' where cate_id=" . $id;
      $this->pdo_execute($sql);
   }

   function deleteCate($id)
   {
      $get_product = "select * from product where cate_id=" . $id;
      $list_product = $this->pdo_query($get_product);
      $p_ids = [];
      foreach ($list_product as $row) {
         $p_ids[] = $row['p_id'];
      }

      for ($i = 0; $i < count($p_ids); $i++) {
         $sql = "SELECT * FROM product WHERE p_id=" . $p_ids[$i];
         $result = $this->pdo_query($sql);
         foreach ($result as $row) {
            $p_featured_photo = $row['p_featured_photo'];
            unlink(UPLOAD . '/upload/' . $p_featured_photo);
         }

         $sql = "SELECT * FROM product_img WHERE p_id=" . $p_ids[$i];
         $result = $this->pdo_query($sql);
         foreach ($result as $row) {
            $img_name = $row['img_name'];
            unlink(UPLOAD . '/upload/product_photos/' . $img_name);
         }

         $sql = "DELETE FROM product_img WHERE p_id=" . $p_ids[$i];
         $this->pdo_execute($sql);

         $sql = "DELETE FROM product WHERE p_id=" . $p_ids[$i];
         $this->pdo_execute($sql);
      }

      $sql = "delete from category where cate_id=" . $id;
      $this->pdo_execute($sql);
   }
}