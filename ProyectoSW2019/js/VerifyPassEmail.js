$(document).ready(function (event) {

    $("form input").change(function comprobar() {
        $("#Boton").attr("disabled", true);
        $email = $('#email');
        $.ajax({
            url: "ClientVerifyEnrollment.php?email=" + $email.val(), cache: false,
            success: function (result) {
                //             alert(result);
                if (result == "SI") {
                    $("#mail").html("Email VIP");
                    $cont = $("#password");
                    if ($cont.val().trim().length >= 6) {
                        var $ticket = 1010;
                        $.ajax({
                            url: "VerifyPassWS.php?cont=" + $cont.val() + "&ticket=" + $ticket,
                            cache: false,
                            datatype: "html",
                            success: function (res) {

                                if (res.trim() == "VALIDA") {

                                    $("#pass").html("Contraseña VÁLIDA");
                                    var contrasena = $("#password").val();
                                    var contrasena_rep = $("#passwordr").val();

                                    if (contrasena.trim().length >= 6 && contrasena.trim() == contrasena_rep.trim()) {
                                        $("#Boton").attr("disabled", false);
                                    }
                                    else {
                                        $("#Boton").attr("disabled", true);
                                    }
                                } else {
                                    $("#pass").html("Contraseña no VÁLIDA");
                                }
                            }
                        });
                    }
                } else {
                    $("#mail").html("Email no VIP");
                }
            }
        });
    });
});

