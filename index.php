<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CC105 Activity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body class="p-4">
    <?php
        $server = "localhost";
        $username = "root";
        $password = "";
        $exist = false;
       
    ?>

    <?php 
        if(isset($_POST['submit'])){
            
            $dbname = $_POST['dbname'];

            try {

                $conn = mysqli_connect($server, $username, $password);

                // $query = "
                //     CREATE DATABASE IF NOT EXISTS ". $dbname .";
                //     CREATE TABLE IF NOT EXISTS " . $dbname . ".subjects(_sched_id int(11) NOT NULL PRIMARY KEY, _subject_code varchar(255), _subject_description varchar(255));
                //     INSERT INTO ". $dbname .".subjects(_sched_id, _subject_code, _subject_description) VALUES (1, 'CC105', 'INFORMATION MANAGEMENT') ON DUPLICATE KEY UPDATE _subject_code = 'CC105';
                //     INSERT INTO ". $dbname .".subjects(_sched_id, _subject_code, _subject_description) VALUES (2, 'IS ELECT 4', 'BUSINESS INTELLIGENCE') ON DUPLICATE KEY UPDATE _subject_code = 'IS ELEC 4';
                // ";

                $query = "
                    CREATE DATABASE ". $dbname .";
                    CREATE TABLE " . $dbname . ".subjects(_sched_id int(11) NOT NULL PRIMARY KEY, _subject_code varchar(255), _subject_description varchar(255));
                    INSERT INTO ". $dbname .".subjects(_sched_id, _subject_code, _subject_description) VALUES (1, 'CC105', 'INFORMATION MANAGEMENT');
                    INSERT INTO ". $dbname .".subjects(_sched_id, _subject_code, _subject_description) VALUES (2, 'IS ELECT 4', 'BUSINESS INTELLIGENCE');
                ";


                //echo $query;

                $result = mysqli_multi_query($conn, $query);

                while (mysqli_more_results($conn) && mysqli_next_result($conn)) {}

                if ($result) {
                    echo '
                    <div class="alert alert-success">
                        <strong>Success: </strong> Database has been created</a>.
                    </div>';


                } else {
                    echo "Error creating database: " . mysqli_error($conn);
                }

                $conn->close();

            }catch(Exception $e) {
    
                echo '
                <div class="alert alert-danger">
                    <strong>Error: </strong> '. $e .' </a>.
                </div>';
                $exist = true;
            }

        }
    ?>


    <div class="container-fluid">
       <div class="card my-3">
        <div class="card-body">
             <form action="index.php" method="post">
                <div class="mb-3">
                    <label class="form-label">Database Name</label>
                    <input type="text" class="form-control" name="dbname" value="<?php echo (isset($_POST['dbname']) ? $_POST['dbname'] : "" ) ?>" placeholder="Enter your database name">
                </div>

                <button type="submit" name="submit" class="btn btn-dark">Create</button>
            </form>
        </div>
       </div>
    </div>    


    <?php 

    if(!$exist) {

    

         try {

            $conn = mysqli_connect($server, $username, $password);

            $select = "SELECT * FROM ". $dbname .".subjects";
            $result_select = mysqli_query($conn, $select);

            echo '
                <div class="fs-6 mb-2">Selected Database: <span class="fw-bold fs-6"> '. $dbname .'</span></div>
                <div class="card px-2 py-3"><table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Subject Code</th>
                            <th scope="col">Subject Description</th>
                        </tr>
                    </thead>
                    <tbody>
                ';

            if(mysqli_num_rows($result_select) > 0) {
                while($row = mysqli_fetch_assoc($result_select)) {
                    echo '
                        <tr>
                            <td>'. $row['_subject_code'] .'</td>
                            <td>'. $row['_subject_description'] .'</td>
                        </tr>';
                }

            }

            echo '
            </tbody>
            </table></div>';

        }catch(Exception $e) {
            
        }

    }
        
    ?>
   
</body>
</html>