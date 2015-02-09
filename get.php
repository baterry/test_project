<?php
//вывод данных клиента
$name=$_POST['name'];
$lastname=$_POST['lastname'];
$sql="SELECT * FROM patient_info WHERE name='$name' and lastname='$lastname'";
$query=mysqli_query($link,$sql)or die(mysqli_error($link));
$arr=array();//массив со значениями персональных данных
while($row = mysqli_fetch_assoc($query)){	
	$arr=$row;
}
$sql="SELECT * FROM add_visit WHERE patient_id='$id'";
$query=mysqli_query($link,$sql) or die(mysqli_error($link));
$arr2=array();//массив с визитами
	while($row=mysqli_fetch_assoc($query)){
	$arr2=$row;	
}
?>