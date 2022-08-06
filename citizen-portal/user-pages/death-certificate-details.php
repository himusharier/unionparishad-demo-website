
<?php
if ($_SESSION['user_role'] != "house-holding") {
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

if (isset($_POST['linkedForm']) && isset($_POST['certificateID'])) {
    $_SESSION['linkedForm'] = $_POST['linkedForm'];
    $_SESSION['certificateID'] = $_POST['certificateID'];
}

if (!empty($_SESSION['linkedForm']) && !empty($_SESSION['certificateID'])) {
    $linkedForm = $_SESSION['linkedForm'];
    $certificateID = $_SESSION['certificateID'];
} else {
    echo "<script type='text/javascript'> document.location = 'citizen/character-certificate'; </script>";
    die();
}



if($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['payment-done'])) {

        $paymentUpdate = "UPDATE death_certificate_apply SET paymentStatus='Paid' WHERE (linkedForm='$linkedForm' AND certificateID='$certificateID')";
        if (mysqli_query($db, $paymentUpdate)) {
            echo "<script type='text/javascript'> document.location = 'citizen/death-certificate-details'; </script>";
        }
    }

}

?>

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

            pdf.save("<?php echo "certificate-$certificateID" ?>.pdf");
            $("#print-main-div").hide();

        });
    };


</script>

<script>
    document.title = 'মৃত্যু তারিখ সনদ - ইউনিয়ন পরিষদ';
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

    <p class="page-direction"><i class="fa fa-link"></i> নাগরিক পোর্টাল / মৃত্যু তারিখ সনদ / বিস্তারিত /</p>

    <div class="admin-dashboard-content-div">

        <h2 style="font-family:'Bangla';color: #5e5e5e;border-bottom:1px solid #5e5e5e;">মৃত্যু তারিখের সনদ বিস্তারিতঃ</h2>
        <?php
        $sqlr = "SELECT * FROM death_certificate_apply WHERE (linkedForm = '$linkedForm' AND certificateID = '$certificateID') ORDER BY id ASC";
        $resultr = mysqli_query($db, $sqlr);
        $countr = mysqli_num_rows($resultr);
        $rowr = mysqli_fetch_array($resultr, MYSQLI_ASSOC);

        $payBdt = ($rowr['applyType'] == 'জরুরী' ? '৫০০' : '৩০০');
        ?>

        <?php
        if ($rowr['paymentStatus'] == 'Unpaid') {
            ?>
            <div class="notify">
                <form method="post" enctype="multipart/form-data">
                    <p>আবেদন সম্পন্ন করতে <b style="font-size: 20px;"><?php echo $payBdt; ?></b> টাকা পেমেন্ট করুন।</p>
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
                <td>সার্টিফিকেট নাম্বার</td>
                <td>
                    <?php
                    if ($rowr['paymentStatus'] == 'Paid') {
                        echo $rowr['certificateID'];
                    } else {
                        echo "---";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>আবেদনের তারিখ</td>
                <td>
                    <?php
                    $bDate1=$rowr['applyDate'];
                    $format_bDate1=date("d-m-Y",strtotime($bDate1));
                    echo $format_bDate1;
                    ?>
                </td>
            </tr>
            <tr>
                <td>পেমেন্ট স্ট্যাটাস</td>
                <td>
                    <a style="display: inline-block;" class="<?php echo(($rowr['paymentStatus'] == 'Paid' ? 'paymentDone' : 'paymentDue')) ?>"><?php echo $rowr['paymentStatus'] ?></a>
                    <?php
                    /*
                    if ($rowr['paymentStatus'] == 'Unpaid') {
                        echo "<button onclick='LoaderShow()' type='submit' name='certificate-details' class='edit-window' style='cursor: pointer; color: #ff3333; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'>পেমেন্ট করুন</button>";
                    }
                    */
                    ?>
                </td>
            </tr>
            <tr>
                <td>সনদ তথ্য</td>
                <td>
                    <b>নামঃ</b> <?php echo $rowr['fullName'] ?><br/>
                    <b>পিতা/স্বামীঃ</b> <?php echo $rowr['guardianName'] ?><br/>
                    <b>মাতাঃ</b> <?php echo $rowr['motherName'] ?><br/>
                    <b>জাতীয় পরিচয়পত্রঃ</b> <?php echo $rowr['nidNo'] ?><br/>
                    <b>জন্ম তারিখঃ</b>
                    <?php
                    $bDate1=$rowr['birthDate'];
                    $format_bDate=date("d/m/Y",strtotime($bDate1));
                    echo $format_bDate;
                    ?>
                    <br/>
                    <b>গ্রাম/মহল্লাঃ</b> <?php echo $rowr['village'] ?><br/>
                    <b>ওয়ার্ডঃ</b> <?php echo $rowr['wardNo'] ?><br/>
                    <b>উপজেলাঃ</b> <?php echo $rowr['upozilla'] ?><br/>
                    <b>জেলাঃ</b> <?php echo $rowr['zilla'] ?><br/>
                    <b>মৃত্যু তারিখ:</b>
                    <?php
                    $bDate1_death=$rowr['deathDate'];
                    $format_bDate_death=date("d/m/Y",strtotime($bDate1_death));
                    echo $format_bDate_death;
                    ?>
                    <br/>
                </td>
            </tr>
                <tr>
                    <td>আবেদনের ধরণ</td>
                    <td><?php echo $rowr['applyType']; ?></td>
                </tr>
            <tr>
                <td>সনদ ডাউনলোড</td>
                <td>
                    <?php
                    if ($rowr['paymentStatus'] == 'Unpaid') {
                        echo "---";
                    }
                    if ($rowr['paymentStatus'] == 'Paid' && $rowr['status'] == 'Requested') {
                        echo "<a style='color: darkgoldenrod;font-weight: bold;'><i class='fa fa-clock-o'></i> অনুমোদনের জন্য অপেক্ষা করুন!</a>";
                    }
                    if ($rowr['paymentStatus'] == 'Paid' && $rowr['status'] == 'Rejected') {
                        echo "<a style='color: #ff3333;font-weight: bold;'><i class='fa fa-close'></i> সনদপত্রটি বাতিল করা হয়েছে!</a>";
                    }
                    if ($rowr['paymentStatus'] == 'Paid' && $rowr['status'] == 'Approved') {
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

    function banglaNumber($englishToBangla) {
        $englishNum=array("0","1","2","3","4","5",'6',"7","8","9","-");
        $banglaNum=array("০","১","২","৩","৪","৫",'৬',"৭","৮","৯","/");
        return str_replace($englishNum,$banglaNum,$englishToBangla);
    }

    //$date = date("d/m/Y");

    if ($rowr['paymentStatus'] == 'Paid') {

    ?>


    <div id="print-main-div">
        <div style="border: 3px solid #1e2039;padding: 10px;">
            <div class='print-header-top'>
                <p>স্মারক নংঃ ইউ/পরি/মৃ/তা/স/<?php echo banglaNumber($certificateID); ?></p>
                <p>তারিখঃ <?php echo banglaNumber($format_bDate1); ?> ইং</p>
            </div>
            <div class='print-header'>
                <div style='text-align: center;'>
                    <img src='assets/images/favicon.png' height='120' />
                    <p style='font-size:42px;font-weight:bold;'>ইউনিয়ন পরিষদ<br/>
                    <div style='font-size:18px;font-weight:400;text-align:center;'>
                        <a style='line-height: 25px;display:block;'>স্থাপিতঃ xxxx খ্রীষ্টাব্দ</a>
                        <a style='line-height: 25px;display:block;'>ফোনঃ xxxx-xxxxxx</a>
                    </div>
                    </p>
                </div>
            </div>

            <p style="text-align: center;margin-top: 50px;color: #1e2039;font-size: 52px;font-weight: bold;">মৃত্যু তারিখের সনদপত্র</p>
            <p style="font-size: 24px;margin-top: 80px;padding: 0 80px;">
                এই মর্মে প্রত্যয়ন করা যাচ্ছে যে,
                নামঃ <b style="display: inline-block;padding: 0 10px;"><?php echo $rowr['fullName'] ?></b>
                পিতা/স্বামীঃ <b style="display: inline-block;padding: 0 10px;"><?php echo $rowr['guardianName'] ?></b>
                মাতাঃ <b style="display: inline-block;padding: 0 10px;"><?php echo $rowr['motherName'] ?></b>
                জাতীয় পরিচয়পত্রঃ <b style="display: inline-block;padding: 0 10px;"><?php echo banglaNumber($rowr['nidNo']) ?></b>
                জন্ম তারিখঃ <b style="display: inline-block;padding: 0 10px;">
                    <?php
                    $bDate1=$rowr['birthDate'];
                    $format_bDate=date("d/m/Y",strtotime($bDate1));
                    echo banglaNumber($format_bDate);
                    ?>
                </b>
                গ্রাম/মহল্লাঃ <b style="display: inline-block;padding: 0 10px;"><?php echo $rowr['village'] ?></b>
                ওয়ার্ডঃ <b style="display: inline-block;padding: 0 10px;"><?php echo banglaNumber($rowr['wardNo']) ?></b>
                উপজেলাঃ <b style="display: inline-block;padding: 0 10px;"><?php echo $rowr['upozilla'] ?></b>
                জেলাঃ <b style="display: inline-block;padding: 0 10px;"><?php echo $rowr['zilla'] ?></b>।
                <br/><br/>
                তিনি ইউনিয়ন পরিষদের <b><?php echo banglaNumber($rowr['wardNo']) ?></b> নং ওয়ার্ডের স্থায়ী বাসিন্দা। আমি তাকে চিনি এবং জানি। আমার জানামতে তিনি গত <b style="display: inline-block;padding: 0 10px;"><?php echo banglaNumber($format_bDate_death); ?></b> ইং তারিখে ইন্তেকাল করেন (ইন্নালিল্লাহি ওয়া ইন্না ইলাইহি রাজি’উন)। মৃত ব্যক্তিকে তার পারিবারিক গোরস্থানে দাফন করা হয়।
                <br/><br/><br/>
                <a style="text-align: center;display: inline-block;">আমি তার বিদেহী আত্মার মাগফিরাত কামনা করি।</a>
            </p>
            <div style="display: flex; justify-content: space-between;margin-top: 200px;margin-bottom: 50px;">
                <p></p>
                <p style="text-align: center; font-size: 18px;width: 300px">
                    <img src="assets/images/mayor-signature.jpg" height="50"/><br/><br/>
                    মেয়র<br/>
                    ইউনিয়ন পরিষদ<br/>
                </p>
            </div>
        </div>
    </div>

    <?php
    }
    ?>



</div>
