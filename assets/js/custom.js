$(document).ready(function(){
    // initialize modal
    $('.modal').modal();
    montaUF();
    

});
function montaUF(){
	$.ajax({
		type:'GET',
		url:'http://api.londrinaweb.com.br/PUC/Estados/BR/0/10000',
		contentType: "application/json; charset=utf-8",
		dataType: "jsonp",
		async:false
	}).done(function(response){
		estados='';
		$.each(response, function(e, estado){

			estados+='<option value="'+estado.UF+'">'+estado.Estado+'</option>';

		});

		// PREENCHE OS ESTADOS BRASILEIROS
		$('#stateUF').html(estados);

		// CHAMA A FUNÇÃO QUE PREENCHE AS CIDADES DE ACORDO COM O ESTADO
		montaCidade($('#stateUF').val());

		// VERIFICA A MUDANÇA NO VALOR DO CAMPO ESTADO E ATUALIZA AS CIDADES
		$('#stateUF').change(function(){
		montaCidade($(this).val());
		});

	});
} 

function montaCidade(estado){
	$.ajax({
		type:'GET',
		url:'http://api.londrinaweb.com.br/PUC/Cidades/'+estado+'/BR/0/10000',
		contentType: "application/json; charset=utf-8",
		dataType: "jsonp",
		async:false
	}).done(function(response){
		cidades='';

		$.each(response, function(c, cidade){

			cidades+='<option value="'+cidade+'">'+cidade+'</option>';

		});

		// PREENCHE AS CIDADES DE ACORDO COM O ESTADO
		$('#dcity').html(cidades);

	});
}
