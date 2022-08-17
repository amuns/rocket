<?php 
    session_start();
    require '../../db/db-conn.php';
    require '../../utils.php';

    $uid=$_GET['uid'];
    $pid=$_GET['pid'];
    
    if(isset($_POST, $_POST['deleteproduct'])){
        
        try{
            $stmt=$conn->query("DELETE from products WHERE product_id=$pid");
            $stmt->execute();

            if($stmt){
                $_SESSION['error']="Table updated!";
                header("location: products.php?uid=$uid");
                exit;
            }
            
        }
        catch(Exception $e){
            $_SESSION['error']="Oops deletion error!";
            header("location: products.php?uid=$uid");
            exit;
        }
    }
    else{
        $_SESSION['error']="Oops unidentified error!";
        header("location: products.php?uid=$uid");
        exit;
    }
    
    
?>