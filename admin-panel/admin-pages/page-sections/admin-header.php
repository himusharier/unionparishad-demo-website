<?php

include "../config/database-connection.php";

$sql_holding = "SELECT * FROM house_holding_database";
$result_holding = mysqli_query($db, $sql_holding);
$count_holding = mysqli_num_rows($result_holding);


?>

<div class="header-main-container">
    <div class="header-container">
        <div class="header-section-left">
            <img onclick="toggleSidebar()" class="menu-icon" src="assets/images/menu-icon.png" alt="menu icon" height="33">
            <img src="assets/images/logo-site.jpg" alt="site logo" height="32">
            <a href="admin/dashboard" style="text-decoration: none; color: #FFFFFF; font-size: 24px; font-family: 'Bangla';">ইউনিয়ন পরিষদ</a>
        </div>

        <div class="header-section-right-icon">

        </div>
        <div class="header-section-right profile-dropdown">
            <div class="profile-dropbtn right-profile-container" onclick="profileDropdown()">
                <a class="profile-dropbtn name"><img class="profile-dropbtn" src="assets/images/profile-more.png" alt="more icon" /></a>
                <img class="profile-dropbtn" src="assets/images/user.jpg" alt="admin profile pic" width="30" height="30">
            </div>
            <div id="profile-idDropdown" class="profile-dropdown-content profile-width">
                <div class="profile-dropdown-content-div">
                    <div class="main-profile-menu">
                        <p style="text-align: left; font-weight: 600; color: #007CC7; font-size: 16px; margin: 0; padding: 10px 0;">
                            <a><i class="fa fa-cog"></i> <?php echo $rowChk['full_name']; ?></a>
                        </p>
                        <div>
                            <a onclick="LoaderShow()" href="admin/logout" style="color: #ff3333;" class="underline-hover"><i class="fa fa-sign-out"></i> Log Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>