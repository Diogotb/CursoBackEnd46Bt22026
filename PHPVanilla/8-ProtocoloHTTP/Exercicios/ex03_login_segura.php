<?php
declare(strict_types=1);

//declaração das variáveis
$email="";
$loginValidado = false;
$erros=[];

//pegar os dados do Formuláro
//verifica se o formulário está enviadno os dados como post
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $email = trim($_POST["email"] ?? ""); //limpar os espaços vazios antes e depois do texto
    $senha = trim($_POST["senha"] ?? ""); 

    //validações de dados => encontrando erros
    //Erro de Email
    if($email === "" || !filter_var($email,FILTER_VALIDATE_EMAIL)){
        $erros["email"] = "Informe um Email Válido.";
    }
    //Erro de Senha
    if(strlen($senha) < 6){
        $erros["senha"] = "A Senha Deve Ter no Mínimo 6 Dígitos !";
    }
    
    //Se senha e email estão OK
    if(empty($erros)){
        $emailCorreto = "admin@senai.br";
        $senhaCorreta = "senhaSegura123";

        // validando o email e a senha
        if($email === $emailCorreto && $senha ==$senhaCorreta){
            $loginValidado = true;
        } else{
            $erros["login"] = "Credenciais Inválidas!";
        }
    }
}

?>