<?
include ('config.php');
$id_bd=mysql_connect($dbhost,$dbuser,$dbpas);
mysql_select_db($dbname, $id_bd);
$q=mysql_query("SELECT * FROM users");
While($row=mysql_fetch_array($q)){
$phone=substr($row['phone_number'],1,strlen($row['phone_number'])-1);
echo $phone."<br/>";  
mysql_query("UPDATE users SET phone_number=$phone WHERE id_user=$row[id_user]");

}

?>
