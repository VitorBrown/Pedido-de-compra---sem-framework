<?php 

    include_once 'php/includes/controller/ControllerUsuario.php';

    $cUsuario = new ControllerUsuario;

    if($cUsuario->logado()){
        header('location: sistema/index.php');
        die();
    }

    if(isset($_POST['email'])){
        $cUsuario->fazer_login($_POST);
    }

?>

<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>

<form method='post' action='index.php'>
    
    <input name='email' type='email'/>
    <input name='senha' type='password'/>
    <input type='submit' />
</form>

</body>
</html>