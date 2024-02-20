<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CC105 Procedure</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body class="p-4">
    <?php
    $server = "localhost";
    $username = "root";
    $password = "";

    $database_name = "dbtesting";

    try {

        $conn = mysqli_connect($server, $username, $password);

        $sql = "
            CREATE DATABASE IF NOT EXISTS $database_name;
        ";

        $result = mysqli_query($conn, $sql);


        if ($result) {
            echo 'Database has been created </br>';
        }

        $sql = "
            CREATE PROCEDURE IF NOT EXISTS $database_name.createProductTable()
            BEGIN
                DROP TABLE IF EXISTS products;

                CREATE TABLE IF NOT EXISTS $database_name.products(
                    product_id int(11) PRIMARY KEY AUTO_INCREMENT,
                    name varchar(255) NOT NULL,
                    category varchar(255) NOT NULL,
                    brand varchar(255) NOT NULL,
                    price decimal(10, 2),
                    stock int(11)
                 );

                 INSERT INTO $database_name.products (product_id, name, category, brand, price, stock) 
                    VALUES
                    (1, 'Gatas', 'Dairy', 'Brand A', 50.00, 100),
                    (2, 'Itlog', 'Dairy', 'Brand B', 39.75, 150),
                    (3, 'Tinapay', 'Bakery', 'Brand C', 45.50, 200),
                    (4, 'Mansanas', 'Produce', 'Brand D', 30.00, 300),
                    (5, 'Saging', 'Produce', 'Brand E', 24.75, 250),
                    (6, 'Chicken Breast', 'Karne', 'Brand F', 149.75, 100),
                    (7, 'Giniling na Baka', 'Karne', 'Brand G', 112.25, 150),
                    (8, 'Pasta', 'Pantry', 'Brand H', 87.50, 200),
                    (9, 'Bigas', 'Pantry', 'Brand I', 179.75, 250),
                    (10, 'Cereal', 'Breakfast', 'Brand J', 209.25, 150),
                    (11, 'Orange Juice', 'Inumin', 'Brand K', 179.75, 100),
                    (12, 'Soda', 'Inumin', 'Brand L', 75.00, 200),
                    (13, 'Yogurt', 'Dairy', 'Brand M', 285.00, 150),
                    (14, 'Cheese', 'Dairy', 'Brand N', 98.50, 100),
                    (15, 'Tomatoes', 'Produce', 'Brand O', 152.25, 200),
                    (16, 'Potatoes', 'Produce', 'Brand P', 432.00, 300),
                    (17, 'Salmon', 'Seafood', 'Brand Q', 75.00, 100),
                    (18, 'Shrimp', 'Seafood', 'Brand R', 97.75, 80),
                    (19, 'Peanut Butter', 'Pantry', 'Brand S', 176.25, 120),
                    (20, 'Jelly', 'Pantry', 'Brand T', 213.75, 150),
                    (21, 'Cookies', 'Snacks', 'Brand U', 125.00, 200),
                    (22, 'Chips', 'Snacks', 'Brand V', 82.75, 250),
                    (23, 'Ice Cream', 'Frozen', 'Brand W', 329.25, 100),
                    (24, 'Frozen Pizza', 'Frozen', 'Brand X', 204.50, 120),
                    (25, 'Frozen Vegetables', 'Frozen', 'Brand Y', 187.25, 150);
                    END;
                ";

        if (mysqli_query($conn, $sql) == TRUE) {
            echo 'Procedure has been created </br>';
        }

        $sql = "CALL $database_name.createProductTable";

        if (mysqli_query($conn, $sql) == TRUE) {
            echo 'Procedure has been excecuted </br>';
        }
    } catch (Exception $e) {
        echo 'Failed to execute query: ' . $e . '</br>';
    }

    ?>

</body>

</html>