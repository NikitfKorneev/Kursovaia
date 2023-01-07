
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

            /*
             * Делаем выборку всех строк из таблицы "products"
             */

            $products = mysqli_query($mysql, "SELECT * FROM Cafes as c WHERE c.Name = 'cofix'");

            /*
             * Преобразовываем полученные данные в нормальный массив
             */

            $products = mysqli_fetch_all($products);

            /*
             * Перебираем массив и рендерим HTML с данными из массива
             * Ключ 0 - id
             * Ключ 1 - title
             * Ключ 2 - price
             * Ключ 3 - description
             */

            foreach ($products as $product) {
                ?>
                
                    <tr>
                        <td><?= $product[1] ?></td>
                        <td><?= $product[9] ?></td>
                        <td><?= $product[10] ?></td>
                        <td><?= $product[8] ?></td>
                    </tr>
                <?php
            }
        ?>
    </table>
   
</body>
</html>







