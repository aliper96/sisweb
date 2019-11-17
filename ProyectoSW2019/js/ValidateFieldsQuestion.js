$(document).ready(function () {

  $("#my-file").change(function () {
    if (this.files && this.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#blah').attr('src', e.target.result);
        console.log(e.target.result);
      }

      reader.readAsDataURL(this.files[0]);
    }
  });

  $('form').submit(function () {
    var pre = $('#pre').val();

    if (pre.length <= 9) {
      alert("La pregunta debe tener almenos 10 caracteres");
      event.preventDefault();
    }

    var empty = false;

    $('input[type="text"]').each(function (event) {
      if ($(this).val() == "") {
        empty = true;
        return true;
      }
    });

    var em = $("#em").val();
    var regex1 = /^([a-zA-Z]+)([0-9]{3})@ikasle.ehu.(eus|es)+$/gm;
    var regex2 = /^([a-zA-Z]+)(\.?)([a-zA-Z]*)\@ehu\.(eus|es)+$/;
    var aux = false;

    if (regex1.test(em) == true || regex2.test(em) == true) {
      aux = true;
    }

    if (aux == false) {
      alert("email incorrecto");
      event.preventDefault();
    }

    if (empty == true) {
      alert("Los campos no pueden estar vacios");
      event.preventDefault();
    }

  });
});

