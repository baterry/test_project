<?php
//фунция на вывод таблиц с персональными данными, визитов, формы для добавления нового визита
function edit_table($arr,$arr2){
?>	<html>
	<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="css/main.css">
	<title>test application</title>
	</head>
	<form method="post" action="edit.php">
	<h3 align="center">Personal Data</h3>
	<table border="2"align="center">
		<tr><td>Patient's Name:<?=$arr['name']?></td> </tr>
		<tr><td>Patient's Lastname:<?=$arr['lastname']?></td> </tr>
		<tr><td>Patient's Birthday:<?=$arr['birthday']?></td> </tr>
		<tr><td>Patient's Address:<?=$arr['address']?></td> </tr>
		<tr><td>Patient's Phone:<?=$arr['phone']?></td> </tr>
		<tr><td>Patient's Email:<?=$arr['email']?></td></tr>
		<tr><td>Left Eye:<?=$arr['leye']?></td></tr>
		<tr><td>Right Eye:<?=$arr['reye']?></td></tr>
	</table>
	<div class="add" border="1">
	<h3>
		Add Visit:</br>
	</h3>
		Order Amount (USD):<br/><input type="text" required name="order_amount"><br>
		Order Status:<br/><select required name="order_status">
							<option></option>
							<option>Completed</option>
							<option>In progress</option>
							<option>Cancelled</option>
						</select><br/>
		
		<input type="hidden" name="name_hid" value="<?=$arr['name']?>">
		<input type="hidden" name="lname_hid" value="<?=$arr['lastname']?>">
		<input type="hidden" name="id" value="<?=$arr['id']?>">
		<input type="submit" name="add" value="Add"></div></html>
		<?
//вывод таблицы с визитами
	$i=1;
	foreach($arr2 as $value){
		$content.="<tr><td>$i.</td>
		<td>{$value['visit_date']}</td>
		<td>{$value['order_amount']}</td>
		<td>{$value['order_status']}</td>
		<td><a href='edit.php?update=".$value['id']."&id=".$arr['id']."'>Update</a></td>
		<td><a href='edit.php?delete=".$value['id']."&id=".$arr['id']."'>Delete</a></td></tr>"; 
		$i++;
	}; 
	?>
	<div class="visit">
	<h3>Visit History</h3>
	<table border='1'>
	<tr><th>Visit</th> <th>Date</th> <th>Order Amount (USD)</th> 
	<th>Order Status</th><th>Update</th><th>Delete</th></tr>
	<?=$content;?>
	</table></div>
	<h3 align="center"><a href="index.php">Go to Home Page</a></h3>
	<?
	$sql="SELECT * FROM add_visit WHERE patient_id='$id'";
	$link=mysqli_connect("localhost","root","","patients")//здесь вставьте свои реквизиты!!(1 - хост. 2 - юзер. 3 - пароль. 4- название БД)
	or die(mysqli_error($link));
	$query2=mysqli_query($link,$sql) or die(mysqli_error($link));
	$arr2=array();
	while($row=mysqli_fetch_assoc($query2)){
		$arr2[]=$row;
	}
mysqli_close($link);
}
//функция для "реагирования" на редкатирование
function buttons(){
//действие при нажатии на 'delete'
	if(isset($_GET['delete'])){
		$link=mysqli_connect("","","","patients")//здесь вставьте свои реквизиты!!(1 - хост. 2 - юзер. 3 - пароль. 4- название БД) 
		or die(mysqli_error($link));
		$name=$_GET['name'];
		$lastname=$_GET['lastname'];
		$id=$_GET['id'];
		$del=$_GET['delete'];
		$sql="SELECT * FROM patient_info WHERE id='$id'";
		$query=mysqli_query($link,$sql)or die(mysqli_error($link));
		$arr=array();
		while($row = mysqli_fetch_assoc($query)){	
			$arr=$row;
		}
		$id=$arr['id'];
		$sql="SELECT * FROM add_visit WHERE patient_id='$id'";
		$query2=mysqli_query($link,$sql) or die(mysqli_error($link));
		$arr2=array();
		while($row=mysqli_fetch_assoc($query2)){
			$arr2[]=$row;
		}
		$sql="DELETE FROM add_visit WHERE id='$del'";
		$query = mysqli_query($link,$sql)or die(mysqli_error($link));
		header("location:registry.php?id=".$_GET['id']);
//действие, при нажатии на "add"
}elseif(isset($_POST['add'])){
	$link=mysqli_connect("localhost","root","","patients")//здесь вставьте свои реквизиты!!(1 - хост. 2 - юзер. 3 - пароль. 4- название БД)
	or die(mysqli_error($link));
	$date=date("d-m-Y");
	$oa=$_POST['order_amount'];
	$os=$_POST['order_status'];
	$id=$_POST['id'];
	$sql="INSERT INTO add_visit(visit_date,
	order_amount,order_status,patient_id)
	VALUES('$date','$oa','$os','$id')";
	$query = mysqli_query($link,$sql) or die(mysql_error($link));
	$name=$_POST['name_hid'];
	$lastname=$_POST['lname_hid'];//только вместо id гет ид
	$sql="SELECT * FROM patient_info WHERE name='$name' and lastname='$lastname'";
	$query=mysqli_query($link,$sql)or die(mysqli_error($link));
	$arr=array();
	while($row = mysqli_fetch_assoc($query)){	
		$arr=$row;
	}
	$sql="SELECT * FROM add_visit WHERE patient_id='$id'";//
	$query2=mysqli_query($link,$sql) or die(mysqli_error($link));
	$arr2=array();
	while($row=mysqli_fetch_assoc($query2)){
		$arr2[]=$row;
	}
	$query2=mysqli_query($link,$sql) or die(mysqli_error($link));
	$arr2=array();
	while($row=mysqli_fetch_assoc($query2)){
		$arr2[]=$row;
	}
	header("location:registry.php?id=".$_POST['id']);
//действие, при нажатии на "update"
}elseif(isset($_GET['update'])){
	$link=mysqli_connect("localhost","root","","patients")//здесь вставьте свои реквизиты!!(1 - хост. 2 - юзер. 3 - пароль. 4- название БД)
	or die(mysqli_error($link));
	$id = $_GET['id'];
	$upd =$_GET['update'];
	$sql="SELECT * FROM add_visit WHERE patient_id=$id";
	$query2=mysqli_query($link,$sql) or die(mysqli_error($link));
	$arr2=array();	
	while($row=mysqli_fetch_assoc($query2)){
		$arr2=$row;
	}
	mysqli_close($link);
	?>
	<html>
	<head>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/main.css">
	<meta charset="UTF-8" />
	</head>
	<div class="updt">
	<form action="update.php" method="post">
		<h3>Update Visit</h3>
		<hr>
		order amount:<br>
		<input type="text" name="order_amount_update" required><br/>
		order status:<br/><select name="order_status_update" required>
							<option></option>
							<option>Completed</option>
							<option>In progress</option>
							<option>Cancelled</option>
						</select>
						
						<input type="hidden" name="id" value="<?=$upd?>">
						<input type="hidden" name="user_id" value="<?=$id?>">
						<input type="submit" name="save" value="Save"></form></div></html><?
}}
