<?php
    session_start();
    $json = $_SESSION["data"];
    echo ($json);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensagens | Saraiva</title>
    <link rel="stylesheet" href="../css/mensagens.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <h1>Mensagens também enviadas</h1>
        <a href="./contato.html">enviar mais uma</a>
    </header>
    <section id="msgs">
        <div class="mensagem" v-for="(item, index) in dados">
            <div class="icon"></div>
            <div class="content">
                <p class="assunto">{{item.assunto}}</p>
                <p class="resumo">{{item.mensagem}}</p>
                <p class="data">By {{item.nome}}</p>
            </div>
            <div v-bind:id="index" class="reticencias">
                <i class="fa-solid fa-ellipsis"></i>
            </div>
        </div>
        <a id="button" href="./home.html">OK</a>
    </section>
    <script src="../js/utils.js"></script>
    <script>
        const dataMsg = <?php echo ($_SESSION["data"]); ?>;
        const App = new Vue ({
            el: '#msgs',
            data: {
                dados: dataMsg
            }
        })
        $('.reticencias').click(function(){
            dataMsg[this.id]['naoAdicionar'] = false;
            $.ajax({
                type: "POST",
                url: 'php/connection.php',
                data: dataMsg[this.id],
                success: function(response){
                    window.location.href = 'dados.php';
                },
                error: function(response) {
                    console.log(response);
                }
            })
        })
    </script>
</body>
</html>