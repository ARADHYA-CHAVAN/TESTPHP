

<?php 
include 'db.php';
if (!isset($_SESSION['id'])) {
    header("Location:login.php");
    exit;
}

$id = isset($_GET["id"]) ? (int)$_GET["id"] : null;
$user1 = [];

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM blogs WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $user1 = $stmt->get_result()->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $user_id = $_SESSION["id"];
    $image_name = $user1['image'];

    
    if (!empty($_FILES["image"]["name"])) {
        $target = "uploads/" . $_FILES["image"]["name"];
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target)) {
            $image_name = $target;
        }
    }
    
    elseif (!empty($_POST["image_url"])) {
        $image_name = $_POST["image_url"];
    }

    $sql = $conn->prepare("UPDATE blogs SET title=?, content=?, image=? WHERE id=? AND user_id=?");
    $sql->bind_param("sssii", $title, $content, $image_name, $id, $user_id);
    $sql->execute();

    header("Location:dashboard.php");
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Edit Blog</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-warning">
<div class="container my-5">
    
<div class="container my-5 d-flex justify-content-center">
  <div class="bg-white rounded p-4 shadow" style="max-width: 600px; width: 100%;">
    <form method="POST" enctype="multipart/form-data">
      <h2 class="mb-4 text-center">Edit Blog</h2>
      
      <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" required value="<?= $user1['title'] ?? '' ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">Content</label>
        <textarea name="content" class="form-control" rows="5" required><?= $user1['content'] ?? '' ?></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Upload Image</label>
        <input type="file" name="image" class="form-control">
      </div>

      <div class="mb-3">
        <label class="form-label">Or Image URL</label>
        <input type="url" name="image_url" class="form-control" placeholder="https://example.com/image.jpg">
      </div>

      <button type="submit" class="btn btn-outline-primary">Update</button>
      <a href="dashboard.php" class="btn btn-outline-secondary ms-2">Cancel</a>
    </form>
  </div>
</div>


            

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
