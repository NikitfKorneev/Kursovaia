
<?php

/*
 * Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL)
 */

include "db.php";

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
</head>
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
        </tr>
        <p><a href="auto.php">К входу</a></p>
        <?php
        
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

        
        require("visual.php");
       




      
        if ( $_POST['Nazvanie'] <> NULL && $_POST ['Rayon'] <> NULL && $_POST['search'] ){
            $search = $_POST['search'];
            $products = mysqli_query($mysql, "SELECT * FROM Cafes as c WHERE c.District = \"".$_POST['Rayon']."\" and c.Name = \"".$_POST['Nazvanie']."\" and c.Address LIKE '%$search%'");    
        }else 
        if ( $_POST['Nazvanie'] == NULL){
        $products = mysqli_query($mysql, "SELECT * FROM Cafes as c WHERE c.Address  = \"".$_POST['Rayon']."\" ");
        }else{
        $products = mysqli_query($mysql, "SELECT * FROM Cafes as c WHERE c.Name = \"".$_POST['Nazvanie']."\" ");
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







