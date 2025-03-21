<?php 
include_once ("db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$op = $_POST["login"];
$email = $_POST["mail"];
$pass = $_POST["pass"];
$encrypt_pass = md5($pass);

     if($op == 'Client'){
      $sql = "SELECT * FROM client WHERE email_id='$email' AND password='$encrypt_pass'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        while ($row = mysqli_fetch_array($result)) {
        session_start();
        $name = $row['name']; 
        $_SESSION["id"] = $row["c_id"];
        $_SESSION["role"] = "client";
        header("location: /legal_aid");
    }
}else{
       $err = "invalid username or password";
    }
     }else if($op == 'lawyer'){
      $sql = "SELECT * FROM lawyer WHERE email_id='$email' AND password='$encrypt_pass'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        while ($row = mysqli_fetch_array($result)) {
        session_start();
        $name = $row['name']; 
        $_SESSION["id"] = $row["l_id"];
        $_SESSION["role"] = "lawyer";
        header("location: /legal_aid");
    }
}else{
  $err = "invalid username or password";
}
     }


}?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Legal Aid Login</title>
  <link rel="icon" type="image/x-icon" href="/legal_aid/logo.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
  <style>
    .signup-form {
      background-color: #f0f0f0;
      padding: 20px;
      border-radius: 10px;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8 signup-form">
        <h2 class="text-center mb-4">Legal Aid Login</h2>
        <form action="#" method="post">
        <div class="col-md-6">
        <div class="mb-3">
                                <label for="login" class="form-label">Login As :</label>
                                <select class="form-select" id="login" name="login" style="cursor:pointer" required>
                                <option value="">choose</option>
                                <option value="lawyer">Lawyer</option>
                                <option value="Client">Client</option></select>
                            </div>
        </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" name="mail" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="pass" id="exampleInputPassword1">
  </div>
  <?php

if(isset($err)){
  echo "<p>$err</p>";
}

?>
  <a href="/legal_aid/signup.php">Create account ?</a> &nbsp;&nbsp; <button type="submit" class="btn">Login</button>
</form>
      </div>
    </div>
  </div>
</body>
<style>
  body{
    background: linear-gradient(to top, rgba(0,0,0,0.5)50%,rgba(0,0,0,0.5)50%), url("bg.jpeg");
    background-position: center;
    background-size: cover;
    height: 91vh;
  }
  .signup-form{
    background-color: transparent;
    color: white;
    border: 1px solid white;
  }
  .btn{
    background-color: #ff7200;
  }
  .btn:hover{
    background-color: black;
    color: #ff7200;
  }
  a{
color: white;
  }a:hover{
    color: #ff7200;
  }
</style>
</html>