//show/hide password
function myFunction() {
    var passwordHandle = document.getElementById("lr-password");
    if (passwordHandle.type === "password") {
        passwordHandle.type = "text";
    } else {
        passwordHandle.type = "password";
    }
}
//switch login & register
var x = document.getElementById("lr-login");
var y = document.getElementById("lr-register");
var z = document.getElementById("lr-btn");
//var v1=document.getElementById("v1");


function lr_register_fun() {
    //v1.innerHTML='<div class="g-recaptcha" id="g-recaptcha-login" data-callback="recaptchaCallbackLogin" data-sitekey="6LcTVacgAAAAAFhKHbLcEfUSDpPT8MJ2x5mKE7qx" name="captcha"></div>';
    x.style.left = "-105%";
    y.style.left = "10%";
    z.style.background = "linear-gradient(to right, red, yellow)";
    z.style.left = "50%";
}

function lr_login_fun() {
    //v1.innerHTML='<div class="g-recaptcha" id="g-recaptcha-login" data-callback="recaptchaCallbackLogin" data-sitekey="6LcTVacgAAAAAFhKHbLcEfUSDpPT8MJ2x5mKE7qx" name="captcha"></div>';
    x.style.left = "10%";
    y.style.left = "105%";
    z.style.background = "linear-gradient(to right, yellow , red)";
    z.style.left = "0%";
}
lr_login_fun();

//disable submit button & login untill capcha verified
var regStatus = {
    mail: false, //false is must
    cap: false
};
var register = document.getElementById("lr-register-btn");
var login = document.getElementById("lr-login-btn");
var loginLoader = document.getElementById("lr-login-loader");
var registerLoader = document.getElementById("lr-register-loader");

var cap_login_val = "NULL";
var cap_register_val = "NULL";

function recaptchaCallbackLogin(token) {
    //$('#lr-login-btn').removeAttr('disabled');
    login.disabled = false;
    cap_login_val = token;
};

function recaptchaExpireLogin() {
    cap_login_val = "NULL";
};

function recaptchaCallbackRegister(token) {
    cap_register_val = token;
    regStatus['cap'] = true;
    regBtnActive();
};

function recaptchaExpireLogin() {
    cap_register_val = "NULL";
};

function regBtnActive() {
    if (regStatus['cap'] && regStatus['mail'])
        //$('#lr-register-btn').removeAttr('disabled');
        register.disabled = false;
}

//show hide loader
function viewLogin() {
    login.style.visibility = "visible";
    loginLoader.style.visibility = "hidden";
}

function hideLogin() {
    login.style.visibility = "hidden";
    loginLoader.style.visibility = "visible";
}

function viewRegister() {
    register.style.visibility = "visible";
    registerLoader.style.visibility = "hidden";
}

function hideRegister() {
    register.style.visibility = "hidden";
    registerLoader.style.visibility = "visible";
}






$(document).ready(function() {
    //if login captcha successfull send post request to login api
    $("#lr-login").on("submit", function(event) {
        event.preventDefault();
        var recaptcha = cap_login_val;
        //var recaptcha = grecaptcha.getResponse();
        if (recaptcha == "NULL") {
            //event.preventDefault();
            alert("Please Cheek Recaptcha");
        } else {
            //event.preventDefault();
            hideLogin();

            $.post("submit.php", {
                "secret": '6LcTVacgAAAAAFyGIcNNVqxUSf5SqVCT_cazwadG',
                "response": recaptcha
            }, function(response) {
                console.log(response);
                var result = JSON.parse("" + response);
                //after verification success by google api

                if (result.success === true) {
                    //ajax call to login.php
                    console.log("cap verified");

                    $.post("login.php", {
                        "mail": $("#lemail").val(),
                        "password": $("#lpassword").val()
                    }, function(response1) {
                        console.log(response1);
                        var result1 = JSON.parse("" + response1);
                        if (result1.status === true) {
                            //login successfull
                            viewLogin();
                            alert("login Successfull 😀😀😀😀");
                            console.log("login successfull");
                        } else {
                            //login unsuccessfull
                            viewLogin();
                            //alert("😢😢😢😢😢😢 login unsuccessfull");
                            alert(result1.message);
                        }
                    });
                } else {
                    viewLogin();
                    alert(
                        "Sorry 😢😢😢😢😢😢  Captcha not verified . Refresh the page and try again "
                    );
                    //wrong captchac
                }

            });
        }
    });

    ////if register captcha successfull send post request to register api

    $("#lr-register").on("submit", function(event) {

        event.preventDefault();
        var recaptcha = cap_register_val;
        //console.log(recaptcha);
        // = $("#g-recaptcha-login").val();
        //.val();
        //var recaptcha = grecaptcha.getResponse();
        if (recaptcha == "NULL") {
            event.preventDefault();
            alert("Please Cheek Recaptcha");
        } else {
            event.preventDefault();

            hideRegister();

            $.post("submit.php", {
                "secret": '6LcTVacgAAAAAFyGIcNNVqxUSf5SqVCT_cazwadG',
                "response": recaptcha
            }, function(response) {
                var result = JSON.parse("" + response);
                //after verification success by google api

                if (result.success === true) {
                    //ajax call to login.php
                    console.log("cap verified");

                    $.post("register.php", { //add more keys*********************
                        "mail": $("#lr-email").val(),
                        "password": $("#lpassword").val(),
                        "fname": $("#lr-fname").val(),
                        "lname": $("#lr-lname").val(),
                        "dob": $("#lr-dob").val(),
                        "country": $("#lr-country").val()
                    }, function(response1) {
                        console.log(response1);
                        var result1 = JSON.parse("" + response1);
                        console.log(result1);
                        if (result1.status === true) {
                            //reg successfull
                            viewRegister();
                            alert("Registration Successfull 😀😀😀😀")
                            console.log("reg successfull");
                        } else {
                            //reg unsuccessfull
                            viewRegister();
                            //alert("😢😢😢😢😢😢 Registration unsuccessfull");
                            alert(result1.message);
                        }
                    });
                } else {
                    viewRegister();
                    alert(
                        "Sorry 😢😢😢😢😢😢  Captcha not verified . Refresh the page and try again "
                    );
                    //wrong captchac
                }

            });

        }
    });





});









//register.disabled = true;

//handle mail container
var mail11 = document.getElementById("lr-email");
var mail12 = document.getElementById("lr-verify-btn");
var mail21 = document.getElementById("lr-v-code");
var mail22 = document.getElementById("lr-v-code-btn");
var mail31 = document.getElementById("lr-show-mail");
var mail32 = document.getElementById("lr-show-verified");
var mailLoader=document.getElementById("lr-mail-loader");
var mailLoaderContainer=document.getElementById("lr-mail-loader-container");

function hide(id1, id2) {
    id1.style.display = "none";
    id2.style.display = "none";
}

function show(id1, id2) {
    id1.style.display = "block";
    id2.style.display = "block";
}
function hide1(id1) {
    id1.style.display = "none";
}

function show1(id1) {
    id1.style.display = "block";
}
function hideMloader()
{
    mailLoader.style.display = "none";
    mailLoaderContainer.style.display = "none";
}
function showMloader()
{
    mailLoader.style.display = "block";
    mailLoaderContainer.style.display = "block";
}

hide(mail11, mail12);
hide(mail21, mail22);
hide(mail31, mail32);
hideMloader();
show(mail11, mail12);

//mail verification



var data_from_api;
async function mail_verification() {
    var rawMail = mail11.value;

    hide1(mail12);
    showMloader();

    var obj = {
        mail: rawMail
    };
    var mailid = JSON.stringify(obj);
    await $.ajax({
        url: 'http://localhost/phppranoy/projects/small_projects/register_login_with_google_or_mail_verification/mail_verification.php',
        type: "POST",
        data: mailid,
        success: function(data) {
            console.log(data);
            if (data.send === false) {
                hideMloader();
                show1(mail12);
                alert("unable to send mail");
            } else {
                hide(mail11, mail12);
                hideMloader();
                show(mail21, mail22);
                data_from_api = data;


            }
        }
    });
}

function match_verification_code() {
    hide1(mail22);
    showMloader();
    if (data_from_api['code'] == mail21.value) {
        hideMloader();
        hide(mail21, mail22);
        show(mail31, mail32);
        mail31.innerText = data_from_api['mail'];
        //handle disablity of register button
        regStatus['mail'] = true;
        regBtnActive();
    } else {
        hideMloader();
        show1(mail22);
        alert("Wrong verification Code");
        console.log("inc");
    }
}