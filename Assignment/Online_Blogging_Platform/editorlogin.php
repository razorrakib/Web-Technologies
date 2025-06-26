<?php
if (isset($_POST["submit"])) {
    $editoremail = $_POST["editor_email"];
    $editorpass = $_POST["editor_password"];

    $conn = mysqli_connect('localhost', 'root', '', 'db_blog');
    $sql = "SELECT FULLNAME FROM EDITOR WHERE EMAIL = '$editoremail' and PASSWORD = '$editorpass'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        session_start();
        $_SESSION["editorname"] =  $row['FULLNAME'];

        echo "<p>Editor Login Successful. Now redirecting...</p>";
        header("refresh: 2; url = editor.php");
        exit();
    } else {
        echo "Editor not found";
        header("refresh: 3; url = editorlogin.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Editor Login</title>
    <style>
        body {
            font-family: Georgia, serif;
            padding: 40px;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: white;
            padding: 30px 40px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 25px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 12px 0;
            font-size: 16px;
            border: 1px solid #999;
            background-color: #f3f3f3;
            border-radius: 5px;
        }

        button {
            padding: 10px 25px;
            margin-top: 10px;
            font-size: 16px;
            background-color: white;
            border: 1px solid black;
            cursor: pointer;
            transition: 0.3s ease;
        }

        button:hover {
            background-color: #eee;
        }

        .back-form {
            margin-top: 15px;
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
    <div class="login-container">
        <h1>Editor Login Portal</h1>
        <form method="POST" onsubmit="return validate()">
            <input type="email" name="editor_email" id="editor_email" placeholder="Editor Email"><br>
            <input type="password" name="editor_password" id="editor_password" placeholder="Password"><br>
            <button type="submit" name="submit">Submit</button>
        </form>

        <form action="index.php" class="back-form">
            <button name="back">Back</button>
        </form>
    </div>

    <script>
        function validate() {
            const email = document.getElementById("editor_email").value.trim();
            const password = document.getElementById("editor_password").value;

            if (!email || !password) {
                alert("Please fill up your email and password");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>