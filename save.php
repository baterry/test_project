<?
//очистка данных
function clearData($data){
   return	stripslashes(strip_tags(trim($data)));
}
$name=clearData($_POST['registry_name']);
$lastname=clearData($_POST['registry_lastname']);
$birthday=clearData($_POST['registry_dateofbirth']);
$address=clearData($_POST['registry_address']);
$phone=clearData($_POST['registry_phone']);
$email=clearData($_POST['registry_email']);
$reye=clearData($_POST['registry_lefteye']);
$leye=clearData($_POST['registry_righteye']);
//добавление клиента в БД
$sql="INSERT INTO patient_info (name, lastname, birthday, address, phone, email, leye, reye)
VALUES ('$name','$lastname','$birthday','$address','$phone','$email','$leye','$reye')";
if(isset($_POST['registry_submit'])){
mysqli_query($link,$sql) or die(mysqli_error($link));
//при успешном добавлении редирект на главную страницу
header("location:index.php");
}
?>