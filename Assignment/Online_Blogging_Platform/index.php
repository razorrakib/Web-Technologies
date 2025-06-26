<?php

?>
<!DOCTYPE html>
<html>

<head>
    <title>Blog Platform</title>
    <style>
        body {
            font-family: Georgia, serif;
            padding: 40px;
            background-color: #f5f5f5;
            text-align: center;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 30px;
        }

        form {
            margin: 10px 0;
        }

        button {
            padding: 10px 30px;
            font-size: 16px;
            background-color: white;
            border: 1px solid black;
            cursor: pointer;
            transition: 0.3s ease;
        }

        button:hover {
            background-color: #eee;
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
            width: 200px;
            padding: 12px 0;
            font-size: 16px;
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
    <h1>ONLINE BLOOGING PLATFORM</h1>
    <h2>Hi! What would you like to do?</h2>

    <form action="login.php">
        <button name="login">Login</button>
    </form>

    <form action="signup.php">
        <button name="signup">Sign Up</button>
    </form>

    <form action="adminlogin.php">
        <button name="adminlogin">Admin Login</button>
    </form>

    <form action="editorlogin.php">
        <button name="editorlogin">Editor Login</button>
    </form>
</body>

</html>