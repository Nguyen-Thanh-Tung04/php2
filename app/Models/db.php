<?php 
namespace App\Models;

use PDO;
use PDOException;

class db
{
    function getConnect(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        try {
            $conn = new PDO("mysql:host=". SVNAME. ";dbname=". DBNAME, USERNAME, PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    function pdo_execute($sql){
        $sql_args=array_slice(func_get_args(),1);
        try{
            $conn=$this->getConnect();
            $stmt=$conn->prepare($sql);
            $stmt->execute($sql_args);
    
        }
        catch(PDOException $e){
            throw $e;
        }
        finally{
            unset($conn);
        }
    }
    // truy vấn nhiều dữ liệu
    function pdo_query($sql){
        $sql_args=array_slice(func_get_args(),1);
    
        try{
            $conn=$this->getConnect();
            $stmt=$conn->prepare($sql);
            $stmt->execute($sql_args);
            $rows=$stmt->fetchAll();
            return $rows;
        }
        catch(PDOException $e){
            throw $e;
        }
        finally{
            unset($conn);
        }
    }
    // truy vấn  1 dữ liệu
    function pdo_query_one($sql){
        $sql_args=array_slice(func_get_args(),1);
        try{
            $conn=$this->getConnect();
            $stmt=$conn->prepare($sql);
            $stmt->execute($sql_args);
            $row=$stmt->fetch(PDO::FETCH_ASSOC);
            // đọc và hiển thị giá trị trong danh sách trả về
            return $row;
        }
        catch(PDOException $e){
            throw $e;
        }
        finally{
            unset($conn);
        }
    }
    // đếm dòng dữ liệu
    function pdo_query_row_count($sql){
        $sql_args = array_slice(func_get_args(), 1);
    
        try {
            $conn = $this->getConnect();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args);
            $count = $stmt->rowCount();
            return $count;
        } catch(PDOException $e) {
            throw $e;
        } finally {
            unset($conn);
        }
    }
}

?>

