$(document).ready(function () {

  $("#my_file").change(function () {
    if (this.files && this.files[0]) {
      var mimeType = this.files[0]['type'];
      var reader = new FileReader();
      var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
      reader.onload = function (e) {
        //  alert(e.target.result);
        if (mimeType.split('/')[0] === 'image') {
          $('#ftt').attr('src', e.target.result);
          $("#ftt").css({ visibility: "visible" });

        } else {
          alert("No es una imagen");
        }
        console.log(e.target.result);

      }
      reader.readAsDataURL(this.files[0]);
    }
  });
  //$("#my_file").change(function() {
  // readURL(this);
  //});

  /*$('form').submit(function (e) {

    //var imgVal = $('#my_file').val(event); 

    if ($('#ftt').attr('src') == '') {
      alert("sube una foto");
      e.preventDefault();
    }
  });*/


});