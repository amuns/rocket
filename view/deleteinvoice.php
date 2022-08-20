<?php
    session_start();
    require '../db/db-conn.php';
    require '../utils.php';

    $uid=$_GET['uid'];
    $invoice=$_GET['invoice'];

    if(isset($_POST, $_POST['clearinvoice'])){
        $stmt=$conn->prepare("DELETE FROM invoice");
        $stmt->execute();
        header("location: dashboard.php?uid=$uid");
        exit;
    }

    if(isset($_POST, $_POST['invoice'])){
        
        try{
            $stmt=$conn->query("DELETE from invoice WHERE invoice_no='$invoice'");
            $stmt->execute();

            if($stmt){
                // $_SESSION['error']="Table updated!";
                header("location: dashboard.php?uid=$uid");
                exit;
            }
            
        }
        catch(Exception $e){
            $_SESSION['error']="Oops deletion error!";
            header("location: dashboard.php?uid=$uid");
            exit;
        }
    }
    else{
        $_SESSION['error']="Oops unidentified error!";
        header("location: products.php?uid=$uid");
        exit;
    }
?>