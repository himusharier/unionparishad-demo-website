<?php
require('bkend-call/admin-afterLogin-checks.php');
include('config/canonical-link.php');

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>এডমিন প্যানেল - ইউনিয়ন পরিষদ</title>
    <?php
    require ('config/og-tags.php');
    ?>
    <base href="../" target="_self">
    <link rel="icon" href="assets/images/favicon.png">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <script type="application/javascript" src="assets/js/jquery.js"></script>
    <?php
    echo '<link rel="stylesheet" type="text/css" href="assets/css/admin-main-style.css?version=' . filemtime('assets/css/admin-main-style.css') . '" />';
    ?>
</head>

<body>

<?php
require ('admin-pages/page-sections/admin-header.php');
?>


<div class="main-body-container-div">

<?php
require ('admin-pages/page-sections/admin-sidebar.php');
?>

    <div class="load-content-here">
        <?php
        if (isset($_GET["pageId"])) {
            $pageId = $_GET["pageId"];
            require ('admin-pages/'.$pageId.'.php');
        } else {
            require ('admin-pages/dashboard.php');
        }
        ?>
    </div>

</div>


<div id="loader" class="loader-wrapper" style="display: none;">
    <img src="assets/images/site-loader.gif" height="60" />
</div>


<script>
    function LoaderShow() {
        $(".loader-wrapper").fadeIn("fast");
    }
</script>

<script>
    function chargue(div, url) {
        $('.load-content-here').hide();
        $('#loader').show();
        $(div).load(url, function (response, status, xhr) {
            if (status == 'success') {
                $('#loader').hide();
                $('.load-content-here').show();
            }
        });
    }
</script>


<script>
    function profileDropdown() {
        document.getElementById("profile-idDropdown").classList.toggle("profile-dropdown-show");
    }
    window.onclick = function (event) {
        if (!event.target.matches('.profile-dropbtn')) {
            var dropdowns = document.getElementsByClassName("profile-dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('profile-dropdown-show')) {
                    openDropdown.classList.remove('profile-dropdown-show');
                }
            }
        }
    }
</script>

<script>
    $(document).ready(function() {
        $('.sub-btn').click(function() {
            $(this).next('.sub-menu').slideToggle();
        });
    });

    function toggleSidebar() {
        var sidebar = document.getElementById("sidebar-container-div");
        if (sidebar.style.display === "block") {
            sidebar.style.display = "none";
            $(".content-body-main-div").css("margin-left","0px");
        } else {
            sidebar.style.display = "block";
            $(".content-body-main-div").css("margin-left","210px");
        }
    }
</script>


</body>

</html>