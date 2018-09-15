<?php 
class Usuario{
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;
	//alimenta com "" para dizer que pode ser vazio
	public function __construct($deslogin="",$dessenha=""){
		$this->deslogin=$deslogin;
		$this->dessenha=$dessenha;
	}
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
	public function setData($dados){
			$this->setIdusuario($dados['idusuario']);
			$this->setDeslogin($dados['deslogin']);
			$this->setDessenha($dados['dessenha']);
			//colocar em formato data e hora
			$this->setDtcadastro(new DateTime($dados['dtcadastro']));
	}
	public function insert(){
		$model=new Model();
		//usando uma procedure
		//CREATE PROCEDURE `sp_usuarios_insert` (
		//pdeslogin VARCHAR(64),
		//pdessenha VARCHAR(256)
		//)
		//BEGIN
		//INSERT INTO tb_usuarios(deslogin,dessenha) VALUES(pdeslogin,pdessenha);
    	//SELECT * FROM tb_usuarios WHERE idusuario = LAST_INSERT_ID();
		//END
		$resultado=$model->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)",array(":LOGIN"=>$this->getDeslogin(),":PASSWORD"=>$this->getDessenha()));
		if (count($resultado)>0) {
			$this->setData($resultado[0]);

		}
	}
	//usando o update para alterar dados
	public function update($login,$password){
		$this->setDeslogin($login);
		$this->setDessenha($password);
		$model=new Model();
		$model->query("UPDATE tb_usuarios SET deslogin=:LOGIN AND dessenha=:PASSWORD WHERE idusuario=:ID",array(":LOGIN"=>$this->getDeslogin(),":PASSWORD"=>$this->getDessenha(),":ID"=>$this->getIdusuario()));

	}
	//o loadId carrega um usuario
	public function loadId($id){
		$model=new Model();
		$resultado=$model->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID",array(":ID"=>$id));
		if (count($resultado)>0) {
			$this->setData($resultado[0]);
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
			$this->setData($resultado[0]);

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