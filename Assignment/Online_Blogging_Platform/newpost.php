<?php
session_start();

if (!isset($_SESSION['fullname'])) {
    echo "Please Login First";
    header("refresh: 3; url = login.php");
    exit();
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    echo "Logging out ... ";
    header("refresh: 3; url=index.php");
    exit();
}


if (isset($_POST['submit'])) {


    $username =  $_SESSION['fullname'];
    $currdate = date("Y-m-d");
    $title =  $_POST['title'];
    $body = $_POST['body'];

    $con = mysqli_connect("localhost", "root", "", "db_blog");


    $sql = "INSERT INTO POSTS (FULLNAME, DATEOFPOST ,TITLE, POSTBODY) 
            VALUES ('$username', '$currdate', '$title', '$body');";

    if (mysqli_query($con, $sql)) {
        echo "The Blog is Successfully Posted";

        header("refresh: 2; url = home.php");
        exit();
    } else {
        echo "Error while Posting : " . mysqli_error($con);
        header("refresh: 3; url = newpost.php");
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Create New Blog</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
        }

        h1 {
            font-size: 36px;
        }

        form {
            margin-top: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 20px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 15px;
            margin-top: 5px;
            font-size: 16px;
            border: 1px solid #999;
            background-color: #f3f3f3;
            color: #333;
        }

        input::placeholder,
        textarea::placeholder {
            color: #aaa;
            font-weight: bold;
        }

        .button-row {
            margin-top: 20px;
        }

        button {
            padding: 8px 20px;
            margin-right: 10px;
            font-size: 14px;
            background-color: white;
            border: 1px solid black;
            cursor: pointer;
        }

        .top-right {
            position: absolute;
            top: 20px;
            right: 20px;
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
        <button type="submit" name="logout" value="logout">Logout</button>
    </form>

    <h1>Create New Blog</h1>

    <form method="POST" onsubmit="return validate();">
        <label for="title">Blog Title</label>
        <input type="text" name="title" id="title" placeholder="Write Your Title Here">

        <label for="body">Description</label>
        <textarea name="body" rows="10" id="body" placeholder="Write Your Blog Here"></textarea>

        <div class="button-row">
            <button type="submit" name="submit">Submit</button>
            <button type="button" onclick="window.location.href='home.php';">Back</button>
        </div>
    </form>

    <script>
        function validate() {
            const title = document.getElementById("title").value;
            const body = document.getElementById("body").value;

            if (!title || !body) {
                alert("Your Blog title or body is empty!");
                return false;
            } else if (title.length > 255) {
                alert("Your Blog title has a character limit of 255");
                return false;
            } else if (body.length > 1000) {
                alert("Your Blog has a character limit of 1000");
                return false;
            }

            return true;
        }
    </script>

</body>

</html>