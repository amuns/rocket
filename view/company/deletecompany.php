<?php 
    session_start();
    require '../../db/db-conn.php';
    require '../../utils.php';

    $uid=$_GET['uid'];
    $cid=$_GET['cid'];
    if(isset($_POST, $_POST['deletecompany'])){
        
        try{
            $stmt=$conn->query("DELETE from company WHERE company_id='$cid'");
            $stmt->execute();

            if($stmt){
                $_SESSION['error']="Table updated!";
                header("location: company.php?uid=$uid");
                exit;
            }
            
        }
        catch(Exception $e){
            $_SESSION['error']="Oops deletion error!";
            header("location: company.php?uid=$uid");
            exit;
        }
    }
    else{
        $_SESSION['error']="Oops unidentified error!";
        header("location: company.php?uid=$uid");
        exit;
    }
    
?>