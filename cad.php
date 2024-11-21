<?php
//codigo para receber as informaçoes do HTMl e fazer algo
//capturar o que o usuario digitou e cadastrar no bd

//chama aqrquivos de conexao
include 'conexao.php';

//Verificar se existe alguma informação chegando pela rede
if($_SERVER["REQUEST_METHOD"] == "POST")
{

    //Recebe o email filtra e armazena a varievel
    $email = htmlspecialchars($_POST['email']);

    //recebe a snha e crptografa e armazena
    $senha = password_hash ($_POST['Senha'],PASSWORD_DEFAULT);

    // exibe a variavel para testar
    //var_dump($senha);

    try{
        //prepara o coando sql para inserir no anco de dados
        //ultiliza o prepares para prevero injetar sql
        $stmt = $conn->prepare("INSERT INTO Usuarios (email,senha)
                                Values(:email, :senha)");
        
        $stmt->bindParam(":email",$email);
        $stmt->bindParam(":senha",$senha);

        $stmt->execute();
        echo"cadastrado com sucesso";
    }catch(PDOException $e){
        echo "Erro ao cadastrar o usuario :".$e->getMessage();
    }
}