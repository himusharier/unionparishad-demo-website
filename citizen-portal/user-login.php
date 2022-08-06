<?php
session_start();
if (isset($_SESSION["user_id"]) && isset($_SESSION["user_pass"])) {
    include("bkend-call/user-dashboardRedirect-check.php");
} else {
    include("config/database-connection.php");
    include('config/canonical-link.php');
}
?>

    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- SEO tags starts -->
        <meta name="description" content="">
        <meta name="keywords" content="">
        <title>নাগরিক পোর্টাল - ইউনিয়ন পরিষদ</title>
        <link rel="canonical" href="<?php echo $canonical_link; ?>" />
        <!-- // SEO tags ends -->
        <?php
        require ('config/og-tags.php');
        ?>
        <link rel="icon" href="assets/images/favicon.png">
        <link rel="stylesheet" href="assets/css/user-login-page-style.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <style>
            body {
                /* setup background image */
                background: url("assets/images/login-background.jpg") no-repeat fixed;
                background-size: cover;
                background-position: 50%;
            }
        </style>
    </head>

    <body>
    <header>
        <div class="header-bg-container">
            <div class="header-main-container">
                <div class="header-site-logo">
                    <a href="home"><img src="assets/images/favicon.png" alt="" height="40" /></a>
                    <a href="<?php echo $canonical_link; ?>" style="text-decoration: none; color: #FFFFFF; font-size: 32px; font-family: 'Bangla';">&nbsp;ইউনিয়ন পরিষদ</a>
                </div>

            </div>
        </div>
    </header>
    <main>
        <div class="centering-container">
            <div class="centering-content">
                <div class="form-container">
                    <div class="form-top-margin">
                        <img src="assets/images/logo-site.png" width="200">
                    </div>
                </div>


                <div class="form-container-two">
                    <div id="login-form">
                        <div style="opacity: 1 !important; border-bottom: 3px solid #23b14d; margin: 10px auto; margin-bottom: 30px; width: 180px; margin-top: 50px;">
                            <h2 style="margin: 0; font-family: 'Bangla';">নাগরিক পোর্টাল</h2>
                        </div>
                        <div class="form">
                            <div id="loginError-message">
                                <div><?php if(isset($_SESSION["login_first_msg"])){echo $_SESSION["login_first_msg"];} ?></div>
                            </div>
                            <div class="form-field-gap">
                                <label>আইডি নাম্বার দিন</label>
                                <input type="text" name="userName" id="userName" autofocus required>
                            </div>
                            <div class="form-field-gap">
                                <label>পাসওয়ার্ড দিন</label>
                                <input type="password" name="loginPass" id="loginPass" required>
                            </div>
                            <button type="submit" name="login-btn" id="login-btn"><i class="fa fa-sign-in"></i> প্রবেশ করুন</button>
                            <img style="display: none" src="assets/images/loader.gif" width="28" />
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>


    <script type="text/javascript" src="assets/js/jquery.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            $("#login-btn").click(function () {
                var userName = $("#userName").val().trim();
                var loginPass = $("#loginPass").val().trim();

                if (userName != "" && loginPass != "") {
                    $.ajax({
                        url: 'script/user_login_script',
                        type: 'POST',
                        data: {
                            userName: userName,
                            loginPass: loginPass
                        },
                        beforeSend: function () {
                            $("#login-btn").html(
                                '<img src="assets/images/loader.gif" width="30" />');
                        },
                        success: function (response) {
                            if (response == 1) {
                                $("#login-btn").html(
                                    '<img src="assets/images/loader.gif" width="30" />');
                                setTimeout(' window.location.href = "citizen/dashboard"; ', 1000);
                            } else {
                                $("#loginError-message").html(response);
                                $("#login-btn").html('<i class="fa fa-sign-in"></i> প্রবেশ করুন');
                            }
                        }
                    });
                } else {
                    $("#loginError-message").html(
                        '<div class="error_msg">সবগুলো তথ্য সঠিকভাবে দিন!</div>');
                }
            });

        });
    </script>


    </body>
    </html>


<?php
unset($_SESSION["login_first_msg"]);
?>