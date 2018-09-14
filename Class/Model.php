<?php 
class Model extends PDO{
	private $conn;
	//faz uma função construtura que já conecta com o banco de dados
	public function __construct(){
		$this->conn= new PDO("mysql:host=localhost;dbname=dbphp7","root","");
	}
	//recebe os parametros para o bind param
	private function setParams($statment,$parameters=array()){
		foreach ($parameters as $key => $value) {
			$this->setParam($statment,$key,$value);
		}
	}
	//recebe apenas um valor para o bind param
	private function setParam($statment,$key,$value){
		$statment->bindParam($key,$value);
	}
	//executa a query desejada
	public function query($rawQuery,$params=array()){
		$stmt=$this->conn->prepare($rawQuery);
		$this->setParams($stmt,$params);
		$stmt->execute();
		return $stmt;
	}
	//fazendo um select
	public function select($rawQuery,$params=array()):array{
		$stmt=$this->query($rawQuery,$params);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);


	}
}
