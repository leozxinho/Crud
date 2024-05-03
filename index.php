<?php

$pdo = new PDO('mysql:host=localhost;dbname=in-leonardo','root','');
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
// Insert.

if(isset($_GET['delete'])){
    $id = (int)$_GET['delete'];
    $pdo->exec("DELETE FROM usuarios WHERE id=$id");
    echo 'Deletado com sucesso o usuário do id: '.$id;
}

if(isset($_POST['nome'])){
    $sql = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $sql->execute(array($_POST['nome'],$_POST['email'],$_POST['senha']));
    echo 'Inserido com sucesso!';
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Aprendendo CRUD em PHP</title>
</head>
<body>
<form class="container" method="post">
    <input class="user-input" type="text"  placeholder="Digite seu nome" name="nome">
    <input class="user-input" type="text" placeholder="Digite seu e-mail" name="email">
    <input class="user-input" type="password" placeholder="Digite sua senha" name="senha">
    <input class="btn" type="submit" value="ENVIAR">
</form>
</body>
</html>

<?php

$sql = $pdo->prepare("SELECT * FROM usuarios");
$sql->execute();

$fetchUsuarios = $sql->fetchAll();

foreach ($fetchUsuarios as $key => $value) {
   echo '<a href="?delete=' .$value['id'].'">Deletar  </a>' .$value['nome'].' | ' .$value['email'];
echo '<hr>';
}

?>


