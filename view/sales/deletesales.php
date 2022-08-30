<?php 
    session_start();
    require '../../db/db-conn.php';
    require '../../utils.php';

    $uid=$_GET['uid'];
    $invoice=$_GET['invoice'];
    
    if(isset($_POST, $_POST['deletesales'])){
        
        try{
            $stmt=$conn->query("DELETE from sales WHERE invoice_no=$invoice");
            $stmt->execute();

            if($stmt){
                $_SESSION['error']="Table updated!";
                header("location: sales.php?uid=$uid");
                exit;
            }
            
        }
        catch(Exception $e){
            $_SESSION['error']="Oops deletion error!";
            header("location: sales.php?uid=$uid");
            exit;
        }
    }
    else{
        $_SESSION['error']="Oops unidentified error!";
        header("location: sales.php?uid=$uid");
        exit;
    }
    
    
?>