<?php
$db_host="localhost";
$db_user=getEncryptedUser();
$db_password=getEncryptedPass();
$db_name="mibase";
$db_table_name="clientes";
   $db_connection = mysql_connect($db_host, $db_user, $db_password);

if (!$db_connection) {
	die('No se ha podido conectar a la base de datos');
}
$subs_name = utf8_decode($_POST['nombre']);
$subs_last = utf8_decode($_POST['apellido']);
$subs_email = utf8_decode($_POST['email']);

$resultado=mysql_query($db_connection,"SELECT * FROM clientes WHERE Email = '$subs_email'");

if (mysql_num_rows($resultado)>0)
{

header('Location: Fail.html');

} else {
	
	$insert_value = "INSERT INTO clientes(Nombre, Apellido, Email) VALUES ('$subs_name','$subs_last','$subs_email')";

mysql_select_db($db_name, $db_connection);
$retry_value = mysql_query($insert_value, $db_connection);

if (!$retry_value) {
   die('Error: ' . mysql_error());
}
	
header('Location: Success.html');

}

mysql_close($db_connection);

		
?>