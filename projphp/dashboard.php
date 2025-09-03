<?php
include"db.php";

if(!isset($_SESSION['id'])){
    header("Location:login.php");
}

$result=$conn->query("SELECT blogs.*,user1.name from blogs join user1 on blogs.user_id=user1.id");

?>

<!doctype html>
<html lang="en">
    <head>
        <title>dashboard</title>
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

    <body class=" bg-warning">


       <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">Dashboard</span>
        <div>
            <span class="text-light me-3">Welcome, <?= $_SESSION['name'] ?></span>
            <a href="addblog.php" class="btn btn-success btn-sm me-2">Add Blog</a>
            <a href="logout.php" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to logout?');">Logout</a>
        </div>
    </div>
</nav>
        <main>
<div class="text-center ">


<div class="container mt-4  ">
    <div class="row flex-nowrap overflow-auto ">
        <?php while($row = $result->fetch_assoc()) { ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3 me-3">
                <div class="card h-100 rounded-4 " style="min-width: 250px;">
                    <?php if (!empty($row['image'])): ?>
                        <img class="card-img-top" src="<?= $row['image'] ?>" alt="Card image cap"
                        style="height: 200px; object-fit: cover; width: 100%;">
                    <?php endif; ?>
                   <div class="card-body bg-light d-flex flex-column justify-content-between rounded-4" >
    <div>
        <small>By <?= $row['name'] ?> | <?= $row['created_at'] ?></small>
        <h4 class="card-title"><?= $row['title'] ?></h4>
        <p class="card-text"><?= $row['content'] ?></p>
    </div>

    <?php if ($_SESSION['id'] == $row["user_id"]) { ?>
        <div class="mt-3 ">
            <a href="editblog.php?id=<?= $row['id'] ?>" class="btn btn-outline-info btn-sm">Edit</a>
            <a href="delete.php?id=<?= $row['id'] ?>" 
   class="btn btn-outline-danger btn-sm" 
   onclick="return confirm('Are you sure you want to delete this blog?');">
   Delete
</a>

        </div>
    <?php } ?>
</div>

                </div>
            </div>
        <?php } ?>
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

