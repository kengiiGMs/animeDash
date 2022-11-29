$(document).ready(function () {
	$("#loading").hide();
	$(document)
		.ajaxStart(function () {
			$("#loading").show();
		})
		.ajaxStop(function () {
			$("#loading").hide();
		});

	$(document).on("click", ".gerarPersonagem", function () {
		var url = "https://animechan.vercel.app/api/random";
		$.ajax({
			url: url,
			dataType: "json",
			type: "GET",
			success: function (dados) {
				if (dados) {
					var noteEnglish = dados.quote;
					var urlTradutor =
						"https://api.mymemory.translated.net/get?q=" +
						noteEnglish +
						"&langpair=en|pt";
					$.ajax({
						url: urlTradutor,
						dataType: "json",
						type: "GET",

						success: function (dados) {
							if (dados) {
								var resultadoTraduzido = dados.responseData.translatedText;
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
	$(document).on("click", ".limpar", function () {
		$("#anime").val("");
		$("#character").val("");
		$("#quoteENG").val("");
		$("#quotePT").val("");
	});
});
