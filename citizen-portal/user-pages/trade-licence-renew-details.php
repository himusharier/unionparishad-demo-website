
<?php
if ($_SESSION['user_role'] != "trade-license") {
    echo "<script type='text/javascript'> document.location = 'citizen/dashboard'; </script>";
}
?>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php
header('Cache-control: no-cache, must-revalidate, max-age=0');

if (isset($_POST['linkedForm']) && isset($_POST['renewTradeID'])) {
    $_SESSION['linkedForm'] = $_POST['linkedForm'];
    $_SESSION['renewTradeID'] = $_POST['renewTradeID'];
}

if (!empty($_SESSION['linkedForm']) && !empty($_SESSION['renewTradeID'])) {
    $linkedForm = $_SESSION['linkedForm'];
    $renewTradeID = $_SESSION['renewTradeID'];
} else {
    echo "<script type='text/javascript'> document.location = 'citizen/trade-licence-renew'; </script>";
    die();
}



if($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['payment-done'])) {

        $lastRenewDate = $_POST['renewEndDate'];

        $paymentUpdate = "UPDATE renew_trade_licence_database SET paymentStatus='Paid' WHERE (linkedForm='$linkedForm' AND renewTradeID='$renewTradeID')";
        if (mysqli_query($db, $paymentUpdate)) {


            $paymentUpdateM = "UPDATE trade_license_database SET lastRenew='$lastRenewDate' WHERE (formID='$linkedForm')";
            if (mysqli_query($db, $paymentUpdateM)) {
                echo "<script type='text/javascript'> document.location = 'citizen/trade-licence-renew-details'; </script>";
            }


        }
    }

}



function banglaNumber($englishToBangla) {
    $englishNum=array("0","1","2","3","4","5",'6',"7","8","9","-");
    $banglaNum=array("০","১","২","৩","৪","৫",'৬',"৭","৮","৯","/");
    return str_replace($englishNum,$banglaNum,$englishToBangla);
}

?>

<script src="assets/js/jspdf.min.js"></script>
<script src="assets/js/html2canvas.js"></script>

<script>

    function getPDF(){
        $("#print-main-div-holding").show();
        var HTML_Width = $("#print-main-div-holding").width();
        var HTML_Height = $("#print-main-div-holding").height();
        var top_left_margin = 25;
        var PDF_Width = HTML_Width+(top_left_margin*2);
        var PDF_Height = (PDF_Width*1.2)+(top_left_margin*2);
        var canvas_image_width = HTML_Width;
        var canvas_image_height = HTML_Height;

        var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;


        html2canvas($("#print-main-div-holding")[0],{allowTaint:true}).then(function(canvas) {
            canvas.getContext('2d');

            console.log(canvas.height+"  "+canvas.width);


            var imgData = canvas.toDataURL("image/jpeg", 1.0);
            var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
            pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);


            for (var i = 1; i <= totalPDFPages; i++) {
                pdf.addPage(PDF_Width, PDF_Height);
                pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
            }

            pdf.save("<?php echo "payment-$renewTradeID" ?>.pdf");
            $("#print-main-div-holding").hide();

        });
    };


</script>

<script>
    document.title = 'ট্রেড লাইসেন্স নবায়ন - ইউনিয়ন পরিষদ';
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
    }
</style>

<div class="content-body-main-div">

    <p class="page-direction"><i class="fa fa-link"></i> নাগরিক পোর্টাল / ট্রেড লাইসেন্স নবায়ন / বিস্তারিত /</p>

    <div class="admin-dashboard-content-div">

        <h2 style="font-family:'Bangla';color: #5e5e5e;border-bottom:1px solid #5e5e5e;">ট্রেড লাইসেন্স নবায়ন বিস্তারিতঃ</h2>
        <?php
        $sqlr = "SELECT * FROM renew_trade_licence_database WHERE (linkedForm = '$linkedForm' AND renewTradeID = '$renewTradeID') ORDER BY id ASC";
        $resultr = mysqli_query($db, $sqlr);
        $countr = mysqli_num_rows($resultr);
        $rowr = mysqli_fetch_array($resultr, MYSQLI_ASSOC);

        ?>

        <?php
        if ($rowr['paymentStatus'] == 'Unpaid') {
            ?>
            <div class="notify">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="renewEndDate" value="<?php echo $rowr['renewEndDate']; ?>">
                    <p>ট্রেড লাইসেন্স নবায়ন বকেয়া পরিশোধ করতে <b style="font-size: 20px;"><?php echo banglaNumber($rowr['totalAmount']); ?></b> টাকা পেমেন্ট করুন।</p>
                    <button onclick='LoaderShow()' type="submit" name="payment-done" style="font-size: 18px;width: 150px;padding: 5px;font-family: 'Bangla';margin-bottom: 0;" class="cancel-btn">পেমেন্ট করুন!</button>
                </form>
            </div>
            <br/>
            <?php
        }
        ?>
        <br/>
        <table class="responstable">
            <tbody>
            <?php
            if ($countr == 1) {
            ?>
            <tr>
                <td>নাম</td>
                <td><?php echo $rowr['fullName']; ?></td>
            </tr>
            <tr>
                <td>মোবাইল নাম্বার</td>
                <td><?php echo $rowr['mobile']; ?></td>
            </tr>
            <tr>
                <td>ট্রেড লাইসেন্স নং</td>
                <td><?php echo $rowr['tradeLicNo']; ?></td>
            </tr>
            <tr>
                <td>নবায়নের তারিখ</td>
                <td>
                    <?php
                    $bDate1=$rowr['renewStartDate'];
                    $format_bDate1=date("d-m-Y",strtotime($bDate1));
                    $format_bDate1 = banglaNumber($format_bDate1);
                    $bDate2=$rowr['renewEndDate'];
                    $format_bDate2=date("d-m-Y",strtotime($bDate2));
                    $format_bDate2 = banglaNumber($format_bDate2);
                    echo "$format_bDate1 হইতে $format_bDate2";
                    ?>
                </td>
            </tr>
            <tr>
                <td>ট্রেড লাইসেন্স ফি</td>
                <td><?php echo banglaNumber($rowr['tradeLicFee']); ?> টাকা</td>
            </tr>
            <tr>
                <td>সাইনবোর্ড কর</td>
                <td><?php echo banglaNumber($rowr['signboardTax']); ?> টাকা</td>
            </tr>
            <tr>
                <td>ভ্যাট</td>
                <td><?php echo banglaNumber($rowr['totalTax']); ?> টাকা</td>
            </tr>
            <tr>
                <td>মোট টাকা</td>
                <td><?php echo banglaNumber($rowr['totalAmount']); ?> টাকা</td>
            </tr>
            <tr>
                <td>পেমেন্ট স্ট্যাটাস</td>
                <td><a style="display: inline-block;" class="<?php echo(($rowr['paymentStatus'] == 'Paid' ? 'paymentDone' : 'paymentDue')) ?>"><?php echo $rowr['paymentStatus'] ?></a></td>
            </tr>
            <tr>
                <td>পেমেন্ট রিসিট ডাউনলোড</td>
                <td>
                    <?php
                    if ($rowr['paymentStatus'] == 'Unpaid') {
                        echo "---";
                    }
                    if ($rowr['paymentStatus'] == 'Paid') {
                        echo "<button onclick='getPDF()' class='edit-window' style='cursor: pointer; color: #23b14d; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'><i class='fa fa-download'></i> ডাউনলোড করুন</button>";
                    }
                    ?>
                </td>
            </tr>
            <?php
            } else {
                echo "<p style='font-size: 16px;font-family: Bangla;text-align: left;padding: 20px 0;font-style: italic;color: #ff3333;'><i class='fa fa-warning'></i> কোনো তথ্য পাওয়া যায় নি!</p>";
            }
            ?>
            </tbody>
        </table>


    </div>


<br/><br/>

    <?php

    $date = date("d/m/Y");

    if ($rowr['paymentStatus'] == 'Paid') {

    ?>

        <style>
            #print-main-div-holding {
                margin: 0;
                padding: 10px;
                background-image: url(assets/images/watermark.png);
                background-repeat: no-repeat;
                background-position: center;
                background-size: auto;
                height: 100%;
                width: 1200px;
                height: 1500px;
                text-align: justify;
                display: none;
            }
            .print-header {
                display: flex;
                justify-content: left;
                font-family: 'Bangla';
                font-size: 26px;
                font-weight: bold;
                border-bottom: 1px solid #5e5e5e;
                padding: 10px 0;
                margin-top: 10px;
            }
            .print-header-bottom {
                display: flex;
                justify-content: space-between;
                margin-bottom: 10px;
            }
            .print-header-bottom p {
                width: 300px;
                font-family: 'Bangla';
                font-size: 14px;
                padding: 0;
                margin: 0;
            }
            .print-header-bottom p:last-child {
                text-align: right;
            }

            .responstable-print table {
                border-collapse: collapse;
                width: 100%;
            }
            .responstable-print td, .responstable-print th {
                border: 1px solid #5e5e5e;
                text-align: left;
                padding: 8px;
                font-family: 'Bangla', arial, sans-serif !important;
                font-size: 18px !important;
            }
        </style>


    <div id="print-main-div-holding">
        <div class='print-header'>
            <img src='assets/images/logo-site.png' height='110' />
            <div style='margin-left:25%;margin-bottom: 20px;'>
                <p style='font-size:32px;font-weight:bold;'>ইউনিয়ন পরিষদ<br/>
                <div style='font-size:14px;font-weight:400;text-align:center;'>
                    <a style='line-height: 20px;display:block;'>স্থাপিতঃ xxxx ইং</a>
                    <a style='line-height: 20px;display:block;'>ফোনঃ xxxx-xxxxxx</a>
                </div>
                </p>
            </div>
        </div>
        <br/>
        <div class='print-header-bottom'>
            <p>স্মারক নংঃ ইউ/পরি/ট্রে/লা/ন/পে/রি/<?php echo banglaNumber($rowr['renewTradeID']); ?></p>
            <p>তারিখঃ <?php echo banglaNumber($date); ?> ইং</p>
        </div>

        <p style="text-align: center;margin-top: 150px;color: #1e2039;font-size: 36px;font-weight: bold;">ট্রেড লাইসেন্স নবায়ন পেমেন্ট রিসিট</p>

        <div style="width: 900px;margin: 100px auto;">
            <table class="responstable-print">
                <tbody>
                    <tr>
                        <td>লাইসেন্স কার্ড নাম্বার</td>
                        <td><?php echo $rowChk['idNumber']; ?></td>
                    </tr>
                    <tr>
                        <td>নাম</td>
                        <td><?php echo $rowr['fullName']; ?></td>
                    </tr>
                    <tr>
                        <td>মোবাইল নাম্বার</td>
                        <td><?php echo $rowr['mobile']; ?></td>
                    </tr>
                    <tr>
                        <td>ট্রেড লাইসেন্স নং</td>
                        <td><?php echo $rowr['tradeLicNo']; ?></td>
                    </tr>
                    <tr>
                        <td>নবায়নের তারিখ</td>
                        <td>
                            <?php
                            $bDate1=$rowr['renewStartDate'];
                            $format_bDate1=date("d-m-Y",strtotime($bDate1));
                            $format_bDate1 = banglaNumber($format_bDate1);
                            $bDate2=$rowr['renewEndDate'];
                            $format_bDate2=date("d-m-Y",strtotime($bDate2));
                            $format_bDate2 = banglaNumber($format_bDate2);
                            echo "$format_bDate1 হইতে $format_bDate2";
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>ট্রেড লাইসেন্স ফি</td>
                        <td><?php echo banglaNumber($rowr['tradeLicFee']); ?> টাকা</td>
                    </tr>
                    <tr>
                        <td>সাইনবোর্ড কর</td>
                        <td><?php echo banglaNumber($rowr['signboardTax']); ?> টাকা</td>
                    </tr>
                    <tr>
                        <td>ভ্যাট</td>
                        <td><?php echo banglaNumber($rowr['totalTax']); ?> টাকা</td>
                    </tr>
                    <tr>
                        <td>মোট টাকা</td>
                        <td><?php echo banglaNumber($rowr['totalAmount']); ?> টাকা</td>
                    </tr>
                    <tr>
                        <td>পেমেন্ট স্ট্যাটাস</td>
                        <td><a style="display: inline-block;font-size: 18px;" class="<?php echo(($rowr['paymentStatus'] == 'Paid' ? 'paymentDone' : 'paymentDue')) ?>"><?php echo $rowr['paymentStatus'] ?></a></td>
                    </tr>

                </tbody>
            </table>
        </div>


    </div>

    <?php
    }
    ?>



</div>
