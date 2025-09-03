<?php
include "db.php";
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $name=$_POST['name'];
      $pass=$_POST['pass'];

      $sql= $conn->prepare("SELECT  id, password  from user1  where name=?;");
$sql->bind_param("s",$name);
$sql->execute();
$sql->store_result();
$sql->bind_result($id,$password);
if($sql->fetch() && password_verify($pass,$password)){
    $_SESSION["name"]=$name;
    $_SESSION["id"]=$id;
    header("Location:dashboard.php");
}else{
    echo"<script>alert('Invalid username or password');</script>";
}

}

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body class="bg-warning">
        <header>
            
        </header>
        <main>
<form action="" method="post" class="container">
  <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
                <div class="card shadow-lg p-4" style="width: 100%; max-width: 600px;">
                    <h3 class="card-title text-center mb-4">Login </h3>

                   

                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input
                                type="text"
                                class="form-control"
                                name="name"
                                id="name"
                                placeholder="Enter your name"
                                required
                            />
                        </div>

                        <div class="mb-3">
                            <label for="pass" class="form-label">Password</label>
                            <input
                                type="password"
                                class="form-control"
                                name="pass"
                                id="pass"
                                placeholder="Enter password"
                                required
                            />
                        </div>

                        <button class="btn btn-outline-primary w-100" type="submit">Login</button>
                    </form>
                </div>
            </div>





        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
