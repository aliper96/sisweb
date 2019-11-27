$(document).ready(function (event) {
    $("#pre").click(function (e) { 
 $pregunta = $("#pregunta").val();        
   
$.ajax({url: "../php/GetQuestionWS.php?pregunta=" +  $pregunta,
 cache: false,
 success: function(result){
  
    if (result[0].trim()==="") {
        $("#error").html("Autor: ... <br>Pregunta: ... <br>Respuesta correcta: ...");	
    } else {
        
         divisiones = result.split(",", 3);
         resul = 'Autor: ' + divisiones[0] + '\nPregunta: ' + divisiones[1] + '\nRespuesta correcta: ' + divisiones[2];
         //alert(resul);
        $("#error").html('Autor: ' + divisiones[0] + '<br>Pregunta: ' + divisiones[1] + '<br>Respuesta correcta: ' + divisiones[2]);

    }
}});
});

});