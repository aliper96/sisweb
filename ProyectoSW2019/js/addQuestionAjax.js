
$(document).ready(function () {

    // process the form
    $('#boton').click(function (event) {
        // event.preventDefault();
        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)

        var frm = $("#fquestion")[0];
        var em = $("#em").val();

        var urrl = "AddQuestionWithImage.php?email="+em;
        // Create an FormData object 
         var datos = new FormData(frm);
      


        // process the form
        $.ajax({

            type: 'post',
            enctype: 'multipart/form-data',

            url: urrl,
            data: datos, // our data object
            processData: false,
            contentType: false,
            cache : false,
            timeout: 8000,
            dataType: "html", // what type of data do we expect back from the server
            success: function (data) {
              
                    $("#err").html(data);

                console.log(data);
            },
            error: function (data) {
               
                $("#err").html(data);
                console.log(data);
            },
        });



        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();

    });

});