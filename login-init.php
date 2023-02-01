<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $data = array(
        "username" => $username,
        "password" => $password
    );

    $data_string = json_encode($data);

    $ch = curl_init("https://netzwelt-devtest.azurewebsites.net/Account/SignIn");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length:' . strlen($data_string)
    ));
    $response = curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    //if statements

    if ($status_code == 200) {
        //LOGIN SUCCESS
        session_start();
        $_SESSION['status'] = 'success';
        header("Location: index.php");
        exit;
    } else {
        //Failed
        header("location: login.php?error=wronginput");
        exit();
    }

  }

  else{
    header("location: login.php");
    exit();
  }


?>