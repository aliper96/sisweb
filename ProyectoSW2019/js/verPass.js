$(document).ready(function (event) {




    $("form input").change(function comprobar() {
        $("#Boton").attr("disabled", true);
       
                                    var contrasena = $("#passwordd").val();
                                    var contrasena_rep = $("#passworddr").val();

                    if ($("#passwordd").val().trim().length >= 6) {
                        var $ticket = 1010;

                        $.ajax({
                            url: "VerifyPassWS.php?cont=" + $("#passwordd").val() + "&ticket=" + $ticket,
                            cache: false,
                            datatype: "html",
                            success: function (res) {
                                if (res.trim() == "VALIDA") {

                                    $("#pass").html("Contraseña VÁLIDA");

                                    

                                    if (contrasena.trim().length >= 6 && contrasena.trim() == contrasena_rep.trim()) {
                                    
                                     
                                        $("#Boton").attr("disabled", false);
                                    }
                                    else {
                                        $("#Boton").attr("disabled", true);
                                        $("#pass").html("Contraseñas no coinciden");

                                    }
                                } else {
                                	alert(contrasena);
                                    $("#pass").html("Contraseña no VÁLIDA");
                                }
                            },
                            error:function(res){
                            	alert(res);
                            }
                        });
                    }
                
            
       
    });
});

