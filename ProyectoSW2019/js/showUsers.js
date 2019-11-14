
$(document).ready(function bucle(event) {
   
    mispreguntas = 0;
     preguntas = 0;
    var em = $("#em").val();
    $.ajax({
        type: 'GET',
        url: '../xml/Counter.xml',
        cache: false,
        dataType: 'xml',
        success: function(xml) {
            setTimeout(function(){bucle(event);}, 10000);
            var node = 'user', 
            count = $(xml).find(node).length;
            $("#contador").html(count);
        },
        error: function(r) {
            console.error(r);
        }
    });






});
