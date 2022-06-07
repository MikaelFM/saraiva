<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dados.css">
    <title>Dados | Saraiva</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <?php
        if(!isset($_POST['assunto'])){
            session_start();
            $_POST = $_SESSION["post"];
            $naoMostrar = true;
        }
        $assunto = ucwords(strtolower(htmlspecialchars($_POST['assunto'])));
        $nome = ucwords(strtolower(htmlspecialchars($_POST['nome'])));
        $data_nasc = htmlspecialchars($_POST['data_nascimento']);
        $email = strtolower(htmlspecialchars($_POST['email']));
        $telefone = htmlspecialchars($_POST['telefone']);
        $endereco = ucwords(strtolower(htmlspecialchars($_POST['endereco'])));
        $cidade = ucwords(strtolower(htmlspecialchars($_POST['cidade'])));
        $estado = strtoupper(htmlspecialchars($_POST['estado']));
        $mensagem = ucfirst(htmlspecialchars($_POST['mensagem']));
        $data_envio = (new DateTime())->setTimezone(new DateTimezone('America/Argentina/Buenos_Aires'));
?>
</head>
<body> 
    <div id="verticalcenter">
        <section id="center">
            <div id="alert"
                <?php
                    if(isset($naoMostrar)){
                        echo "style=\"opacity: 0.0;\"";
                    }
                ?>
            >
            <p style="font-size: 0.8vw;">Mensagem enviada com sucesso</p> 
            </div>
            <div id="content">
                <div id="user">
                    <div id="icon"></div>
                    <div id="info">
                        <p id="superior">
                        <?php echo $nome?></span>
                        </p> 
                        <p id="inferior">
                            <?php echo "$email <br> $endereco, $cidade - $estado"?>
                        </p>
                    </div>
                </div>
                <div id="text">
                    <h1><?php echo $assunto?></h1>
                    <p id="mensagem"><?php echo $mensagem?></p>
                    <p id="data" style="font-size: 0.8vw;" ><?php echo $data_envio->format('d/m/Y')?></p>
                </div>
            </div>
            <button id="button">OK</button>
        </section>
    </div>
    <script src="../js/utils.js"></script>
    <script>
        $('#button').click(function(){
            const adicionar = <?php echo isset($naoMostrar) ? 'false' : 'true'; ?>;
            if(adicionar){
                    axios.post('php/connection.php',{
                    assunto: '<?php echo $assunto?>',
                    nome: '<?php echo $nome?>',
                    data_nascimento: '<?php echo $data_nasc?>',
                    email: '<?php echo $email?>',
                    telefone: '<?php echo $telefone?>',
                    endereco: '<?php echo $endereco?>',
                    cidade: '<?php echo $cidade?>',
                    estado: '<?php echo $estado?>',
                    mensagem: '<?php echo $mensagem?>',
                    data_envio: '<?php echo $data_envio->format('d/m/Y')?>',
                })
                .then(function (response){
                    window.location.href = 'mensagens.php';
                })
                .catch(function(response){
                    alert("ocorreu um erro");
                    console.log(response);
                })
            } else {
                axios.post('php/connection.php',{})
                .then(function (response){
                    window.location.href = 'mensagens.php';
                })
                .catch(function(response){
                    alert("ocorreu um erro");
                    console.log(response);
                })
            }
        })
    </script>
</body>
</html>