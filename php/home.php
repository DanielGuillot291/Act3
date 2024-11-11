<?php
    require_once "config.php"; 

    session_start();

    if(!isset($_SESSION["username"])){

        header("location:index.php");

    }
?>

<!DOCTYPE html>  
<html>  
      <head>  
           <title>Introduction to PHP</title>  
           <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>
        <div class="container align-middle">
            <div class="row mt-4 fw-bold fs-1 font-monospace display-1 border-dark"><mark>Welcome to my app</mark></div>

            <div class="row bg-dark ounded-3 p-3 mb-4 mt-4">
                <?php
                    $query = "SELECT * FROM users";
                    $result = mysqli_query($connection, $query);

                    if (mysqli_num_rows($result) > 0){
                        while ($row = mysqli_fetch_assoc($result)){
                        echo '
                            <div class="col-md-4 my-3">
                                <div class="card text-dark bg-light border-success border-2 mb-3" style="max-width: 20rem;">
                                    <div class="card-header">ID: '.$row["id"].'</div>
                                    <div class="card-body">
                                        <h5 class="card-title">'.$row["username"].'</h5>
                                        <h6 class="card-subtitle">'.$row["username"].' es nuestro usuario con ID '.$row["id"].'</h6>
                                    </div>
                                </div>
                            </div>
                        ';
                    }}
                ?>
            </div>

            <a class="row" href="logout.php">Logout</a>
        </div>  
    </body>  
</html> 