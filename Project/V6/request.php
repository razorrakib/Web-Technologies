<?php



session_start();

if (isset($_POST['logout'])) {
    $resp = $_POST['logout'];
    if ($resp == "logout") {
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cities'])) {
    $selected_cities = $_POST['cities'];
    $count = count($selected_cities);


    if ($count >= 1 && $count <= 10) {
        $_SESSION['selected_cities'] = $selected_cities;
        header("Location: showaqi.php");
        exit();
    } else {
        $error = "Please select between 1 and 10 cities.";
    }
}



?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request</title>


    <style>
        .flowbox5 {
            width: 50%;
            font-family: Arial, sans-serif;
            background-color: rgb(117, 255, 147);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 25px;
            padding: 15px;
            font-weight: bold;
            flex-direction: row;

        }


        body {
            background-color: <?php
                                $bgColor = '#ffffff'; // default color is white
                                if (isset($_COOKIE['favcolor']) && isset($_SESSION['email'])) {
                                    $colorPrefs = unserialize($_COOKIE['favcolor']);

                                    if (
                                        is_array($colorPrefs) &&
                                        isset($colorPrefs['email'], $colorPrefs['bgcolor']) &&
                                        $colorPrefs['email'] === $_SESSION['email']
                                    ) {
                                        $bgColor = $colorPrefs['bgcolor'];
                                    }
                                }
                                echo htmlspecialchars($bgColor, ENT_QUOTES, 'UTF-8');
                                ?>;


            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 20px;
        }
    </style>
</head>

<body>
    <h4 id="showmail"><?php if (isset($_SESSION["fname"])) {
                            echo $_SESSION["fname"];
                        } else {
                            echo ".....";
                        }
                        ?></h4>
    <form method="post">

        <button type="submit" name="logout" value="logout">Logout</button>

    </form>
    <h1>Please Select Cities you want to see</h1>

    <div class="flowbox5">
        <form method="POST" onsubmit="return validateForm();">
            <div class="checkbox-container">
                <h4 id="message"></h4>

                <?php

                $conn = mysqli_connect('localhost', 'root', '', 'db_aqi');
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                $sql = "SELECT city FROM info";
                $result = mysqli_query($conn, $sql);
                $cities = [];
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $cities[] = $row['city'];
                    }
                } else {
                    $cities = ["No cities found"];
                }

                foreach ($cities as $index => $city) {
                    echo "<label><input type='checkbox' name='cities[]' value='" . htmlspecialchars($city) . "'> " . htmlspecialchars($city) . "</label><br>";
                }


                ?>
                <br> <br>
                <input type="submit" name="submit">


            </div>
        </form>
    </div>
    <script>
        function validateForm() {
            document.getElementById("showmail").textContent = "<?php echo isset($_SESSION['fname']) ? 'Email: ' . $_SESSION['fname'] : 'No email set in session.'; ?>";
            const checkboxes = document.querySelectorAll('input[name="cities[]"]:checked');
            const count = checkboxes.length;
            const msg = document.getElementById("message");
            message.style.color = "red";
            if (count < 1) {
                message.textContent = "Please select atleast one city";
                return false;
            } else if (count > 10) {
                message.textContent = "You cannot select more than ten cities";
                return false;
            }

            return true;
        }
    </script>

</body>

</html>