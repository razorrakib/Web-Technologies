<?php
session_start();
// foreach($_POST as $key => $value)
// {
//   echo"{$key} = {$value} <br>";
// }

// $uname = $_POST['name'];

if (isset($_POST['response'])) {
  $resp = $_POST['response'];
  if ($resp == "cancel") {
    header("Location: index.php");
    exit();
  } else if ($resp == "confirm") {




    $username = $_SESSION['username'];
    $e_mail = $_SESSION['e_mail'];
    $pass_word = $_SESSION['pass_word'];
    $bdate = $_SESSION['bdate'];
    $country_ = $_SESSION['country_'];
    $gender_ = $_SESSION['gender_'];
    $bgcolor = $_SESSION['bgcolor'];



    $con = mysqli_connect("localhost", "root", "", "db_aqi");


    $sql = "INSERT INTO user (fullname, email, password, birthdate, country, gender) 
            VALUES ('$username', '$e_mail', '$pass_word', '$bdate', '$country_', '$gender_');";

    if (mysqli_query($con, $sql)) {
      echo "Inserted....";


      // setcookie('fvcolor', $bgcolor);

      $colorPrefs = [
        'email' => $_SESSION['email'],
        'bgcolor' => $_SESSION['bgcolor']
      ];
      setcookie('favcolor', json_encode($colorPrefs), time() + (86400 * 30), "/");


      header("Location: index.php");
      exit();
    } else {
      echo "Error while inserting data: " . mysqli_error($con);
    }
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CONFIRM DATA</title>
  <style>
    .flowbox4 {
      width: 50%;
      background-color: rgb(184, 255, 216);
      display: auto;
      justify-content: center;
      align-items: center;
      font-size: 25px;
      padding: 15px;
      font-weight: normal;
    }

    body {

      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: column;
      align-items: center;
      margin: 0;
      padding: 20px;
    }
  </style>
</head>
<h2>Would you like to proceed with the given data?</h2>

<body>
  <div class="flowbox4">
    <?php



    // $_SESSION['username'] = $_POST['uname'];
    $_SESSION['username'] = $_POST['fname'];
    $_SESSION['e_mail'] = $_POST['email'];


    $_SESSION['pass_word'] = $_POST['password'];

    $_SESSION['bdate'] = $_POST['birthday'];
    $_SESSION['country_'] = $_POST['Country'];
    $_SESSION['gender_'] = $_POST['gender'];
    $_SESSION['bgcolor'] = $_POST['favcolor'];



    $username = $_SESSION['username'];
    $e_mail = $_SESSION['e_mail'];
    $pass_word = $_SESSION['pass_word'];
    $bdate = $_SESSION['bdate'];
    $country_ = $_SESSION['country_'];
    $gender_ = $_SESSION['gender_'];
    $bgcolor = $_SESSION['bgcolor'];

    echo "Fullname: $username<br>";
    echo "Email: $e_mail<br>";
    echo "Password: $pass_word<br>";
    echo "Birthdate: $bdate<br>";
    echo "Country: $country_<br>";
    echo "Gender: $gender_<br>";
    echo "Favourite Color: $bgcolor<br>";



    ?></div>
  <form method="post">

    <button type="submit" name="response" value="confirm">Confirm</button>
    <button type="submit" name="response" value="cancel">Cancel</button>
  </form>



</body>

</html>