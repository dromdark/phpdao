<?php 
require_once("config.php");
//$mdl= new Model();
//$usuarios=$mdl->select("SELECT * FROM tb_usuarios");
//echo json_encode($usuarios);
$usuario=new Usuario();
$usuario->loadId(3);
echo $usuario;

 ?>