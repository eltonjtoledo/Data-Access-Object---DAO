<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once './config.php';
        $sql = new sql();
        
        $usuario = $sql->select('SELECT * FROM tb_usuarios');
        echo json_encode($usuario);       
        ?>
    </body>
</html>
