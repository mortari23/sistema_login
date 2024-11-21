<?php
/*
conexão com BD usando PDO : PDO permite acessar 
qualquer BD.
PDO=PHP Data Objects = PHP Objetos de dados 
*/

//Declara  varieveis com os dados de conexão
$host = 'localhost';
$dbname = 't57_login';
$usuario = 'root';
$senha ='';

// Data Source Name = nome da origem dos dados
$dns ="mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try 
{
    //cria conexao
    $conn = new PDO($dns,$usuario,$senha);

    $conn->SetAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
}catch(PDOException $e)
{
die("ERRo de Conexão". $e->getMessage());
}