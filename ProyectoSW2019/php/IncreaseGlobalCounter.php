<?php
$email = $_GET["email"];
 function alertredirect($mensaje, $email){
    echo "<script type='text/javascript'>alert('$mensaje'); window.location.href = 'Layout.php?email=$email'; </script>";
  }

$xml = simplexml_load_file("../xml/Counter.xml");
// Create a child in the first topic node
$encontrado = false ;
foreach ($xml->user as $user){
    if ($email== ($user->p)){
        $encontrado = true;
    }
}
if($encontrado==false){
print_r((integer)$xml[0]["contador"]=(integer)$xml[0]["contador"]+1) ;
$child = $xml->addChild("user");
$child-> addChild('p',$_GET["email"]);

}


// Add the text attribute
$xml->asXML('../xml/Counter.xml');
alertredirect("Bienvenido " . $email . "!", $email);

?>