<?php
session_start();
define("API_KEY", "AIzaSyAqfjsdb4ivKix2tYXt5Eyz5DzimcL26Gs") ?>
<!DOCTYPE html>
<html>

<head>
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/mapa.js"></script>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <style>
    #map-layer {
      height: 200px;
      width: 50%;
    }
    .tabla {
      height: 500px;
      overflow: scroll;
    }
  </style>
  <!--<script type="text/javascript" src="../js/ValidateFieldsQuestion.js"></script> -->

  <?php include '../html/Head.html' ?>
</head>

<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div class="tabla">

      <h2>DATOS DE LOS AUTORES</h2>
      <br>
      <table style="width: 100%">
        <tr>
          <th><img src="../images/ali.png" alt="Avatar" width="128"></th>
          <th></th>
          <th><img src="../images/gorka.png" alt="Avatar" width="128"></th>
        </tr>
        <tr>
          <td align="center"><b>Ali Hamza</b></td>
          <td></td>
          <td align="center"><b>Gorka Lucero Garrido</b></td>
        </tr>
        <tr>
          <td align="center">Computación</td>
          <td></td>
          <td align="center">Computación</td>
        </tr>
        <tr>
          <td align="center"><a href="mailto:ahamza002@ikasle.ehu.eus">ahamza002@ikasle.ehu.eus</a></td>
          <td></td>
          <td align="center"><a href="mailto:glucero001@ikasle.ehu.eus">glucero001@ikasle.ehu.eus</a></td>
        </tr>
      </table>
      <br>
      <div id="button-layer"><button id="btnAction" onClick="locate()">My Current Location</button></div>
      <br>
      <div style="text-align: center; margin:auto; height:400px; width:800px" id="map-layer"></div>

      <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo API_KEY; ?>&callback=initMap" async defer></script>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>

</html>
