<?php 
class Usuario{
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;
	public function getIdusuario(){
		return $this->idusuario;
	}
	public function setIdusuario($value){
		$this->idusuario=$value;
	}
	public function getDeslogin(){
		return $this->deslogin;
	}
	public function setDeslogin($value){
		$this->deslogin=$value;
	}
	public function getDessenha(){
		return $this->dessenha;
	}
	public function setDessenha($value){
		$this->dessenha=$value;
	}
	public function getDtcadastro(){
		return $this->dtcadastro;
	}
	public function setDtcadastro($value){
		$this->dtcadastro=$value;
	}
	//o loadId carrega um usuario
	public function loadId($id){
		$model=new Model();
		$resultado=$model->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID",array(":ID"=>$id));
		if (count($resultado)>0) {
			$row=$resultado[0];
			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			//colocar em formato data e hora
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}
	}
	//pega todos os valores da tabela,uma lista de usuarios
	public function getList(){
		$model=new Model();
		return $model->select("SELECT * FROM tb_usuarios ORDER BY idusuario");
	}
	//procurar por login
	public function search($login){
		$model=new Model();
		return $model->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH",array(":SEARCH"=>"%".$login."%"));
	}
	//função de login
	public function login($login,$password){
		$model=new Model();
		$resultado=$model->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD",array(":LOGIN"=>$login,":PASSWORD"=>$password));
		if (count($resultado)>0) {
			$row=$resultado[0];
			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			//colocar em formato data e hora
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}
		else{
			throw new Exception("Login ou senha inválido");
			
		}
	}
	//imprime 
	public function __toString(){
		return json_encode(
			array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
			)
		);
	}

}


 ?>