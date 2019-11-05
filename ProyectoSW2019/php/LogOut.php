<!DOCTYPE html>
<html>

<head>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script>
function alertredirect($mensaje)
{
     alert($mensaje); window.location.href = 'Layout.php'; 
}

window.onload=alertredirect('HASTA PRONTO');
</script>
    <?php include '../html/Head.html' ?>
</head>


<body>

    <?php include '../php/Menus.php' ?>
    <section class="main" id="s1">

    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>


