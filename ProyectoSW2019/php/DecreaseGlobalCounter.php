<?php
$email = $_GET["email"];

function cambiar(){
   echo "<script type='text/javascript'>window.location.href = 'Layout.php'; </script>";
 }
$xml = simplexml_load_file("../xml/Counter.xml");

// Create a child in the first topic node
$encontrado = false ;
foreach ($xml->user as $user){
    if ($_GET["email"]== ($user->p)){
     //   $user->p.remove();
     $encontrado = true ;
     print_r($user);
     $dom=dom_import_simplexml($user);
     $dom->parentNode->removeChild($dom);        
       

    }
}
if($encontrado==true){
  
print_r((integer)$xml[0]["contador"]=(integer)$xml[0]["contador"]-1) ;
}

// Add the text attribute
$xml->asXML('../xml/Counter.xml');
cambiar();
?>
