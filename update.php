<?php
//изменение информации о визите
$link=mysqli_connect("localhost","root","","patients")//здесь вставьте свои реквизиты!!(1 - хост. 2 - юзер. 3 - пароль. 4- название БД)
or die(mysqli_error($link));
$oa=(int)$_POST["order_amount_update"];
$os=$_POST["order_status_update"];
$id=$_POST["id"];
$sql="UPDATE add_visit SET order_amount='$oa', order_status='$os' WHERE id='$id' ";
mysqli_query($link,$sql) or die(mysqli_error($link));
mysqli_close($link);
header("location:registry.php?id=".$_POST['user_id']);
?>
