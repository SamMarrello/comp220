<?php 
require_once("include.php");
//main
$mysqlObj = CreateConnectionObject();
$TableName = "fontNames";
//write headers with all student first and last names
//if (isset($_POST['f_Save']))saveFile($p));
// else if openFile();
//  else if findButton, findTextInFile($p1, $p2);
//else drawMenu();
if (isset($mysqlObj)) $mysqlObj->close();
//write footers
?>
