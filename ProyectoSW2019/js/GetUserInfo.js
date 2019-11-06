$(document).ready(function() {

    $("#butt").click(function () {
    $.get('../xml/Users.xml', function(d){

    var usuario = $(d).find('usuario');
    var encontrado = false;
    usuario.each(function(index, element) { 

        console.log(   $(element.children[1]).html()  );
        if($(element.children[0]).html()==$("#email").val()){
            encontrado = true;
            $("#nombre").val($(element.children[1]).html())  ;
            $("#apellidos").val($(element.children[2]).html()+" "+$(element.children[3]).html())  ;
            $("#telefono").val($(element.children[4]).html())  ;



        }


});
if (encontrado === false){
    alert("No se encontro el correo");
}
  
});
});
});
