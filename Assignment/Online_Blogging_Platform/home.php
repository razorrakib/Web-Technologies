<?php
session_start();

if (!isset($_SESSION['fullname'])) {
    echo "Please Login First";
    header("refresh: 3; url = login.php");
    exit();
}
$conn = new mysqli("localhost", "root", "", "db_blog");
$sql = "SELECT * FROM POSTS ORDER BY ID DESC";
$result = $conn->query($sql);
$posts = $result->fetch_all(MYSQLI_ASSOC);


if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    echo "Logging out...";
    header("refresh: 3; url = index.php");
    exit();
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .button-group {
            display: flex;
            gap: 10px;
        }

        button {
            padding: 8px 16px;
            cursor: pointer;
        }

        h2 {
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        .post-row {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .post-row:nth-child(even) {
            background-color: #f9f9f9;
        }

        .post-row:nth-child(odd) {
            background-color: #ffffff;
        }

        .post-title {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .post-meta {
            font-weight: bold;
            color: #555;
            margin-bottom: 10px;
        }

        .post-content {
            margin-top: 10px;
        }

        body {
            background-color: #ffffff;
            font-family: Arial, sans-serif;
            color: #333;
        }

        h1,
        h2,
        h3,
        h4 {
            color: #ff7f00;
            font-family: Arial, sans-serif;
        }

        button {
            background-color: #ff7f00;
            color: #ffffff;
            border: 1px solid #ff7f00;
            cursor: pointer;
            transition: 0.3s ease;
        }

        button:hover {
            background-color: #e06600;
        }

        input,
        textarea,
        select {
            border: 1px solid #ff7f00;
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            background-color: #ff7f00;
            color: #ffffff;
        }

        a {
            color: #ff7f00;
        }

        .top-right button {
            background-color: #ff7f00;
            color: #ffffff;
            border: none;
        }
    </style>
</head>

<body>
    <div class="header-section">
        <h1>Welcome <?php echo htmlspecialchars($_SESSION['fullname']); ?></h1>
        <div class="button-group">
            <form action="newpost.php">
                <button>Create New Post</button>
            </form>
            <form method="post">
                <button type="submit" name="logout" value="logout">Logout</button>
            </form>
        </div>
    </div>

    <hr>

    <h2>Blogs</h2>

    <div class="posts-container">
        <?php foreach ($posts as $post): ?>
            <div class="post-row">
                <div class="post-title"><?php echo htmlspecialchars($post['TITLE']); ?></div>
                <div class="post-meta">
                    Author: <?php echo htmlspecialchars($post['FULLNAME']); ?> |
                    Date: <?php echo htmlspecialchars($post['DATEOFPOST']); ?>
                </div>
                <div class="post-content"><?php echo htmlspecialchars($post['POSTBODY']); ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>