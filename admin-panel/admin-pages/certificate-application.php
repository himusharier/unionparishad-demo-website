
<?php
    if ($_SESSION['admin_role'] != "admin") {
        echo "<script type='text/javascript'> document.location = 'admin/dashboard'; </script>";
    }
?>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>


<script>
    document.title = 'আবেদনকৃত সনদপত্র - ইউনিয়ন পরিষদ';
</script>


<script src="assets/js/jspdf.min.js"></script>
<script src="assets/js/html2canvas.js"></script>
<script>

    function getPDF(){
        $("#print-main-div").show();
        var HTML_Width = $("#print-main-div").width();
        var HTML_Height = $("#print-main-div").height();
        var top_left_margin = 25;
        var PDF_Width = HTML_Width+(top_left_margin*2);
        var PDF_Height = (PDF_Width*1.2)+(top_left_margin*2);
        var canvas_image_width = HTML_Width;
        var canvas_image_height = HTML_Height;

        var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;


        html2canvas($("#print-main-div")[0],{allowTaint:true}).then(function(canvas) {
            canvas.getContext('2d');

            console.log(canvas.height+"  "+canvas.width);


            var imgData = canvas.toDataURL("image/jpeg", 1.0);
            var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
            pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);


            for (var i = 1; i <= totalPDFPages; i++) {
                pdf.addPage(PDF_Width, PDF_Height);
                pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
            }

            pdf.save("certificate-download.pdf");
            $("#print-main-div").hide();

        });
    };


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
    .error_msg {
        text-align: center;
        background-color: rgba(255, 57, 57, 0.10);
        color: red;
        padding: 25px 20px;
        border-radius: 4px;
        border: 1px solid red;
        font-size: 16px;
        font-family: 'Bangla';
        max-width: 300px;
        margin: 20px auto;
    }
    input[readonly] {
        width: 100%;
        height: 35px;
        outline: none;
        border: 1px solid #cccccc;
        padding: 0px 5px;
        /*font-weight: 600;*/
        font-size: 16px;
        color: #333;
        border-radius: 4px;
        background-color: #eeeeee;
    }
    .formApplyError {
        background-color: #ff3333;
        padding: 5px;
        font-size: 18px;
        text-align: center;
        color: #FFFFFF;
        border-radius: 2px;
        font-family: 'Bangla';
    }
    .paymentDone {
        background-color: #23b14d;
        padding: 5px;
        font-size: 12px;
        color: #FFFFFF;
        font-family: Arial, Helvetica, sans-serif;
        border-radius: 2px;
        width: 60px;
        display: block;
        text-align: center;
    }
    .paymentDue {
        background-color: #ff3333;
        padding: 5px;
        font-size: 12px;
        color: #FFFFFF;
        font-family: Arial, Helvetica, sans-serif;
        border-radius: 2px;
        width: 60px;
        display: block;
        text-align: center;
    }
    .notify {
        border: 1px solid rgba(255, 0, 0, 0.75);
        width: 100%;
        text-align: center;
        margin-top: 10px;
        background-color: rgba(255, 57, 57, 0.16);
        border-radius: 4px;
        color: rgba(255, 0, 0, 0.75);
        padding: 10px 0;
        font-size: 18px;
        font-family: 'Bangla';
    }

    .print-header {
        display: flex;
        justify-content: center;
        font-family: 'Bangla';
        font-size: 26px;
        font-weight: bold;
        padding: 10px 0;
        margin-top: 20px;
    }
    .print-header-top {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    .print-header-top p {
        width: 350px;
        font-family: 'Bangla';
        font-size: 16px;
        padding: 0;
        margin: 0;
    }
    .print-header-top p:last-child {
        text-align: right;
    }

    #print-main-div {
        margin: 0;
        padding: 5px;
        background-image: url(assets/images/watermark.png);
        background-repeat: no-repeat;
        background-position: center;
        background-size: auto;
        height: 100%;
        width: 1200px;
        border: 3px solid #1e2039;
        text-align: justify;
        display: none;
    }

    .certificateTable table{
        width: 100%;
        border-spacing: 0;
        margin: 0 auto;
        font-family: 'Bangla';
        table-layout: fixed;
        width: 900px;
    }

    .certificateTable table td,table th{
        padding: 7px 5px;
        text-align: left;
        width: 20%;
        text-align: center;
        border: 1px solid #5e5e5e;
        font-size: 20px;
    }

</style>

<div class="content-body-main-div">

    <p class="page-direction"><i class="fa fa-link"></i> নাগরিক সেবা / আবেদনকৃত সনদপত্র /</p>

    <div class="admin-dashboard-content-div">
        <h2 style="font-family:'Bangla';color: #5e5e5e;border-bottom:1px solid #5e5e5e;">আবেদনকৃত সনদপত্রঃ</h2>


        <div class="main-box-div main-nav-box">
            <nav class="navbar">
                <ul>
                    <?php

                    $sqlc = "SELECT * FROM character_certificate_apply WHERE (applyType = 'সাধারণ' AND paymentStatus = 'Paid' AND status = 'Requested') ORDER BY id DESC";
                    $resultc = mysqli_query($db, $sqlc);
                    $countc = mysqli_num_rows($resultc);

                    $sqlu = "SELECT * FROM unmarried_certificate_apply WHERE (applyType = 'সাধারণ' AND paymentStatus = 'Paid' AND status = 'Requested') ORDER BY id DESC";
                    $resultu = mysqli_query($db, $sqlu);
                    $countu = mysqli_num_rows($resultu);

                    $sqld = "SELECT * FROM death_certificate_apply WHERE (applyType = 'সাধারণ' AND paymentStatus = 'Paid' AND status = 'Requested') ORDER BY id DESC";
                    $resultd = mysqli_query($db, $sqld);
                    $countd = mysqli_num_rows($resultd);

                    $sqlb = "SELECT * FROM burial_certificate_apply WHERE (applyType = 'সাধারণ' AND paymentStatus = 'Paid' AND status = 'Requested') ORDER BY id DESC";
                    $resultb = mysqli_query($db, $sqlb);
                    $countb = mysqli_num_rows($resultb);

                    $sqll = "SELECT * FROM legacy_certificate_apply WHERE (applyType = 'সাধারণ' AND paymentStatus = 'Paid' AND status = 'Requested') ORDER BY id DESC";
                    $resultl = mysqli_query($db, $sqll);
                    $countl = mysqli_num_rows($resultl);

                    $sqlr = "SELECT * FROM remarriage_certificate_apply WHERE (applyType = 'সাধারণ' AND paymentStatus = 'Paid' AND status = 'Requested') ORDER BY id DESC";
                    $resultr = mysqli_query($db, $sqlr);
                    $countr = mysqli_num_rows($resultr);

                    $totalCounterG = ($countc + $countu + $countd + $countb + $countl + $countr);
                    ?>
                    <li><a onclick="LoaderShow()" class="<?php if($_GET['subPage']=='general') {echo 'active-li';}?>" href="admin/certificate-application-general">সাধারণ আবেদন <?php if($totalCounterG > 0){echo "<b>($totalCounterG)</b>";} ?></a></li>

                    <?php

                    $sqlc = "SELECT * FROM character_certificate_apply WHERE (applyType = 'জরুরী' AND paymentStatus = 'Paid' AND status = 'Requested') ORDER BY id DESC";
                    $resultc = mysqli_query($db, $sqlc);
                    $countc = mysqli_num_rows($resultc);

                    $sqlu = "SELECT * FROM unmarried_certificate_apply WHERE (applyType = 'জরুরী' AND paymentStatus = 'Paid' AND status = 'Requested') ORDER BY id DESC";
                    $resultu = mysqli_query($db, $sqlu);
                    $countu = mysqli_num_rows($resultu);

                    $sqld = "SELECT * FROM death_certificate_apply WHERE (applyType = 'জরুরী' AND paymentStatus = 'Paid' AND status = 'Requested') ORDER BY id DESC";
                    $resultd = mysqli_query($db, $sqld);
                    $countd = mysqli_num_rows($resultd);

                    $sqlb = "SELECT * FROM burial_certificate_apply WHERE (applyType = 'জরুরী' AND paymentStatus = 'Paid' AND status = 'Requested') ORDER BY id DESC";
                    $resultb = mysqli_query($db, $sqlb);
                    $countb = mysqli_num_rows($resultb);

                    $sqll = "SELECT * FROM legacy_certificate_apply WHERE (applyType = 'জরুরী' AND paymentStatus = 'Paid' AND status = 'Requested') ORDER BY id DESC";
                    $resultl = mysqli_query($db, $sqll);
                    $countl = mysqli_num_rows($resultl);

                    $sqlr = "SELECT * FROM remarriage_certificate_apply WHERE (applyType = 'জরুরী' AND paymentStatus = 'Paid' AND status = 'Requested') ORDER BY id DESC";
                    $resultr = mysqli_query($db, $sqlr);
                    $countr = mysqli_num_rows($resultr);

                    $totalCounterU = ($countc + $countu + $countd + $countb + $countl + $countr);
                    ?>
                    <li><a onclick="LoaderShow()" class="<?php if($_GET['subPage']=='urgent') {echo 'active-li';}?>" href="admin/certificate-application-urgent">জরুরী আবেদন <?php if($totalCounterU > 0){echo "<b>($totalCounterU)</b>";} ?></a></li>

                    <?php
                    $sqlc = "SELECT * FROM character_certificate_apply WHERE (paymentStatus = 'Paid' AND status != 'Requested') ORDER BY id DESC";
                    $resultc = mysqli_query($db, $sqlc);
                    $countc = mysqli_num_rows($resultc);

                    $sqlu = "SELECT * FROM unmarried_certificate_apply WHERE (paymentStatus = 'Paid' AND status != 'Requested') ORDER BY id DESC";
                    $resultu = mysqli_query($db, $sqlu);
                    $countu = mysqli_num_rows($resultu);

                    $sqld = "SELECT * FROM death_certificate_apply WHERE (paymentStatus = 'Paid' AND status != 'Requested') ORDER BY id DESC";
                    $resultd = mysqli_query($db, $sqld);
                    $countd = mysqli_num_rows($resultd);

                    $sqlb = "SELECT * FROM burial_certificate_apply WHERE (paymentStatus = 'Paid' AND status != 'Requested') ORDER BY id DESC";
                    $resultb = mysqli_query($db, $sqlb);
                    $countb = mysqli_num_rows($resultb);

                    $sqll = "SELECT * FROM legacy_certificate_apply WHERE (paymentStatus = 'Paid' AND status != 'Requested') ORDER BY id DESC";
                    $resultl = mysqli_query($db, $sqll);
                    $countl = mysqli_num_rows($resultl);

                    $sqlr = "SELECT * FROM remarriage_certificate_apply WHERE (paymentStatus = 'Paid' AND status != 'Requested') ORDER BY id DESC";
                    $resultr = mysqli_query($db, $sqlr);
                    $countr = mysqli_num_rows($resultr);

                    $totalCounterA = ($countc + $countu + $countd + $countb + $countl + $countr);
                    ?>

                    <li><a onclick="LoaderShow()" class="<?php if($_GET['subPage']=='archive') {echo 'active-li';}?>" href="admin/certificate-application-archive">আর্কাইভ <?php if($totalCounterA > 0){echo "<b>($totalCounterA)</b>";} ?></a></li>
                </ul>
            </nav>
        </div>

        <br/>

        <!-- # add additional pages here -->

            <?php
            if($_GET["subPage"] == "general") {
                require ("certificate-application-general.php");
            } elseif ($_GET["subPage"] == "urgent") {
                require("certificate-application-urgent.php");
            } elseif ($_GET["subPage"] == "archive") {
                require("certificate-application-archive.php");
            } else {
                require ("certificate-application-general.php");
            }
            ?>



    </div>

</div>




<script src="assets/js/jquery.js"></script>


