
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


if($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['holding-payment-details'])) {

        $_SESSION['linkedForm'] = $_POST['linkedForm'];
        $_SESSION['renewHoldingID'] = $_POST['renewHoldingID'];
        echo "<script type='text/javascript'> document.location = 'citizen/holding-tax-details'; </script>";
    }

}


function banglaNumber($englishToBangla) {
    $englishNum=array("0","1","2","3","4","5",'6',"7","8","9","-");
    $banglaNum=array("০","১","২","৩","৪","৫",'৬',"৭","৮","৯","/");
    return str_replace($englishNum,$banglaNum,$englishToBangla);
}


?>


<script>
    document.title = 'হোল্ডিং ট্যাক্স - ইউনিয়ন পরিষদ';
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

    <p class="page-direction"><i class="fa fa-link"></i> নাগরিক পোর্টাল / হোল্ডিং ট্যাক্স /</p>

    <div class="admin-dashboard-content-div">

        <h2 style="font-family:'Bangla';color: #5e5e5e;border-bottom:1px solid #5e5e5e;">হোল্ডিং ট্যাক্সঃ</h2>

        <table class="responstable">
            <tbody>
            <?php
            $formID = $rowChk['formID'];
            $sqlr = "SELECT * FROM renew_house_holding_database WHERE linkedForm = '$formID' ORDER BY id ASC";
            $resultr = mysqli_query($db, $sqlr);
            $countr = mysqli_num_rows($resultr);
            if ($countr > 0) {
                ?>
                <tr>
                    <th>নবায়নের তারিখ</th>
                    <th class='table-display'>হোল্ডিং ফী</th>
                    <th class='table-display'>ডিস্কাউন্ট</th>
                    <th>পরিশোধিত টাকা</th>
                    <th>পেমেন্ট স্ট্যাটাস</th>
                    <th>অন্যান্য</th>
                </tr>
                <?php
                while ($rowr = mysqli_fetch_array($resultr, MYSQLI_ASSOC)) {
                    ?>
                    <tr>
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
                        <td class="table-display">
                            <?php echo banglaNumber($rowr['holdingFee']); ?> টাকা
                        </td>
                        <td class="table-display">
                            <?php echo banglaNumber($rowr['feeDiscount']); ?> টাকা
                        </td>
                        <td>
                            <?php echo banglaNumber($rowr['payableAmount']); ?> টাকা
                        </td>
                        <td>
                            <a class="<?php echo(($rowr['paymentStatus'] == 'Paid' ? 'paymentDone' : 'paymentDue')) ?>"><?php echo $rowr['paymentStatus'] ?></a>
                        </td>
                        <td>
                            <form method="post" enctype="multipart/form-data" style="display: inline-block;">
                                <input type="hidden" name="linkedForm" value="<?php echo $rowr['linkedForm'] ?>">
                                <input type="hidden" name="renewHoldingID" value="<?php echo $rowr['renewHoldingID'] ?>">

                                    <?php
                                    if ($rowr['paymentStatus'] == 'Paid') {
                                        echo "<button type='submit' class='edit-window' name='holding-payment-details' style='color: #23b14d; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'><i class='fa fa-check'></i> পরিশোধিত</button>";
                                    } else {
                                        echo "<button onclick='LoaderShow()' type='submit' name='holding-payment-details' class='edit-window' style='cursor: pointer; color: #ff3333; background: none; height: auto; border: 1px solid #ff3333; margin: 0; padding: 5px 10px; width: auto; font-weight: bold;'>পেমেন্ট করুন</button>";
                                    }
                                    ?>


                            </form>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<p style='font-size: 16px;font-family: Bangla;text-align: left;padding: 20px 0;font-style: italic;color: #ff3333;'><i class='fa fa-warning'></i> কোনো তথ্য পাওয়া যায় নি!</p>";
            }
            ?>
            </tbody>
        </table>
    </div>

</div>
