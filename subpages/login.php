<?php
$error = $uname = $pass = "";
$hasError = false;

if (isset($_POST['submit'])) {

    $uname = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = $_POST['password'];
}

require_once __DIR__ . '/../src/autoload.php';
$siteKey = '6Ld04zAlAAAAAK5vTaNmHPT3TMjyri7n0d8VNtW4';
$secret = '6Ld04zAlAAAAAFkPUH-ywYrfAHhNGnqVM5wjJdMl';
if (isset($_POST['g-recaptcha-response'])) {
    $response = $_POST['g-recaptcha-response'];
    $remoteip = $_SERVER['REMOTE_ADDR'];

    $recaptcha = new \ReCaptcha\ReCaptcha($secret);
    $resp = $recaptcha->verify($response, $remoteip);

    if ($resp->isSuccess()) {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $uname = trim($_POST['username']);
            $pass = trim($_POST['password']);

            if (empty($uname)) {
                $uname = "Username is required.";
                $hasError = true;
            } else {
                if (!preg_match('/^[a-zA-Z0-9@]+$/', $uname)) {
                    $error = "Username cannot contain any other special characters than '@'.";
                    $hasError = true;
                }
            }
            if (empty($pass)) {
                $error = "Password is required.";
                $hasError = true;
            }

            if (!$hasError) {
                $sql = "SELECT * FROM users where username = '$uname'";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);
                if ($num == 1) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if (password_verify($pass, $row['password'])) {
                            session_start();
                            $_SESSION['isLoggedIn'] = true;
                            $_SESSION['username'] = $uname;
                            $_SESSION['name'] = $row['name'];
                            if ($row['type'] == "user"){
                                header("location:dasindex.php");
                            }
                            else{
                                header("location:admin.php");
                            }
                        } else {
                            $error = "Invalid password.";
                        }
                    }
                } else {
                    $error = "Invalid Email or password.";
                }
            }
        }
    } else {
        $error = "Invalid Captcha";
    }
}

?>




<div class="login-container">
    <h1>Login</h1>
    <form id="login-form" action="#" method="post">
        <center>
            <b>
                <span id="error_msg" class="text-danger"><?php echo $error ?></span>
            </b>
        </center>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <b><a href="#" style="color: black;">Forgot Password ??</a> </b>
        <div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>
        <br>
        <button type="submit" style="background-color: black; 	font-weight: bold;">Login</button>
        <b> New Here?? <a href="index.php?page=register" style="color: black;">Register</a></b>
    </form>
    <div id="error-message"></div>
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<head>
    <!-- <link rel="stylesheet" href="./css/login.css"> -->
    <style>
        .login-container {
            background: white;
            padding: 20px;
            width: 400px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px #ccc;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 10px;
        }

        input {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        #g-recaptcha {
            margin-bottom: 20px;
        }
    </style>
</head>