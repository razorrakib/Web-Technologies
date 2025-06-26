<?php
session_start();

if (isset($_POST['submit'])) {
    $username =  $_POST['fullname'];
    $email =  $_POST['email'];
    $bdate =  $_POST['birthdate'];
    $password = $_POST['password'];

    $con = mysqli_connect("localhost", "root", "", "db_blog");

    $sql = "INSERT INTO USERS (FULLNAME, EMAIL, DATEOFBIRTH, PASSWORD) 
            VALUES ('$username', '$email', '$bdate', '$password');";

    if (mysqli_query($con, $sql)) {
        echo "Signup Successful. Redirecting to Login Page...";
        header("refresh: 3; url = login.php");
        exit();
    } else {
        echo "Error while Signup : " . mysqli_error($con);
        header("refresh: 3; url = signup.php");
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Sign Up</title>
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

        .signup-container {
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

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
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
    <div class="signup-container">
        <h1>SIGN UP</h1>
        <form method="POST" onsubmit="return validate();">
            <input type="text" name="fullname" id="fullname" placeholder="Full Name"><br>
            <input type="email" name="email" id="email" placeholder="Email"><br>
            <input type="date" name="birthdate" id="birthdate"><br>
            <input type="password" name="password" id="password" placeholder="Password"><br>
            <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password"><br>
            <button type="submit" name="submit">Submit</button>
        </form>

        <form action="index.php" class="back-form">
            <button name="back">Back</button>
        </form>
    </div>

    <script>
        function validate() {
            const fullname = document.getElementById("fullname").value.trim();
            const email = document.getElementById("email").value.trim();
            const birthdate = document.getElementById("birthdate").value;
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("cpassword").value;

            if (!fullname || !email || !birthdate || !password || !confirmPassword) {
                alert("All fields are required!");
                return false;
            }

            const emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if (!emailRegex.test(email)) {
                alert("Please enter a valid email address!");
                return false;
            }

            const today = new Date();
            const birthDate = new Date(birthdate);
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            if (age < 18) {
                alert("You must be at least 18 years old to register!");
                return false;
            }

            if (password.length < 8) {
                alert("Password must be at least 8 characters long!");
                return false;
            }

            if (password !== confirmPassword) {
                alert("Confirm password does not match!");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>