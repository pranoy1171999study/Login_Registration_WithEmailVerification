<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="UTF-8">
    <title>LOGIN/REGISTER</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="jquery.js"></script>
    <link rel="stylesheet" href="styles.css">
    

</head>

<body>
    <div id="lr-form-box">
        <div id="lr-button-box">
            <div id="lr-btn"></div>
            <button class="lr-switch" onclick="lr_login_fun() ">Login</button>
            <button class="lr-switch" onclick="lr_register_fun()">Register</button>
        </div>
        <form class="lr-login-form" id="lr-login">
            <input id="lemail" type="email" class="lr-input" placeholder="Email" name="email" required>
            <input id="lpassword" type="password" class="lr-input" placeholder="Password" name="password" required>
            <input type="checkbox" onclick="myFunction()"><span class="lr-indicates">Show Password</span>
            <!--<div id="v1" class="verification-box"></div>-->
            <div class="g-recaptcha" id="g-recaptcha-login" data-callback="recaptchaCallbackLogin"
                data-expired-callback="recaptchaExpireLogin" data-sitekey="6LcTVacgAAAAAFhKHbLcEfUSDpPT8MJ2x5mKE7qx"
                name="captcha"></div>
            <div class="lr-loading-box">
                <button id="lr-login-btn" type="submit" class="lr-submit" name="login" value="login">Login</button>
                <div id="lr-login-loader" class="loader"></div>
            </div>
        </form>


        <form class="lr-login-form" id="lr-register">
            <input type="text" id="lr-fname" class="lr-input" placeholder="First Name" name="fname" required>
            <input type="text" id="lr-lname" class="lr-input" placeholder="Last Name" name="lname" required>
            <div id="lr-mail-verification" class="lr-input">
                
                <input id="lr-email" type="email" class="lr-input lr-mail-first" placeholder="Email" name="email"
                    required>
                <div id="lr-verify-btn" class="lr-mail-second  lr-btn" onclick="mail_verification()">Verify</div>

                <input id="lr-v-code" type="number" class="lr-input lr-mail-first" placeholder="Verification Code"
                    name="vcode" >
                <div id="lr-v-code-btn" class="lr-mail-second  lr-btn" onclick="match_verification_code()">Cheek</div>

                <div id="lr-show-mail" class="lr-input lr-mail-first"></div>
                <div id="lr-show-verified" class="lr-input lr-mail-second">Verified</div>
                <!--loader for mail box-->
                <div  class="lr-input lr-mail-second" id="lr-mail-loader-container"><div id="lr-mail-loader" class="loader"></div></div>
            </div>
            <input type="password" id="lr-password" class="lr-input" placeholder="Password" name="password" required>
            <input type="checkbox" onclick="myFunction()" name="rcheek"><span class="lr-indicates">Show Password</span>
            <div class="lr-country-box">
                <span id="lr-dob-txt"> Date of Birth : </span>
                <input type="date" class="" id="lr-dob" name="dob" required>
            </div>
            <div class="lr-country-box">
                <span id="lr-country-txt"> Country : </span>
                <select id="lr-country" name="country">
                    <?php include "countries.php" ?>
                </select>
            </div>
            <div class="g-recaptcha" id="g-recaptcha-register" data-callback="recaptchaCallbackRegister"
                data-expired-callback="recaptchaExpireRegister" data-sitekey="6LcTVacgAAAAAFhKHbLcEfUSDpPT8MJ2x5mKE7qx"
                name="captcha"></div>

            <div class="lr-loading-box">
                <button id="lr-register-btn" type="submit" class="lr-submit" name="register"
                    value="register" disabled>Register</button>
                <div id="lr-register-loader" class="loader"></div>
            </div>
        </form>

    </div>

    <script src="script.js">
    
    </script>
</body>

</html>