<?php 
require_once("config.php");
//$mdl= new Model();
//$usuarios=$mdl->select("SELECT * FROM tb_usuarios");
//echo json_encode($usuarios);
$usuario=new Usuario();
//$usuario->loadId(3);
//carrega um usuario especifico
//echo $usuario;
//carrega todos usuarios
//echo json_encode($usuario->getList());
//carrega uma lista de usuarios buscando pelo isuario
//echo json_encode($usuario->search("ca"));
//carrega um usuario usando o login ou a senha
$usuario->login("ca2","213214");
echo $usuario;
 ?>