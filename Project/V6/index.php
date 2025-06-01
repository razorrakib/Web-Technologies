<?php



if (isset($_POST["log"])) {
    $email = $_POST["logemail"];
    $pass = $_POST["logpassword"];

    $conn = mysqli_connect('localhost', 'root', '', 'db_aqi');
    $sql = "SELECT fullname FROM user WHERE email = '$email' and password = '$pass'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        session_start();
        $_SESSION["fname"] =  $row['fullname'];
        $_SESSION["email"] =  $email;

        echo "<p>Login Successful. Now redirecting...</p>";
        header("refresh: 2; url = request.php");
        exit();
    } else {
        echo "User not found";
        header("refresh: 2; url = index.php");
        exit();
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="aqi.css">
    <title>Layout Design</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 20px;
        }


        .logo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            margin-bottom: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }


        .container {
            display: flex;
            width: 1200px;
            height: 1000px;
        }


        .flowbox1 {
            width: 50%;
            height: 80%;
            background-color: rgb(220, 218, 225);
            display: auto;
            justify-content: center;
            align-items: top;
            font-size: 20px;
            padding: 15px;
            font-weight: normal;
        }


        .right-container {
            width: 50%;
            display: flex;
            flex-direction: column;
        }


        .flowbox2 {
            height: 30%;
            background-color: rgb(173, 218, 218);
            display: auto;
            justify-content: center;
            align-items: center;
            font-size: 25px;
            padding: 15px;
        }


        .flowbox3 {
            height: 47%;
            background-color: rgb(193, 48, 48);
            display: auto;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            padding: 15px;
            position: relative;
        }


        .blue-panel {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 90;
            display: flex;
            justify-content: center;
            align-items: center;
            color: rgb(0, 0, 0);
            font-size: 25px;
            font-weight: bold;



        }
    </style>

</head>

<body>

    <div class="logo">
        <img src="leaf.png" alt="Logo">
    </div>


    <div class="title">Air Quality Index</div>

    <div class="container">

        <div class="flowbox1">
            <h4>Signup Form</h4>
            <h4 id="message"></h4>



            <form action="process.php" method="post" onsubmit="return validate();">
                <label for="fname">Full Name:</label><br>
                <input type="text" id="fname" name="fname"><br>
                <br>

                <label for="email">E-mail:</label><br>
                <input type="text" id="email" name="email"><br>
                <br>

                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password"><br>
                <br>

                <label for="cpass">Confirm Password:</label><br>
                <input type="password" id="cpass" name="cpass"><br><br>




                <label for="birthday">Birthday:</label>
                <input type="date" id="birthday" name="birthday" value="2000-01-01"><br>




                <div class="dropdown"><br>
                    <label for="dropdown">Choose Country:</label>


                    <select id="Country" name="Country">
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Australia">Australia</option>
                        <option value="China">China</option>
                        <option value="South Africa">South Africa</option>
                    </select>

                </div> <br>

                <label>Choose Gender</label>
                <input type="radio" id="male" name="gender" value="male">
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="female">
                <label for="female">Female</label><br><br>



                <label>Choose Your Favourite Color</label>
                <input type="color" id="favcolor" name="favcolor" value="#ff0000"> <br> <br>




                <label for="opinion">Comment your opinion:</label><br>
                <textarea id="opinion" name="opinion" rows="5" cols="44">
                    </textarea><br><br>


                <label>I agree with the terms and conditions</label>
                <input type="checkbox" id="terms" name="terms">

                <br> <br>

                <input type="submit" name="submit" value="submit">

            </form><br>




        </div>


        <div class=" right-container">




            <div class="flowbox2">

                <h3>LOGIN</h3>

                <form method="post" onsubmit="return logvalidate();">
                    <h4 id="message2"></h4>

                    <label for="logemail">User Email:</label><br>
                    <input type="email" id="logemail" name="logemail" size="30px"><br>

                    <label for="logpassword">Password:</label><br>
                    <input type="password" id="logpassword" name="logpassword" size="30px"><br>



                    <input type="submit" name="log">

                </form>



            </div>

            <div class="flowbox3">

                <div class="overlay"></div>
                <div class="blue-panel">Login First To Access</div>
                <table id="aqitable">

                    <tr>
                        <th>CITY</th>
                        <th>AQI</th>

                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>


                </table>


            </div>



        </div>

    </div>
    </div>
    <script>
        function logvalidate() {
            const message = document.getElementById("message2");
            const mail = document.getElementById("logemail").value;
            const pass = document.getElementById("logpassword").value;

            message.style.color = "red";


            if (!mail || !pass) {
                message.textContent = "Please Enter Your Details to Login";
                return false;
            }
            message2.textContent = "";
            return true;

        }


        function validate() {


            const message = document.getElementById("message");
            const fullName = document.getElementById("fname").value.trim();
            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("cpass").value;
            const birthDate = document.getElementById("birthday").value;
            const gender = document.querySelector("input[name='gender']:checked");
            const terms = document.getElementById("terms").checked;


            message.style.color = "red";

            // Fullname validation
            if (!fullName) {
                message.textContent = "Fullname must not be empty";
                return false;
            }

            // Email validation (format: '22-12345-3@student.aiub.edu')
            const emailPattern = /^\d{2}-\d{5}-\d@student\.aiub\.edu$/;
            if (!email) {
                message.textContent = "Please enter a valid email";
                return false;
            } else if (!emailPattern.test(email)) {
                message.textContent =
                    "Email must follow the format '22-12345-3@student.aiub.edu'";
                return false;
            }


            const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[a-zA-Z]).{8,}$/;
            if (!password) {
                message.textContent = "Please enter a password";
                return false;
            } else if (password.length < 8) {
                message.textContent = "Password must be at least 8 characters long";
                return false;
            } else if (!passwordPattern.test(password)) {
                message.textContent =
                    "Password must contain at least 1 uppercase, 1 lowercase, 1 number, and 1 letter.";
                return false;
            }

            if (!confirmPassword) {
                message.textContent = "Please enter a the confirm password";
                return false;
            } else if (password !== confirmPassword) {
                message.textContent = "Password and Confirm Password must match.";
                return false;
            }


            if (!birthDate) {
                message.textContent = "Birthdate must be selected.";
                return false;
            }
            const birthDateObj = new Date(birthDate);
            const today = new Date();
            const age = today.getFullYear() - birthDateObj.getFullYear();
            const isBirthdayPast =
                today.getMonth() > birthDateObj.getMonth() ||
                (today.getMonth() === birthDateObj.getMonth() &&
                    today.getDate() >= birthDateObj.getDate());
            if (age < 18 || (age === 18 && !isBirthdayPast)) {
                message.textContent = "Age must be at least 18 years old.";
                return false;
            }


            if (!gender) {
                message.textContent = "Gender must be selected.";
                return false;
            }


            if (!terms) {
                message.textContent = "You must agree to the terms and conditions.";
                return false;
            }



            message.style.color = "green";
            message.textContent = "Signup successful!";

            return true;
        }
    </script>
</body>

</html>