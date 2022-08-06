<div class="side-bar sidebar-container-div" id="sidebar-container-div">
    <div class="menu">
        <div class="item"><a id="<?php if($_GET['menuId']=='dashboard') {echo 'page-active';}?>" onclick="LoaderShow()" href="citizen/dashboard"><i class="fa fa-dashboard"></i> ড্যাশবোর্ড</a></div>
        <?php
        if ($_SESSION['user_role'] == "house-holding") {
        ?>
        <div class="item"><a id="<?php if($_GET['menuId']=='holding-tax') {echo 'page-active';}?>" onclick="LoaderShow()" href="citizen/holding-tax"><i class="fa fa-dashboard"></i> হোল্ডিং ট্যাক্স</a></div>
        <div class="item"><a id="<?php if($_GET['menuId']=='character-certificate') {echo 'page-active';}?>" onclick="LoaderShow()" href="citizen/character-certificate"><i class="fa fa-dashboard"></i> চারিত্রিক সনদ</a></div>
        <div class="item"><a id="<?php if($_GET['menuId']=='unmarried-certificate') {echo 'page-active';}?>" onclick="LoaderShow()" href="citizen/unmarried-certificate"><i class="fa fa-dashboard"></i> অবিবাহিত সনদ</a></div>
        <div class="item"><a id="<?php if($_GET['menuId']=='death-certificate') {echo 'page-active';}?>" onclick="LoaderShow()" href="citizen/death-certificate"><i class="fa fa-dashboard"></i> মৃত্যু তারিখ সনদ</a></div>
        <div class="item"><a id="<?php if($_GET['menuId']=='burial-certificate') {echo 'page-active';}?>" onclick="LoaderShow()" href="citizen/burial-certificate"><i class="fa fa-dashboard"></i> দাফন সনদ</a></div>
        <div class="item"><a id="<?php if($_GET['menuId']=='legacy-certificate') {echo 'page-active';}?>" onclick="LoaderShow()" href="citizen/legacy-certificate"><i class="fa fa-dashboard"></i> ওয়ারিশনামা সনদ</a></div>
        <div class="item"><a id="<?php if($_GET['menuId']=='remarriage-certificate') {echo 'page-active';}?>" onclick="LoaderShow()" href="citizen/remarriage-certificate"><i class="fa fa-dashboard"></i> পুনঃবিবাহ না হওয়া সনদ</a></div>
        <div class="item"><a id="<?php if($_GET['menuId']=='trade-licence-new-application') {echo 'page-active';}?>" onclick="LoaderShow()" href="citizen/trade-licence-new-application"><i class="fa fa-dashboard"></i> ট্রেড লাইসেন্স আবেদন</a></div>
        <?php
        }
        ?>

        <?php
        if ($_SESSION['user_role'] == "trade-license") {
        ?>
        <div class="item"><a id="<?php if($_GET['menuId']=='trade-licence-renew') {echo 'page-active';}?>" onclick="LoaderShow()" href="citizen/trade-licence-renew"><i class="fa fa-dashboard"></i> ট্রেড লাইসেন্স নবায়ন</a></div>
        <div class="item"><a id="<?php if($_GET['menuId']=='trade-licence-new-application') {echo 'page-active';}?>" onclick="LoaderShow()" href="citizen/trade-licence-new-application"><i class="fa fa-dashboard"></i> নতুন ট্রেড লাইসেন্স</a></div>
        <?php
        }
        ?>

    </div>
</div>