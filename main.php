<?php

include "db.php";
$id = $_GET['id'];
$sql = "SELECT * FROM `registr` WHERE id = '$id'";
$result_login_name = mysqli_query($mysql, "SELECT login FROM `registr` WHERE id='$id'");
$result_role = mysqli_query($mysql, "SELECT role FROM `registr` WHERE id='$id'");
$Arr = mysqli_fetch_assoc($result_role);
$roles = $Arr['role'];
echo $roles;
echo'
<div class = "div_history" style= "position: absolute; left: 8%;top:30%; width: 80%; height: 20%; ">
    <p>Вы авторизовались под логином: ';  
    foreach ($result_login_name as $row) { 
        echo '<td>' . $row["login"] . '</td>';
    }
    echo'
</div>
';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
</head>

<form action="authorization.php" method="post" >
<input class = "button_main"  type="submit" value = "Выйти"/>
</form>
<style>
    th, td {
        padding: 10px;
    }

    th {
        background: #606060;
        color: #fff;
    }

    td {
        background: #b5b5b5;
    }
</style>


<body>
    <table>
        <tr>
            <th>Название заведения</th>
            <th>Номер телефона</th>
            <th>Количество посадочных мест</th>
            <th>Адрес</th>
            <th>Район</th>
        </tr>

        <div style = "position absolute ">
        <iframe src="https://www.google.com/maps/d/embed?mid=16Afm8x0mUAAXqpJRTWBN5aA1z3COXpY&ehbc=2E312F" width="640" height="480"></iframe>    
        </div>
        <?php







            
        
        if ($_POST != Null){
             $result3 = mysqli_query($mysql, "SELECT * FROM Com WHERE id_zav =\"".$_POST['Namezav']."\" and text =\"".$_POST['Otz']."\"");
                if(mysqli_num_rows($result3) == 0){
                $test = $_POST['Namezav'];
                $test1 = $_POST['Otz'];
                    mysqli_query($mysql, "INSERT INTO Com (id,id_user,text, id_zav) VALUES(Null, '$id', '$test','$test1')");
                }
            }
        //$out = mysqli_query($mysql, "SELECT * from registr join Com on registr.id = Com.id_user where Com.id_user = '$id'"); // вывод данных именно этого пользователя
        $out = mysqli_query($mysql, "SELECT * FROM Com ORDER BY 'id'");// Полный вывод всего
        // Имена тех кто оставил комент
        while($outs = mysqli_fetch_assoc($out)){
            ?>
            <div class ="comments">
            <div><?= $outs['id']?></div><br>
            <div><?= $outs['text']?></div><br>
            <div><?= $outs['id_zav']?></div><br>
            </div>
            <?php
            }



    $content6 = "
        <div>
            <form method=\"POST\">
            <div>
                <label>Ввидите номер комментария</label>
                <input type=\"text\" name=\"Numcom\">
            </div>

            <div>
                <label>Измените комментарий </label>
                <input type=\"text\" name=\"Otzizm\">
            </div>
                <div>
                    <button type=\"submit\ name=\"my1\" \">Изменить комментарий </button>
                </div>
                
            </form>
            </div>";
            if ($_POST != Null){
                $result4 = mysqli_query($mysql, "UPDATE Com SET text = \"".$_POST['Otzizm']."\" WHERE id = \"".$_POST['Numcom']."\";");
               }




    $content2 = "
    <div>
        <form method=\"POST\">
            <div>
                <label>Отзыв</label>
                <input type=\"text\" name=\"Namezav\">
            </div>

            <div>
                <label>Текст</label>
                <input type=\"text\" name=\"Otz\">
            </div>

            <div>
                <button type=\"submit\ name=\"my\" \">Ввести</button>
            </div>
        
        </form>
        </div>";
        
        $content1 = "
        <form method=\"POST\">
            <div>
                <label>Название заведения</label>
                <input type=\"text\" name=\"Nazvanie\">
            </div>
            <div>
                <label>Улица</label>
                <input type=\"text\" class=\"search\" name=\"search\">
            </div>
            <div>
                <label>Район</label>
                <input type=\"text\" name=\"Rayon\">
            </div>
            <div>
                <button type=\"submit\ \">Поиск</button>
            </div>
        </form>";

        
        
        
        require("rendering.php");
       




      
        if ( $_POST['Nazvanie'] <> NULL && $_POST ['Rayon'] <> NULL && $_POST['search'] ){
            $search = $_POST['search'];
            $products = mysqli_query($mysql, "SELECT * FROM Cafes as c WHERE c.District = \"".$_POST['Rayon']."\" and c.Name = \"".$_POST['Nazvanie']."\" and c.Address LIKE '%$search%'");    
        }else 
        if ( $_POST['Nazvanie'] == NULL && $_POST['search'] == NULL ){
            $products = mysqli_query($mysql, "SELECT * FROM Cafes as c WHERE c.District  = \"".$_POST['Rayon']."\" ");
        }else if($_POST['Rayon'] == NULL && $_POST['search'] == NULL ){
            $products = mysqli_query($mysql, "SELECT * FROM Cafes as c WHERE c.Name = \"".$_POST['Nazvanie']."\" ");
        }else if($_POST['Nazvanie'] == NULL && $_POST['Rayon'] == NULL){
            $search = $_POST['search'];
            $products = mysqli_query($mysql, "SELECT * FROM Cafes as c WHERE c.Address LIKE '%$search%' ");        
        }else if($_POST['Nazvanie'] == NULL){
            $search = $_POST['search'];
            $products = mysqli_query($mysql, "SELECT * FROM Cafes as c WHERE c.District  = \"".$_POST['Rayon']."\" and c.Address LIKE '%$search%' ");
        }else if ($_POST['Rayon'] == NULL){
            $search = $_POST['search'];
            $products = mysqli_query($mysql, "SELECT * FROM Cafes as c WHERE c.Name  = \"".$_POST['Nazvanie']."\" and c.Address LIKE '%$search%' ");
        }else if($_POST['search'] == NULL){
            $products = mysqli_query($mysql, "SELECT * FROM Cafes as c WHERE c.Name  = \"".$_POST['Nazvanie']."\" and c.District  = \"".$_POST['Rayon']."\"  "); 
        }
        
        
        
            $products = mysqli_fetch_all($products);
            foreach ($products as $product) {
                ?>
                
                    <tr>
                        <td><?= $product[1] ?></td>
                        <td><?= $product[9] ?></td>
                        <td><?= $product[10] ?></td>
                        <td><?= $product[8] ?></td>
                        <td><?= $product[7] ?></td>
                    </tr>
                <?php

            }
        ?>
    </table>
   
</body>
</html>







