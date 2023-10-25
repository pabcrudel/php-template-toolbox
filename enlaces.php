<?php
//me quedé aquí
    if (isset($_POST['username']) || isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if (empty($username) || empty($password)) {
            echo "Alguna variable está vacía";
        } else {
            echo "Ambas variables con datos";
        }
    } else {
        echo "Faltan variables en el formulario";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enlaces</title>
</head>
<body>
    
</body>
</html>