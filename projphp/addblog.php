<?php
include "db.php";


if(!isset($_SESSION['name'])){
    header("Location:login.php");
}


if($_SERVER["REQUEST_METHOD"]==="POST"){
    $title=$_POST['title'];
    $content=$_POST['content'];
$user_id=$_SESSION['id'];
       $img_name="";


    if(!empty($_FILES["img"]['name'])){
        $img_name="uploads/" .$_FILES["img"]['name'];
        move_uploaded_file($_FILES["img"]['tmp_name'],$img_name);
    }
    elseif($_POST['url']){
        $img_name=$_POST['url'];
    }
$sql=$conn->prepare("insert into blogs (title,content,user_id,image)values(?,?,?,?)");
$sql->bind_param("ssis",$title,$content,$user_id,$img_name);
$sql->execute();
header("Location:dashboard.php");
    
}
?>
<!doctype html>
<html lang="en">
    <head>
        <title>add</title>
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
     <h1 class="text-center "> ADD</h1>
        </header>
        <main>

<form action="" method="post" class="container" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="" class="form-label">title</label>
        <input
            type="text"
            class="form-control"
            name="title"
            id=""
            aria-describedby="helpId"
            placeholder=""
        />
        
    </div>
    <div class="mb-3">
        <label for="" class="form-label">content</label>
        <textarea class="form-control" name="content" id="" rows="3"></textarea>
    </div>
    
    <div class="mb-3">
        <label for="" class="form-label">Choose file</label>
        <input
            type="file"
            class="form-control"
            name="img"
            id=""
            placeholder=""
            aria-describedby="fileHelpId"
        /> 
    </div>
    
    <div class="mb-3">
        <label for="" class="form-label">url</label>
        <input
            type="text"
            class="form-control"
            name="url"
            id=""
            aria-describedby="helpId"
            placeholder=""
        />
        
    </div>

    <button
        type="submit"
        class="btn btn-primary"
    >
        Submit
    </button>
    
</form>

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


