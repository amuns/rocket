<?php
    session_start();
    require '../db/db-conn.php';
    require '../utils.php';
    date_default_timezone_set('Asia/Kathmandu');
    if(!isset($_SESSION['user_logged_in'], $_SESSION['userData'])){
      $_SESSION['error']="Please Log in!";
      header('location: ../auth/login.php');
      exit;
    }

    if(isset($_POST, $_POST['selectProduct'], $_POST['selectQuantity'])){
        $invoice=strtotime(date('Y-m-d-h-i')).rand(0,1000);
        $pkey=$_POST['selectProduct'];
        $qty=$_POST['selectQuantity'];

        $stmt=$conn->query("SELECT product_name, cprice, sprice from products WHERE product_key='$pkey'");
        $row=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $cprice=$row[0]['cprice'];
        $sprice=$row[0]['sprice'];
        $profit=($sprice-$cprice)*$qty;
        $amt=$qty*$sprice;
        $pname=$row[0]['product_name'];
        
        try {
            $stmt=$conn->prepare("UPDATE products SET quantity=quantity-$qty WHERE product_key='$pkey'");
            $stmt->execute();
        } catch (\Throwable $th) {
            $_SESSION['error']="Quantity Mismatch!";
            header("location: dashboard.php?uid=".$_GET['uid']);
            exit;
        }

        $stmt=$conn->prepare("INSERT INTO invoice VALUES(:a, :b, :c, :d, :e, :f, :g)");
        $stmt->execute(array(
            ":a"=>$invoice,
            ":b"=>$pname,
            ":c"=>$qty,
            ":d"=>$amt,
            ":e"=>$profit,
            ":f"=>$pkey,
            ":g"=>$sprice

        ));



        try {
            
            $dup=$conn->query("SELECT COUNT(product_key) FROM invoice GROUP BY product_key HAVING COUNT(product_key) > 1");
            if(!empty($dup->fetchAll(PDO::FETCH_ASSOC))){
                $stmt1=$conn->query("SELECT i1.product_key, i1.quantity+i2.quantity as quantity from invoice as i1 Inner Join invoice as i2 WHERE i1.invoice_no<i2.invoice_no AND i1.product_key=i2.product_key");
                $row=$stmt1->fetchAll(PDO::FETCH_ASSOC);
                $stmt2=$conn->prepare("DELETE i1 FROM invoice as i1 INNER JOIN invoice as i2 WHERE i1.invoice_no<i2.invoice_no AND i1.product_key=i2.product_key");
                $stmt2->execute();
                foreach ($row as $rows) {
                
                    $newquantity=$rows['quantity'];
                    $pkey=$rows['product_key'];
                    $newamt=$sprice*$newquantity;
                    $newprofit=$profit*$newquantity;
                    $stmt3=$conn->prepare("UPDATE invoice SET quantity=$newquantity, amt=$newamt, profit=$newprofit WHERE product_key='$pkey'");
                    $stmt3->execute();
            
                }
            }

            
            if($stmt){
                $uid=$_GET['uid'];
                header("location: dashboard.php?uid=$uid");
                exit;
            }


        } 
        catch (\Throwable $th) {
            //throw $th;
            $_SESSION['error']="Error!";
            header("location: dashboard.php?uid=".$_GET['uid']);
            exit;
        }
        

        $_SESSION['error']="Unidentified Error!";
        $uid=$_GET['uid'];
        header("location: dashboard.php?uid=$uid");
        exit;
    }
    // echo date('Y-m-d h-i-s');

    
?>