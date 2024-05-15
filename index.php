<?php

session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    header("Location: ./MVC/views/dashboard.php");
}

$message = isset($_SESSION["message"]) ? $_SESSION["message"] : "";


$email = isset($_SESSION["email_val"]) ? $_SESSION["email_val"] : "";
$email_err = isset($_SESSION["email_err"]) ? $_SESSION["email_err"] : "";

$username = isset($_SESSION["username_val"]) ? $_SESSION["username_val"] : "";
$username_err = isset($_SESSION["username_err"]) ? $_SESSION["username_err"] : "";

$user_type = isset($_SESSION["user_type_val"]) ? $_SESSION["user_type_val"] : "";
$user_type_err = isset($_SESSION["user_type_err"]) ? $_SESSION["user_type_err"] : "";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            background-color: ghostwhite;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-signup {
            display: block;
            text-align: center;
            margin: 10px auto;
            text-decoration: none;
            color: #0d6efd;
        }

        #dark-btn {
            all: unset;
            cursor: pointer;
            position: absolute;
            right: 50px;
            top: 50px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/darkreader@4.9.84/darkreader.min.js"></script>
    <script>
        function getCookie(cname) {
            let name = cname + "=";
            let decodedCookie = decodeURIComponent(document.cookie);
            let ca = decodedCookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }
        function setCookie(cname, cvalue, exdays) {
            const d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            let expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }
        function toggleDarkMode() {
            const darkModeBtn = document.getElementById("dark-btn");
            const lightIcon = document.getElementById("light-icon");
            const darkIcon = document.getElementById("dark-icon");

            if (getCookie("darkMode") && getCookie("darkMode") == "") {
                setCookie("darkMode", false, 365);
            }

            let isDarkModeEnable = getCookie("darkMode") == "true" ? true : false;

            if (!isDarkModeEnable) {
                setCookie("darkMode", true, 365);
                lightIcon.style.display = "inline-block";
                darkIcon.style.display = "none";
                DarkReader.enable();
            } else {
                setCookie("darkMode", false, 365);
                darkIcon.style.display = "inline-block";
                lightIcon.style.display = "none";
                DarkReader.disable();
            }
        }
    </script>
</head>

<body>

    <button id="dark-btn" onclick="toggleDarkMode()">
        <svg id="light-icon" width="30" height="30" style="display: none;">
            <circle cx="15" cy="15" r="6" fill="currentColor" />

            <line id="ray" stroke="currentColor" stroke-width="2" stroke-linecap="round" x1="15" y1="1" x2="15" y2="4">
            </line>

            <use href="#ray" transform="rotate(45 15 15)" />
            <use href="#ray" transform="rotate(90 15 15)" />
            <use href="#ray" transform="rotate(135 15 15)" />
            <use href="#ray" transform="rotate(180 15 15)" />
            <use href="#ray" transform="rotate(225 15 15)" />
            <use href="#ray" transform="rotate(270 15 15)" />
            <use href="#ray" transform="rotate(315 15 15)" />
        </svg>

        <svg id="dark-icon" width="30" height="30">
            <path fill="currentColor" d="M 23, 5 A 12 12 0 1 0 23, 25 A 12 12 0 0 1 23, 5" />
        </svg>
    </button>

    <div class="login-container">
        <h2>Central Blood Bank</h2>
        <span><?php echo $message; ?></span>
        <form action="./MVC/controllers/loginController.php" method="POST">
            <div class="mb-3">
                <label for="user-type" class="form-label"><b>User Type</b></label>
                <select name="user-type" class="form-select" id="user-type">
                    <option value="">None</option>
                    <option value="admin">Admin</option>
                    <option value="bloodbank">Blood Bank</option>
                    <option value="patient">Patient</option>
                    <option value="donor">Donor</option>
                </select>
                <span><?php echo $user_type_err; ?></span>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label"><b>Username</b></label>
                <input type="text" name="username" class="form-control" placeholder="Enter your name" id="username">
                <span><?php echo $username_err; ?></span>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label"><b>Email</b></label>
                <input type="text" name="email" class="form-control" placeholder="Enter your email" id="email">
                <span><?php echo $email_err; ?></span>
            </div>

            <button type="submit" name="login-submit" class="btn btn-primary w-100">Login</button>
        </form>

        <!-- <a href="MVC/controllers/signupController.php" class="btn btn-outline-primary btn-signup">Signup</a> -->
        <a href="signup.php" class="btn btn-outline-primary btn-signup">Signup</a>

    </div>

</body>

</html>

<?php

unset($_SESSION["email_err"]);
unset($_SESSION["username_err"]);
unset($_SESSION["user_type_err"]);
unset($_SESSION["message"]);
