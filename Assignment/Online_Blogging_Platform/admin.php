<?php
session_start();
if (!isset($_SESSION['adminname'])) {
    echo "Please Login First";
    header("refresh: 3; url = adminlogin.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "db_blog");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

$grab = [];
$table = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['users'])) {
        $table = 'USERS';
        $result = $conn->query("SELECT * FROM USERS");
        if ($result) $grab = $result->fetch_all(MYSQLI_ASSOC);
    } elseif (isset($_POST['posts'])) {
        $table = 'POSTS';
        $result = $conn->query("SELECT * FROM POSTS");
        if ($result) $grab = $result->fetch_all(MYSQLI_ASSOC);
    } elseif (isset($_POST['editors'])) {
        $table = 'EDITOR';
        $result = $conn->query("SELECT * FROM EDITOR");
        if ($result) $grab = $result->fetch_all(MYSQLI_ASSOC);
    }
}

if (isset($_POST['crud'])) {
    $rawQuery = trim($_POST['crud']);

    if (stripos($rawQuery, 'select') === 0) {
        $result = $conn->query($rawQuery);
        if ($result) {
            $grab = $result->fetch_all(MYSQLI_ASSOC);
            $message = "Query executed successfully.";
        } else {
            $error = "Query failed: " . $conn->error;
        }
    } else {
        if ($conn->query($rawQuery)) {
            $affected = $conn->affected_rows;
            $message = "Query executed successfully. Rows affected: $affected";
        } else {
            $error = "Query failed: " . $conn->error;
        }
    }
}



?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Georgia, serif;
            padding: 40px;
            background-color: #f5f5f5;
        }

        h1 {
            font-size: 36px;
        }

        .top-right {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        button {
            padding: 8px 20px;
            margin: 5px;
            font-size: 14px;
            background-color: white;
            border: 1px solid black;
            cursor: pointer;
        }

        form {
            margin-bottom: 20px;
        }

        .data-section,
        .crud-form {
            background-color: white;
            padding: 20px;
            border: 1px solid #ccc;
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #bbb;
            text-align: left;
        }

        th {
            background-color: #eee;
        }

        .form-control {
            width: 800px;
            padding: 10px;
            margin: 10px 0;
            font-size: 14px;
            border: 1px solid #999;
            background-color: #f3f3f3;
        }

        .alert {
            padding: 10px;
            margin-top: 15px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .btn-group {
            display: flex;
            flex-wrap: wrap;
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

    <form method="post" class="top-right">
        <button type="submit" name="logout">Logout</button>
    </form>

    <?php echo "<h1>Welcome to Admin Dashboard " . $_SESSION["adminname"] . "</h1>"; ?>

    <div class="btn-group">
        <form method="post">
            <button type="submit" name="users">Users</button>
            <button type="submit" name="posts">Posts</button>
            <button type="submit" name="editors">Editors</button>
        </form>
    </div>

    <div class="data-section">
        <h2><?php echo $table ? $table . ' Data' : 'Select a table to view data'; ?></h2>

        <?php if (!empty($error)): ?>
            <div class="alert"><?php echo $error; ?></div>
        <?php elseif (isset($message)): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>

        <?php if (!empty($grab)): ?>
            <table>
                <thead>
                    <tr>
                        <?php foreach (array_keys($grab[0]) as $column): ?>
                            <th><?php echo htmlspecialchars($column); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($grab as $row): ?>
                        <tr>
                            <?php foreach ($row as $value): ?>
                                <td><?php echo htmlspecialchars($value); ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
            <p>No data found in this table.</p>
        <?php else: ?>
            <p>Please select a table to view data.</p>
        <?php endif; ?>
    </div>

    <div class="crud-form">
        <h2>CRUD Operations</h2>
        <form method="post">
            <label for="crud">Enter Operation:</label><br>
            <input type="text" name="crud" id="crud" class="form-control"
                placeholder="Enter full SQL query" style="width: 800px;" required>


            <button type="submit" name="execute">Execute</button>
        </form>
    </div>

</body>

</html>