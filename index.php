<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <button class="gerarPersonagem">click</button>
    <img src="img/loading.gif" alt="Carregando" id="loading">

    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Personagem:</label>
        <input type="text" class="form-control" id="anime" placeholder="Personagem" readonly>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Anime:</label>
        <input type="text" class="form-control" id="character" placeholder="Anime" readonly>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Nota:</label>
        <textarea class="form-control" id="quotePT" rows="3" readonly></textarea>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Nota Original:</label>
        <textarea class="form-control" id="quoteENG" rows="3" readonly></textarea>
    </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $("#loading").hide();
    $(document).ajaxStart(function() {
        $("#loading").show();
    }).ajaxStop(function() {
        $("#loading").hide();
    });

    $(document).on("click", ".gerarPersonagem", function() {

        var url = "https://animechan.vercel.app/api/random";
        $.ajax({
            url: url,
            dataType: "json",
            type: "GET",
            success: function(dados) {
                if (dados) {
                    var noteEnglish = dados.quote;
                    var urlTradutor =
                        "https://api.mymemory.translated.net/get?q=" + noteEnglish +
                        "&langpair=en|pt";
                    $.ajax({

                        url: urlTradutor,
                        dataType: "json",
                        type: "GET",

                        success: function(dados) {

                            if (dados) {
                                var resultadoTraduzido = dados.responseData
                                    .translatedText;
                                $("#quotePT").val(resultadoTraduzido);
                                console.log(dados);
                            } else {
                                alert("ERRO Não Encontrado");
                                $("#quotePT").val("");
                            }
                        },
                    });
                    console.log(dados);
                    $("#anime").val(dados.anime);
                    $("#character").val(dados.character);
                    $("#quoteENG").val(dados.quote);

                } else {
                    alert("ERRO Não Encontrado");
                    $("#anime").val("");
                    $("#character").val("");
                    $("#quoteENG").val("");
                    $("#quotePT").val("");
                }
            },
        });

    });



});
</script>

</html>