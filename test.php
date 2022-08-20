<?php

    /* require_once 'db/db-conn.php';
    $salt='@PLDtOO#';
    $p=$salt."@changee";
    echo password_hash($p, PASSWORD_DEFAULT);
    $stmt=$conn->prepare("INSERT INTO users(user_id, uname, pass, email) VALUES(:user_id, :uname, :pass, :email)");
    $stmt->execute(array(
        ':user_id'=>1,
        ':uname'=>'amun',
        ':pass'=>'$2y$10$oVIzWPVCH5vhUkichYU3dOkUkFNA7oGY1Si6IRtVWhb6dIlPP8cjS',
        ':email'=>'amunpote@gmail.com'
    )); */
    /* require_once 'db/db-conn.php';
    $stmt=$conn->prepare("UPDATE company SET company_name='aa' WHERE company_id='aa'");
    /* $stmt->execute(array(
        ':cname'=>"test"
    )); */
    require_once 'utils.php';
    require_once 'db/db-conn.php';
    $stmt=$conn->query("SELECT i1.product_name, i1.quantity+i2.quantity as quantity from invoice as i1 Inner Join invoice as i2 WHERE i1.invoice_no<i2.invoice_no AND i1.product_name=i2.product_name");
    $row=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt1=$conn->prepare("DELETE i1 FROM invoice as i1 INNER JOIN invoice as i2 WHERE i1.invoice_no<i2.invoice_no AND i1.product_name=i2.product_name");
    $stmt1->execute();
    foreach ($row as $rows) {
        # code...
        $quantity=$rows['quantity'];
        $pname=$rows['product_name'];
        $stmt3=$conn->prepare("UPDATE invoice SET quantity=$quantity WHERE product_name='$pname'");
        $stmt3->execute();
        
    }
    
    

?>