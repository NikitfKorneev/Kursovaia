<?php
require("db.php");

if(!empty($_POST)){
    $result = mysqli_query($mysql, "SELECT * FROM registr WHERE login =\"".$_POST['login']."\"");
    if(mysqli_num_rows($result) == 0){
        mysqli_query($mysql, "INSERT INTO registr (login, password) VALUES (
            \"".$_POST["login"]."\",
            \"".md5($_POST["password"])."\"
            )"
        );
        $_SESSION["user"] = $_POST["login"];
    }
}

$title = "Регистрация";
$content = "
<form method=\"POST\">
    <div>
        <label>Логин</label>
        <input type=\"text\" name=\"login\">
    </div>
    
    <div>
        <label>Пароль</label>
        <input type=\"password\" name=\"password\">
    </div>
    
    <div>
        <button type=\"submit\">Регистрация</button>
    </div>
</form>";

require("visual.php");
?>