<?php
$error = $name = $uname = $email = $pass = $cpass = "";
$nerror = $uerror = $eerror = $perror = $cerror = "";
$hasError = false;

require_once __DIR__ . '/../src/autoload.php';
$siteKey = '6Ld04zAlAAAAAK5vTaNmHPT3TMjyri7n0d8VNtW4';
$secret = '6Ld04zAlAAAAAFkPUH-ywYrfAHhNGnqVM5wjJdMl';
if (isset($_POST['g-recaptcha-response'])) {
    $response = $_POST['g-recaptcha-response'];
    $remoteip = $_SERVER['REMOTE_ADDR'];

    $recaptcha = new \ReCaptcha\ReCaptcha($secret);
    $resp = $recaptcha->verify($response, $remoteip);

    if ($resp->isSuccess()) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $name = trim($_POST['name']);
            $uname = trim($_POST['username']);
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $cpass = $_POST['cpassword'];

            if ($name == "") {
                $nerror = "Name is required.";
            } else {
                $pattern = "/^[a-zA-Z-' ]*$/";
                if (!preg_match($pattern, $name)) {
                    $nerror = "Invalid Name";
                    $hasError = true;
                }
            }
            if (empty($uname)) {
                $uerror = "Username is required.";
                $hasError = true;
            } else {
                if (!preg_match('/^[a-zA-Z0-9@]+$/', $uname)) {
                    $uerror = "Username shouldn't contain any other special characters than '@'.";
                    $hasError = true;
                }
            }
            if ($email == "") {
                $eerror = "Email is required.";
                $hasError = true;
            } else {
                $valid = filter_var($email, FILTER_VALIDATE_EMAIL);
                if (!$valid) {
                    $eerror = "Invalid email address.";
                    $hasError = true;
                }
            }
            if ($pass == "") {
                $perror = "Password is required.";
                $hasError = true;
            } else if (strlen($pass) < 8) {
                $perror = "Password must be atleast 8 character.";
                $hasError = true;
            } else if (!preg_match('/[0-9]/i', $pass)) {
                $perror = "Password must contain atleast one number.";
                $hasError = true;
            } else if (!preg_match('/[^A-Za-z0-9]/', $pass)) {
                $perror = "Password must contain atleast one special character.";
                $hasError = true;
            }
            if ($cpass == "") {
                $cerror = "Confirm Password is required.";
                $hasError = true;
            } else if ($cpass != $pass) {
                $cerror = "Password doesn't matches";
                $hasError = true;
            }


            if (!$hasError) {
                $select = "SELECT * FROM users WHERE username = '$uname'";
                $result = mysqli_query($conn, $select);
                if (mysqli_num_rows($result) > 0) {
                    $error = 'User already exists';
                } else {

                    $sql = "INSERT INTO users
                    (name, username, email, password, type)
                    VALUES (?, ?, ?, ?, ?)";

                    if ($stmt = $conn->prepare($sql)) {
                        $stmt->bind_param("sssss", $p_name, $p_uname, $p_email, $p_pass, $p_type);

                        $p_name = $name;
                        $p_uname = $uname;
                        $p_email = $email;
                        $p_pass = password_hash($pass, PASSWORD_DEFAULT);
                        $p_type = "user";

                        if ($stmt->execute()) {
                            echo "Record inserted successfully.";
                            header("location: index.php?page=login");
                            exit();
                        }

                        $stmt->close();
                    }
                }
                $conn->close();
            }
        }
    } else {
        $error = "Invalid Captcha";
    }
}
?>


<div class="form-box">
    <form class="form" action="index.php?page=register" method="post">
        <span class="title">Sign up</span>
        <span class="subtitle">Create a free account with your email.</span>
        <div class="form-container">
            <center>
                <b>
                    <span id="error_msg" class="text-danger"><?php echo $error ?></span>
                </b>
            </center>
            <input type="text" class="input" id="name" name="name" placeholder="Full Name" value="<?= $name ?>">
            <span class="text-danger"><?php echo $nerror ?></span>

            <input type="text" class="input" id="username" name="username" placeholder="Username" value="<?= $uname ?>">
            <span class="text-danger"><?= $uerror ?></span>

            <input type="email" class="input" id="email" name="email" placeholder="Email" value="<?= $email ?>">
            <span class="text-danger"><?= $eerror ?></span>

            <input type="password" class="input" id="password" name="password" placeholder="Password" oninput="check()" value="<?= $pass ?>">
            <span class="text-danger"><?php echo $perror ?></span> <br>
            <span id="password-strength" style="font-size: small; float:left;"></span><br>
            <div style="float: left; text-align:left; font-size: small;" id="psug">
                <div id="check0" class="text-danger">
                    <i class="far fa-circle-xmark" id="ch0"></i>
                    <span> Password must be atleast 8 character.</span>
                </div>
                <div id="check1" class="text-danger">
                    <i class="far fa-circle-xmark" id="ch1"></i>
                    <span> Password must contain atleast one Uppercase.</span>
                </div>
                <div id="check2" class="text-danger">
                    <i class="far fa-circle-xmark" id="ch2"></i>
                    <span> Password must contain atleast one Lowercase.</span>
                </div>
                <div id="check3" class="text-danger">
                    <i class="far fa-circle-xmark" id="ch3"></i>
                    <span>Password must contain atleast one Number.</span>
                </div>
                <div id="check4" class="text-danger">
                    <i class="far fa-circle-xmark" id="ch4"></i>
                    <span>Password must contain atleast one Special Character.</span>
                </div>
            </div>
            <input type="password" class="input" id="cpassword" name="cpassword" placeholder="Confirm Password" value="<?= $cpass ?>">
            <span class="text-danger"><?php echo $cerror ?></span>

            <div class="form-group">
                <input type="button" id="generate" style="font-size: 12px;" value="Generate Strong Password">
            </div>

        </div>
        <div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>
        <button type="submit">Sign up</button>
    </form>
    <div class="form-section">
        <p>Have an account? <a href="index.php?page=login">Log in</a> </p>
    </div>
</div>


<head>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        const strengthLevels = [{
                level: "",
                // color: "#e60000",
            }, {
                level: "Very Weak",
                color: "#e60000",
            },
            {
                level: "Weak",
                color: "#ff6600",
            },
            {
                level: "Moderate",
                color: "#ffcc00",
            },
            {
                level: "Strong",
                color: "#99cc00",
            },
            {
                level: "Very Strong",
                color: "#009900",
            },
        ];

        function getPasswordStrength(password) {
            let score = 0;
            if (password.length > 0 && password.length < 5) {
                return 1;
            }
            if (password.match(/[a-z]/)) {
                score += 1;
            }
            if (password.match(/[A-Z]/)) {
                score += 1;
            }
            if (password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) {
                score += 1;
            }
            if (password.match(/[0-9]/)) {
                score += 1;
            }
            if (password.length >= 8) {
                score += 1;
            }
            return score;
        }

        function showPasswordStrength() {
            const passwordInput = document.getElementById("password");
            const passwordStrength = document.getElementById("password-strength");
            const password = passwordInput.value;
            const strength = getPasswordStrength(password);
            passwordStrength.textContent = strengthLevels[strength].level;
            passwordStrength.style.color = strengthLevels[strength].color;
            console.log(strength);
        }

        const passwordInput = document.getElementById("password");
        const cpasswordInput = document.getElementById("cpassword");

        passwordInput.addEventListener("mouseover", () => {
            passwordInput.type = "text";
        });
        passwordInput.addEventListener("mouseout", () => {
            passwordInput.type = "password";
        });
        cpasswordInput.addEventListener("mouseover", () => {
            cpasswordInput.type = "text";
        });
        cpasswordInput.addEventListener("mouseout", () => {
            cpasswordInput.type = "password";
        });

        passwordInput.addEventListener("input", showPasswordStrength);

        var hiddenDiv = document.getElementById('psug');
        $(document).ready(function() {
            $("#psug").hide();

            $("#password").on("click", function() {
                $("#psug").slideDown();
            });
        });

        function check() {
            var input = document.getElementById("password").value;
            if (input.length >= 8) {
                // console.log(input);
                document.getElementById("check0").className = "text-success";
                document.getElementById("ch0").className = "far fa-check-circle";
                // console.log(document.getElementById("check0").className);
            } else {
                document.getElementById("check0").className = "text-danger";
                document.getElementById("ch0").className = "far fa-circle-xmark";
            }

            if (input.match(/[A-Z]/)) {
                document.getElementById("check1").className = "text-success";
                document.getElementById("ch1").className = "far fa-check-circle";
            } else {
                document.getElementById("check1").className = "text-danger";
                document.getElementById("ch1").className = "far fa-circle-xmark";
            }

            if (input.match(/[a-z]/)) {
                document.getElementById("check2").className = "text-success";
                document.getElementById("ch2").className = "far fa-check-circle";
            } else {
                document.getElementById("check2").className = "text-danger";
                document.getElementById("ch2").className = "far fa-circle-xmark";
            }

            if (input.match(/[0-9]/)) {
                document.getElementById("check3").className = "text-success";
                document.getElementById("ch3").className = "far fa-check-circle";
            } else {
                document.getElementById("check3").className = "text-danger";
                document.getElementById("ch3").className = "far fa-circle-xmark";
            }

            if (input.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) {
                document.getElementById("check4").className = "text-success";
                document.getElementById("ch4").className = "far fa-check-circle";
            } else {
                document.getElementById("check4").className = "text-danger";
                document.getElementById("ch4").className = "far fa-circle-xmark";
            }

        }

        const passwordChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+";
        const passwordLength = 12;

        function generatePassword() {
            let password = "";
            for (let i = 0; i < passwordLength; i++) {
                password += passwordChars.charAt(
                    Math.floor(Math.random() * passwordChars.length)
                );
            }
            return password;
        }

        const button = document.getElementById("generate");

        button.addEventListener("click", function() {
            const password = generatePassword();
            passwordInput.value = password;
            cpasswordInput.value = password;
        });

    </script>
    <style>
        #psug {
            display: none;
            overflow: hidden;
            transition: height 0.5s ease;
        }

        .form-box {
            background: white;
            overflow: hidden;
            padding: 20px;
            width: 400px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px #ccc;
            font-weight: bold;
            color: black;
        }

        .form {
            position: relative;
            display: flex;
            flex-direction: column;
            padding: 32px 24px 24px;
            gap: 16px;
            text-align: center;
        }

        /*Form text*/
        .title {
            font-weight: bold;
            font-size: 1.6rem;
        }

        .subtitle {
            font-size: 1rem;
            color: #666;
        }

        /*Inputs box*/
        .form-container {
            overflow: hidden;
            border-radius: 8px;
            background-color: #fff;
            margin: 1rem 0 0.5rem;
            width: 100%;
        }

        .input {
            background: none;
            border: 1px solid #ccc;
            border-radius: 10px;
            outline: 0;
            height: 40px;
            width: 100%;
            border-bottom: 1px solid #eee;
            font-size: 0.9rem;
            padding: 8px 15px;
        }

        .form-section a {
            font-weight: bold;
            color: black;
            transition: color 0.3s ease;
        }

        .form-section a:hover {
            color: #191414;
            text-decoration: underline;
        }

        /*Button*/
        .form button {
            background-color: black;
            color: #fff;
            border: 0;
            border-radius: 24px;
            padding: 10px 16px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form button:hover {
            background-color: #191414;
        }

        .form #generate {
            background-color: black;
            color: #fff;
            border: 0;
            border-radius: 24px;
            padding: 10px 16px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form #generate:hover {
            background-color: #191414;
        }
    </style>
</head>