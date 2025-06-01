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

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="aqi.css">
    <title>Selected Cities</title>
    <style>
        .title1 {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;



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
        }
    </style>


</head>

<body>
    <button id="showname" onclick="greetUser()"><?php if (isset($_SESSION["fname"])) {
                                                    echo $_SESSION["fname"];
                                                } else {
                                                    echo ".....";
                                                }
                                                ?></button>
    <h4 id="userdata"></h4>

    <form method="post">

        <button type="submit" name="logout" value="logout">Logout</button>

    </form>

    <h1 class="title1">Air Quality Index</h1>
    <?php
    if (isset($_SESSION["selected_cities"]) && is_array($_SESSION["selected_cities"])) {

        $conn = mysqli_connect('localhost', 'root', '', 'db_aqi');
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        echo "<table>";
        echo "<tr><th>City</th><th>AQI</th></tr>";

        foreach ($_SESSION["selected_cities"] as $city) {

            $query = "SELECT aqi FROM info WHERE city = '" . mysqli_real_escape_string($conn, $city) . "'";
            $result = mysqli_query($conn, $query);
            $count = mysqli_num_rows($result);

            if ($count > 0) {
                $row = mysqli_fetch_assoc($result);
                $aqi = $row['aqi'];

                echo "<tr>
                        <td>" . htmlspecialchars($city) . "</td>
                        <td>" . htmlspecialchars($aqi) . "</td>
                      </tr>";
            } else {
                echo "<tr>
                        <td>" . htmlspecialchars($city) . "</td>
                        <td>N/A</td>
                      </tr>";
            }
        }

        echo "</table>";
        mysqli_close($conn);
    } else {
        echo "<p class='error'>No cities set in session. Please login first. <br> Now Redirecting... </p>";
        header("refresh: 3; url = index.php");
        exit();
    }
    ?>


    <script>
        function greetUser() {
            const username = document.getElementById("showname").textContent;
            if (username !== ".....") {
                document.getElementById("userdata").textContent = "Hi " + username;
            } else {
                document.getElementById("userdata").textContent = "No user logged in";
            }
        }
    </script>
</body>

</html>