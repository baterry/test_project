<?php
//подключение к БД
$link=mysqli_connect("localhost","root","","patients") or die(mysqli_error($link));//здесь вставьте свои реквизиты!!(1 - хост. 2 - юзер. 3 - пароль. 4- название БД)
//проверка на "правильность" перехода на страницу
if(isset($_POST['submit']) or isset($_POST['registry_submit'])
or isset($_POST['add']) or isset($_POST['register'])
or isset($_GET['id'])) {
//подключение файла получения данных из БД
	include "get.php";
//проверка на переход из файла update.php	
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$sql="SELECT * FROM patient_info WHERE id='$id'";
		$query=mysqli_query($link,$sql) or die(mysqli_error($link));
		$arr=array();
		while($row=mysqli_fetch_assoc($query)){
			$arr=$row;
		}
	}
//проверка на существование введенного имени в базе данных
	if(isset($arr['name'])){
		$id=$arr['id'];
		$sql="SELECT * FROM add_visit WHERE patient_id='$id' ";
		$query2=mysqli_query($link,$sql) or die(mysqli_error($link));
		$arr2=array();
		while($row=mysqli_fetch_assoc($query2)){
			$arr2[]=$row;
		}
//подклчение файла с функциями 
		include "edit.php";
		buttons();
		edit_table($arr,$arr2);
		}}
//если не существует клиента в базе, предлагается зарегистрироваться
if(!isset($arr['name']) or isset($_POST['register'])){
//подключение файла, который заносит нового клиента в БД
	include "save.php";
	?>
	<head>
	<meta charset="UTF-8" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/main.css">
	<div class="reg">
	<h3 align="center">New patient</h3>
	<form align="center" action="registry.php" name="registry" method="post">
	First Name:<br /><input type="text" name="registry_name" required><br/>
	Last Name:<br /><input type="text" name="registry_lastname" required><br/>
	Date of Birth:<br /><input type="text" name="registry_dateofbirth" required><br/>
	Address:<br /><input type="text" name="registry_address" required><br/>
	Phone:<br /><input type="text" name="registry_phone" required><br/>
	Email:<br /><input type="text" name="registry_email" required><br/>
	Left Eye (-10 - +10)<br /><select  name="registry_lefteye" required>
							<option></option>
							<?
							for($i=-10;$i<=10;$i++){
								echo"<option>$i</option>";
							}
							?>
														</select><br/>
	Right Eye (-10 - +10)<br /><select  name="registry_righteye" required>
							<option></option>
							<?
							for($i=-10;$i<=10;$i++){
								echo"<option>$i</option>";
							}
							?>
														</select><br><br>
	<input type="submit" name="registry_submit" value="save" />
	</form></div>
	<? }
//закрытие соединения с БД
mysqli_close($link);
?>
