     <?php 
         $email = $_GET['email'];
        require('DbConfig.php');
        $conexion = mysqli_connect($server, $user, $pass, $basededatos);
        $preguntass = "SELECT COUNT(*) FROM preguntas" ;
        $mispreguntass = "SELECT COUNT(*) FROM preguntas where email ='$email' ";
        $preguntas =      mysqli_fetch_array( $conexion->query($preguntass));
        $mispreguntas = mysqli_fetch_array($conexion->query($mispreguntass));
        print_r($mispreguntas[0]);
        echo"/";
        print_r($preguntas[0]);
        
       // $preguntas =      1;
        //$mispreguntas = 2;
        return array($preguntas[0],$mispreguntas[0]);
        
        
        ?>