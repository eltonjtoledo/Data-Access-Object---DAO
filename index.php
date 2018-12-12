<?php
require_once './config.php';

//  Carrega um usuario pelo seu ID
//  
//$user = new Usuario();
//$user->loadById('5');
//echo $user;

//  Carrega uma lista com todos os Usuarios
//  
//$lista = Usuario::getList();
//echo json_encode($lista);

//  Carrega uma lista de Usuarios esquisando por texto informado
//  
//$search = Usuario::searchList('el');
//echo json_encode($search);

//  Carrega um usuario validando com login e senha
//
//$login =  new Usuario();
//$login->logar('elton', '6624');
//echo $login;

//  Cadastra um novo usuario
//
//$aluno = new Usuario();
//$aluno->insert('Asristel', '!@576#$');
//echo $aluno;

//  Fazendo Update dos dados do usuario
//
//$update = new Usuario('Matheus', '*%$#', '10');
//$update->update();
//echo $update;

//  Apagando Usuario
//
$delete = new Usuario();
$delete->Delete(11);
echo $delete;
