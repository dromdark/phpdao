<?php 

//spl autoload register registra o arquivo e pode procurar em pastas, é poss[ovel realizar uma função anonima dentro da função sql_autoload_register
spl_autoload_register(function($classenome){
	if(file_exists("class".DIRECTORY_SEPARATOR."$classenome.php")==true){
		require_once("class".DIRECTORY_SEPARATOR."$classenome.php");
	}
});




 ?>