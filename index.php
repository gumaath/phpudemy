<?php 

require_once("config.php"); 

// Carrega um usuario 

//$root = new Usuario();
//$root->loadById(1);
//echo $root;

// Pega todos os usuarios por causa da function getList que faz isso

//$lista = Usuario::getList();
//echo json_encode($lista);

// Carrega uma lista de usuarios buscando pelo login para
//$search = Usuario::search("gus");
//echo json_encode($search);

// Carrega um usúario usando o login e a senha
//$usuario = new Usuario();
//$usuario->login("gustavo", "abcdef");
//echo $usuario;

$aluno = new Usuario(); 
$aluno->setDeslogin("aluno");
$aluno->setDessenha("aluno123");
$aluno->insert();

echo $aluno;

?>