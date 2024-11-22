<?php
include 'conexao.php';

//verificar se a requisição atual é um POST
if($_SERVER ["REQUEST_METHOD"] == "POST")
{
    //limpar o emaile armazena
    $email = htmlspecialchars($_POST['email']);
    $nome = htmlspecialchars($_POST['nome']);
    $senha = $_POST['Senha'];

    try
    {
        $stmt = $conn->prepare("SELECT id_cliente, senha, nome FROM Usuarios
                                Where email = :email");
        $stmt->bindParam(':email',$email);
        $stmt->execute();
        
        //obtem o resultado para trabalhar depois
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        //verificar se algum usuario foi retornada a consulta 
        //SE existir usuario
        if($usuario){
            if(password_verify($senha,$usuario['senha']))
            {
                //inicia sessao para armazenarinformação do usuario
                session_start();
                //regenerar o id da sessao para prevenis sequestro da sessao
                session_regenerate_id();
                //defgini configuções seguras para cookie da sessao
                session_set_cookie_params(['secure'=>true,
                                            'httponly'=>true,
                                            'samesite'=>'Strict']);
                //armazenar o id o usuario e o estado de login
                $_SESSION['usuario_id'] = $usuario['id_cliente'];
                $_SESSION['logado'] = true;

                //redireciona o usuario parea a para a pagina do painel apos login
                header("Location: painel.php");
                exit;


            }
            else
            {
                //caso a senha não esteja correta 
                echo "Senha Incorreta";
            }
        }else
        {
            echo "Usuario não encontrato";
        }
    }catch(PDOException $e){
        echo "Erro no login". $e->getMessage();
    }

    
}