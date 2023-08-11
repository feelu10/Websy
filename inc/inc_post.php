<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e6ecf0;
        }

        form {
            width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
        }

        form input[type="file"] {
            margin-bottom: 10px;
        }

        form button {
            margin-left: auto;
        }

        textarea {
            width: 96%;
            height: 100px;
            border-radius: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            resize: none;
            margin-bottom: 10px;
            font-size: 1em;
        }

        button {
            padding: 10px 15px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 15px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        div.post {
            width: 600px;
            margin: 20px auto;
            background-color: wheat;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        div.post h2 {
            font-size: 1.2em;
            color: #050505
        }

        #h2{
        }

        div.post p {
            color: #65676b;
            line-height: 1.5;
            border:1px solid black;
            border-radius: 8px;
            background-color: whitesmoke;
            padding: 1.2rem;
        }

        div.post img {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 15px;
            margin-top: 10px;
        }
        form.delete-form {
            position: absolute;
            top: 1px;
            right: 25px;
            width: 20px;
            background-color: transparent;
        }

        form.delete-form button {
            background-color: transparent;
            color: #000;
        }

        .dynamic_content{
            background-color: #767976; 
        }
    </style>
</head>
<body>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start or resume the session
}
unset($_SESSION['message']);
unset($_SESSION['message_type']);
// Database credentials
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "websy";

try {
    // Create PDO instance
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_username, $db_password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle create post
    if (isset($_POST['content'])) {
        $content = $_POST['content'];
        $user_id = $_SESSION['user_id'];
        $image = null;

        if (isset($_FILES['image']['error']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $target_dir = "assets/postuploads/";
            $image = $target_dir . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $image);
        }

        $stmt = $pdo->prepare("INSERT INTO posts (user_id, content, image) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $content, $image]);

        // set a session variable for the success message
        $_SESSION['message'] = "Post created successfully!";
        $_SESSION['message_type'] = "success";
    }
    // Handle delete post
    if (isset($_POST['delete'], $_POST['post_id'])) {
        $post_id = $_POST['post_id'];
        $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ? AND user_id = ?");
        $stmt->execute([$post_id, $_SESSION['user_id']]);

        // set a session variable for the success message
        $_SESSION['message'] = "Post deleted successfully!";
        $_SESSION['message_type'] = "success";
    }


}


// Fetch all posts
$stmt = $pdo->query("SELECT posts.*, users.username, users.first_name, users.last_name FROM posts JOIN users ON posts.user_id = users.id ORDER BY created_at DESC");
$posts = $stmt->fetchAll();
?>
<!-- Create a new post -->
<form method="POST" enctype="multipart/form-data">
        <label for="content" style="color:black">User Template</label><br>
        <textarea id="content" name="content" placeholder="What's on your mind?"></textarea><br>
        <div>
            <input type="file" name="image">
            <button type="submit">Create post</button>
        </div>
    </form>

    <!-- List of all posts -->
    <?php foreach ($posts as $post): ?>
    <div class="post">
        <div style="display: flex; justify-content: space-between; align-items: start;">
            <div style="margin:0 auto;">
                <h2>
                    <?php 
                        $name = !empty($post['first_name']) || !empty($post['last_name']) 
                            ? trim($post['first_name'].' '.$post['last_name']) 
                            : $post['username'];
                        echo htmlspecialchars($name); 
                    ?>
                </h2>
            </div>
            <?php if ($post['user_id'] == $_SESSION['user_id']): ?>
            <!-- Delete post -->
            <form method="POST" class="delete-form">
                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                <button type="submit" name="delete" submit();>
                <i class="fas fa-trash"></i>
            </button>
            </form>
            <?php endif; ?>
        </div>
        <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
        <?php if ($post['image']): ?>
        <img src="<?php echo $post['image']; ?>" alt="Post image">
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
    <!-- Show SweetAlert if there's a message in the session -->
    <?php if (isset($_SESSION['message'])): ?>
        <script>
            Swal.fire({
                icon: '<?php echo $_SESSION['message_type'] === 'success' ? 'success' : 'error'; ?>',
                title: '<?php echo $_SESSION['message']; ?>',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
        <?php 
        // Unset message after showing it
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
        ?>
    <?php endif; ?>
    <script>
        function submit(){
            Swal.fire({
                title: "Are you sure?",
                text: "You will not be able to recover this post!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("delete-form").submit();
                }
            });
        }
        </script>
</body>
</html>