<?php
    require_once "config.php";

    session_start();

    if(isset($_SESSION["username"])){

        header("location:home.php");

    }

    if(isset($_POST["login"])){ //comprueba si post tiene valor
        
        $username = mysqli_real_escape_string($connection, $_POST["username"]);
        $password = mysqli_real_escape_string($connection, $_POST["password"]);
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result); 

            if(password_verify($password, $row["password"])){
                $_SESSION['username'] = $username;
                header("location:home.php");
            } else {
                echo '<script> alert("EPP. Wrong User Details!") </script>';
            }
        
        } else {
            echo '<script> alert("Wrong User Details!") </script>';
        }
    }

    if (isset($_POST["register"])) {
        if (empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["repeat_password"])){
            echo '<script>alert("All fields are mandatory!")</script>';
        

        /*else if($_POST["password"] != $_POST("repeat_password")){
            echo '<script>alert("Password dont match")</script>';
        }*/
        
        }else {

            $username = mysqli_real_escape_string($connection, $_POST["username"]);
            $password = mysqli_real_escape_string($connection, $_POST["password"]);
            
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users(username, password) VALUES('$username', '$password')";
               
            if(mysqli_query($connection, $query)) {
                echo '<script>alert("Registration Done")</script>';
                //header("location:index.php");
            }
        } 
    }

?>

<!DOCTYPE html>  
<html>  
      <head>  
           <title>Introduction to PHP</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>
        <div class="container align-middle">

            <?php
                if (isset($_GET['action']) == "register"){
            ?>

            <form method="post">
                <h3 class="text-center mt-4 mb-4 fw-bold fs-1 font-monospace display-1 border-dark bg-dark text-light">Register</h3>
                <div class="bg-warning p-5">
                <!-- Username input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="username" name="username" class="form-control fs-4" />
                    <label class="form-label fs-4" for="username">Username</label>
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control fs-4" />
                    <label class="form-label fs-4" for="password">Password</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="repeat_password" name="repeat_password" class="form-control fs-4" />
                    <label class="form-label fs-4" for="repeat_password">Repeat Password</label>
                </div>


                <!-- Submit button -->
                <input  type="submit" class="btn btn-primary btn-block mb-4" value="register" name="register" style="font-size: 15px;"/>

                <!-- Register buttons -->
                <div class="text-center h3">
                    <p>Already a member? <a href="index.php">Login</a></p>        
                </div>
                </div>
            </form>

            <?php
                }
                    else
                {
            ?>
            <form method="post">
                <h3 class="text-center mt-4 mb-4 fw-bold fs-1 font-monospace display-1 border-dark bg-dark text-light">Login</h3>
                <!-- Username input -->
                
                <div class="bg-warning p-5">
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="username" name="username" class="form-control fs-4" />
                    <label class="form-label fs-4" for="username">Username</label>
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control fs-4" />
                    <label class="form-label fs-4" for="password">Password</label>
                </div>

                <!-- Submit button -->
                <input  type="submit" class="btn btn-primary btn-block mb-4" value="Login" name="login" style="font-size: 15px;"/>

                <!-- Register buttons -->
                <div class="text-center h3">
                    <p>Not a member? <a href="index.php?action=register">Register</a></p>        
                </div>
                </div> 
            </form>
            <?php
                }
            ?>
        </div>  
    </body>  
</html> 