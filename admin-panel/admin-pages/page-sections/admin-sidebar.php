
<?php

$sqlc = "SELECT * FROM character_certificate_apply WHERE (paymentStatus = 'Paid' AND status = 'Requested')";
$resultc = mysqli_query($db, $sqlc);
$countc = mysqli_num_rows($resultc);

$sqlu = "SELECT * FROM unmarried_certificate_apply WHERE (paymentStatus = 'Paid' AND status = 'Requested')";
$resultu = mysqli_query($db, $sqlu);
$countu = mysqli_num_rows($resultu);

$sqld = "SELECT * FROM death_certificate_apply WHERE (paymentStatus = 'Paid' AND status = 'Requested')";
$resultd = mysqli_query($db, $sqld);
$countd = mysqli_num_rows($resultd);

$sqlb = "SELECT * FROM burial_certificate_apply WHERE (paymentStatus = 'Paid' AND status = 'Requested')";
$resultb = mysqli_query($db, $sqlb);
$countb = mysqli_num_rows($resultb);

$sqll = "SELECT * FROM legacy_certificate_apply WHERE (paymentStatus = 'Paid' AND status = 'Requested')";
$resultl = mysqli_query($db, $sqll);
$countl = mysqli_num_rows($resultl);

$sqlr = "SELECT * FROM remarriage_certificate_apply WHERE (paymentStatus = 'Paid' AND status = 'Requested')";
$resultr = mysqli_query($db, $sqlr);
$countr = mysqli_num_rows($resultr);

$totalCounter = ($countc + $countu + $countd + $countb + $countl + $countr);
?>


<div class="side-bar sidebar-container-div" id="sidebar-container-div">
    <div class="menu">
        <div class="item"><a id="<?php if($_GET['pageId']=='dashboard') {echo 'page-active';}?>" onclick="LoaderShow()" href="admin/dashboard"><i class="fa fa-dashboard"></i> ড্যাশবোর্ড</a></div>
        <div class="item">
            <a class="sub-btn"><i class="fa fa-sitemap"></i> বসত বাড়ী হোল্ডিং <i class="fa fa-angle-down"></i></a>
            <div class="sub-menu">
                <a id="<?php if($_GET['pageId']=='house-holding-add') {echo 'page-active';}?>" class="sub-item" onClick="LoaderShow()" href="admin/add-house-holding"><i class="fa fa-plus"></i> নতুন তথ্য যোগ করুন</a>
                <a id="<?php if($_GET['pageId']=='house-holding-list') {echo 'page-active';}?><?php if($_GET['pageId']=='house-holding-data-update') {echo 'page-active';}?>" onclick="LoaderShow()" class="sub-item" href="admin/list-house-holding"><i class="fa fa-list"></i> তথ্য তালিকা দেখুন</a>
            </div>
        </div>
        <div class="item">
            <a class="sub-btn"><i class="fa fa-sitemap"></i> ট্রেড লাইসেন্স <i class="fa fa-angle-down"></i></a>
            <div class="sub-menu">
                <a id="<?php if($_GET['pageId']=='trade-lic-add') {echo 'page-active';}?>" class="sub-item" onClick="LoaderShow()" href="admin/add-trade-license"><i class="fa fa-plus"></i> নতুন তথ্য যোগ করুন</a>
                <a id="<?php if($_GET['pageId']=='trade-lic-list') {echo 'page-active';}?><?php if($_GET['pageId']=='trade-lic-data-update') {echo 'page-active';}?>" onclick="LoaderShow()" class="sub-item" id="list-trade-licence" href="admin/list-trade-license"><i class="fa fa-list"></i> তথ্য তালিকা দেখুন</a>
                <?php
                if ($user_role == "admin") {
                ?>
                <a id="<?php if($_GET['pageId']=='trade-licence-new-application') {echo 'page-active';}?>" onclick="LoaderShow()" class="sub-item" id="list-trade-licence" href="admin/trade-licence-new-application"><i class="fa fa-drivers-license-o"></i> লাইসেন্স আবেদন</a>
                <?php
                }
                ?>
            </div>
        </div>

        <?php
        if ($user_role == "admin") {
        ?>
        <div class="item">
            <a class="sub-btn"><i class="fa fa-sitemap"></i> নাগরিক সেবা <i class="fa fa-angle-down"></i></a>
            <div class="sub-menu">
                <a class="sub-item" id="<?php if($_GET['pageId']=='certificate-application') {echo 'page-active';}?>" href="admin/certificate-application" onClick="LoaderShow()"><i class="fa fa-gear"></i> আবেদনকৃত সনদপত্র <?php if ($totalCounter > 0){ echo "<b>($totalCounter)</b>";} ?></a>
                <a class="sub-item" id="<?php if($_GET['pageId']=='certificate-verify') {echo 'page-active';}?>" href="admin/certificate-verify" onClick="LoaderShow()"><i class="fa fa-gear"></i> সনদপত্র ভেরিফাই</a>
                <a class="sub-item" id="<?php if($_GET['pageId']=='allowance-given-data') {echo 'page-active';}?>" href="admin/allowance-given-data" onClick="LoaderShow()"><i class="fa fa-gear"></i> ভাতা প্রেরণ</a>
                <a class="sub-item" id="<?php if($_GET['pageId']=='renew-house-holding') {echo 'page-active';}?>" href="admin/renew-house-holding" onClick="LoaderShow()"><i class="fa fa-gear"></i> হোল্ডিং নবায়ন</a>
                <a class="sub-item" id="<?php if($_GET['pageId']=='renew-trade-licence') {echo 'page-active';}?>" href="admin/renew-trade-licence" onClick="LoaderShow()"><i class="fa fa-gear"></i> ট্রেড লাইসেন্স নবায়ন</a>
            </div>
        </div>
        <?php
        }
        ?>

    </div>
</div>