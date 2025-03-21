<?php
include_once("db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $op = $_POST["signup"];
    $name = $_POST["name"];
    $phone = $_POST["phone_number"];
    $email = $_POST["email"];
    $addr = $_POST["address"];
    $dob = $_POST["date_of_birth"];
    $addh = $_POST["aadhar_number"];
    $pass = $_POST["password"];
    $encrypt_pass = md5($pass);
    function generateUniqueID($length = 8)
    {
        $characters = 'aA0bBcC1dDeE2fFgG3hHiI4jJkK5lLmM6nNoO7pPqQ8rRsS9tTuUvVwWxXyYzZ';
        $randomString = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $max)];
        }
        return $randomString;
    }
    $uid = uniqid(generateUniqueID(8));

   if($op == 'Client'){
    $sql1 = "SELECT * FROM client WHERE email_id='$email'";
    $result = $conn->query($sql1);
    if ($result->num_rows !== 1) {
        $sql2 = "SELECT * FROM client WHERE aadhar='$addh'";
        $result2 = $conn->query($sql2);
        if ($result2->num_rows !== 1) {
        $sql = "INSERT INTO client (c_id, name, phone_no, email_id, address, dob, aadhar, password) VALUES ('$uid', '$name', '$phone', '$email', '$addr', '$dob', '$addh', '$encrypt_pass')";
        if ($conn->query($sql) === TRUE) {
                session_start();
                $_SESSION["id"] = $uid;
                $_SESSION["role"] = "client";
                header("location: /legal_aid");
        }
    }else{
        $err = "Aadhar number already exists";
    }

    }else{
        $err = "Email Id Already exists";
    }
   }
   else if($op == 'lawyer'){
    $sql1 = "SELECT * FROM lawyer WHERE email_id='$email'";
    $result = $conn->query($sql1);
    if ($result->num_rows !== 1) {
        $sql2 = "SELECT * FROM lawyer WHERE aadhar='$addh'";
        $result2 = $conn->query($sql2);
        if ($result2->num_rows !== 1) {
        $sql = "INSERT INTO lawyer (l_id, name, phone_no, email_id, address, dob, aadhar, password) VALUES ('$uid', '$name', '$phone', '$email', '$addr', '$dob', '$addh', '$encrypt_pass')";
        if ($conn->query($sql) === TRUE) {
                session_start();
                $_SESSION["id"] = $uid;
                $_SESSION["role"] = "lawyer";
                header("location: /legal_aid");
        }
    }else{
        $err = "Aadhar number already exists";
    }
    }else{
        $err = "Email Id Already exists"; 
    }
   }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Legal Aid Create Account</title>
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
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8 signup-form">
                <h2 class="text-center mb-4">Legal Aid Signup</h2>
                <form id="signup-form" action="#" method="post">
                    <div class="row">
                        <div class="col-md-6">
                        <div class="mb-3">
                                <label for="signup" class="form-label">Signup As :</label>
                                <select class="form-select" id="signup" name="signup" style="cursor:pointer" required>
                                <option value="">choose</option>
                                <option value="lawyer">Lawyer</option>
                                <option value="Client">Client</option></select>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email :</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth :</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="aadhar_number" class="form-label">Aadhar Number :</label>
                                <input type="text" class="form-control" id="aadhar_number" name="aadhar_number" minlength="12" maxlength="12" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="mb-3">
                                <label for="name" class="form-label">Name :</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number :</label>
                                <input type="tel" class="form-control" id="phone_number" name="phone_number" minlength="10" maxlength="10" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address :</label>
                                <textarea class="form-control" id="address" name="address" required></textarea>
                            </div>
                            
                            
                    <div class="mb-3">
                        <label for="password" class="form-label">Password :</label>
                        <input type="password" class="form-control" id="password" name="password" minlength="8" maxlength="16" required>
                    </div>
                        </div>
                    </div>
                    <?php

if(isset($err)){
  echo "<p>$err</p>";
}

?>
                    <a href="/legal_aid/login.php">Already have an account ?</a> &nbsp;&nbsp; <button type="submit" class="btn">Signup</button>
                </form>
            </div>
        </div>
    </div><br>
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