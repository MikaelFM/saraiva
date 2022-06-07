<?php
    session_start();
    $POST = json_decode(file_get_contents('php://input'), true);
    print_r($POST);
    if(empty($POST)){
        $_SESSION["post"] = $_POST;
    } else { 
        $_POST =  $POST;
        $assunto = $_POST['assunto'];
        $nome = $_POST['nome'];
        $data_nasc = $_POST['data_nascimento'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $endereco = $_POST['endereco'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $mensagem = $_POST['mensagem'];
        $data_envio = $_POST['data_envio'];
        $sql = "INSERT INTO mensagens(assunto, nome, data_nascimento, email, telefone, endereco, cidade, estado, mensagem, data_envio) 
        VALUES ('$assunto', '$nome', '$data_nasc', '$email', '$telefone', '$endereco', '$cidade', '$estado', '$mensagem', '$data_envio')";
        query($sql);
        $request = select();
        $data = [];
        foreach($request as $key => $value){
            $request[$key]['mensagem'] = mb_strimwidth($request[$key]['mensagem'], 0, 138, "...");
            $data['m_'. $request[$key]['id_mensagem']] = $request[$key];
        }
        $json = json_encode($data);
        $_SESSION["data"] = $json;
    }
    function select(){
        return query('SELECT * FROM mensagens');
    }
    function query ($sql){
        $host = 'ec2-54-147-33-38.compute-1.amazonaws.com';
        $database = 'd78eouf0e3tf1e';
        $user = 'rsutudjnrmhnof';
        $port = '5432';
        $password = '62f915d1e9786f98c12957a0c551dee19f9598b9dff376f636b25a2e02e1ef52';
        $connection = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");
        $result = pg_query($connection, $sql);
        return pg_fetch_all($result);
    }

?>