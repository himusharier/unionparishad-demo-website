
<?php

$user_roleChk = $_SESSION['user_role'];

if (empty($user_roleChk)) {
    echo "<script type='text/javascript'> document.location = 'citizen/dashboard'; </script>";
}

?>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>


<script>
    document.title = 'ট্রেড লাইসেন্স আবেদন - ইউনিয়ন পরিষদ';
</script>

<style>
    .responstable table {
        border-collapse: collapse;
        width: 100%;
    }

    .responstable td, .responstable th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        font-family: 'Bangla', arial, sans-serif !important;
        font-size: 16px !important;
    }
    .responstable th {
        background-color: #f5f5f5;
    }
</style>

<div class="content-body-main-div">

    <p class="page-direction"><i class="fa fa-link"></i> নাগরিক পোর্টাল / ট্রেড লাইসেন্স আবেদন /</p>

    <div class="admin-dashboard-content-div">

        <h2 style="font-family:'Bangla';color: #5e5e5e;border-bottom:1px solid #5e5e5e;">ট্রেড লাইসেন্স আবেদনপত্রঃ</h2>

        <p style="font-size: 36px;padding: 20px;color: #cccccc;text-align: center;margin-top: 100px;"><i class="fa fa-warning"></i> কাজ চলছে...</p>

    </div>

</div>
