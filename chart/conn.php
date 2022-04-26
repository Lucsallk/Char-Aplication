<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "admin";


try {
    //Conexao com a porta
    //$conn = new PDO("mysql:host=$host;port=$port;dbname=" . $dbname, $user, $pass);

    //Conexao sem a porta
    $conn = new PDO(
        "mysql:host=$host;dbname=" . $dbname,
        $user,
        $pass,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => " SET NAMES UTF8")
    );

    //echo "Conexão com banco de dados realizado com sucesso.";
} catch (PDOException $erro) {
    echo "Erro: Conexão com banco de dados não realizado com sucesso. Erro gerando " . $erro->getMessage();
}