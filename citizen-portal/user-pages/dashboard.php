<?php

include "../config/database-connection.php";



function banglaNumber($englishToBangla) {
    $englishNum=array("0","1","2","3","4","5",'6',"7","8","9","-");
    $banglaNum=array("০","১","২","৩","৪","৫",'৬',"৭","৮","৯","/");
    return str_replace($englishNum,$banglaNum,$englishToBangla);
}


?>


<script>
    document.title = 'নাগরিক পোর্টাল - ইউনিয়ন পরিষদ';
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

    <p class="page-direction"><i class="fa fa-link"></i> নাগরিক পোর্টাল / ড্যাশবোর্ড /</p>

    <div class="admin-dashboard-content-div">

        <h2 style="font-family:'Bangla';color: #5e5e5e;border-bottom:1px solid #5e5e5e;"><a style="font-size: 32px;">স্বাগতম,</a>
            <?php
            if (isset($rowChk['personName'])) {
                echo $rowChk['personName'];
            } else {
                echo $rowChk['proprietorName'];
            }
            ?>
        </h2>





        <?php
        if ($_SESSION['user_role'] == "trade-license") {
        ?>

            <?php
            $formID = $rowChk['formID'];
            $sqlrt = "SELECT * FROM renew_trade_licence_database WHERE (linkedForm = '$formID' AND paymentStatus = 'Unpaid') ORDER BY id ASC";
            $resultrt = mysqli_query($db, $sqlrt);
            $countrt = mysqli_num_rows($resultrt);
            if ($countrt > 0) {
                ?>

                <br/>

                <h2 style="font-family:'Bangla';color: #5b86e5;"><i class="fa fa-cog"></i> ট্রেড লাইসেন্স ফিঃ</h2>

                <table class="responstable">
                <tbody>

                <tr>
                    <th>ট্রেড লাইসেন্স নং</th>
                    <th>নবায়নের তারিখ</th>
                    <th class='table-display'>ট্রেড লাইসেন্স ফি</th>
                    <th class='table-display'>সাইনবোর্ড কর</th>
                    <th class='table-display'>ভ্যাট</th>
                    <th>মোট টাকা</th>
                    <th>পেমেন্ট স্ট্যাটাস</th>
                    <th>অন্যান্য</th>
                </tr>
                <?php
                while ($rowrt = mysqli_fetch_array($resultrt, MYSQLI_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php echo $rowrt['tradeLicNo']; ?></td>
                        <td>
                            <?php
                            $bDate1=$rowrt['renewStartDate'];
                            $format_bDate1=date("d-m-Y",strtotime($bDate1));
                            $format_bDate1 = banglaNumber($format_bDate1);
                            $bDate2=$rowrt['renewEndDate'];
                            $format_bDate2=date("d-m-Y",strtotime($bDate2));
                            $format_bDate2 = banglaNumber($format_bDate2);
                            echo "$format_bDate1 হইতে $format_bDate2";
                            ?>
                        </td>
                        <td class="table-display">
                            <?php echo banglaNumber($rowrt['tradeLicFee']); ?> টাকা
                        </td>
                        <td class="table-display">
                            <?php echo banglaNumber($rowrt['signboardTax']); ?> টাকা
                        </td>
                        <td class="table-display">
                            <?php echo banglaNumber($rowrt['totalTax']); ?> টাকা
                        </td>
                        <td>
                            <?php echo banglaNumber($rowrt['totalAmount']); ?> টাকা
                        </td>
                        <td>
                            <a class="<?php echo(($rowrt['paymentStatus'] == 'Paid' ? 'paymentDone' : 'paymentDue')) ?>"><?php echo $rowrt['paymentStatus'] ?></a>
                        </td>
                        <td>
                            <form action="citizen/trade-licence-renew-details" method="post" enctype="multipart/form-data" style="display: inline-block;">
                                <input type="hidden" name="linkedForm" value="<?php echo $rowrt['linkedForm'] ?>">
                                <input type="hidden" name="renewTradeID" value="<?php echo $rowrt['renewTradeID'] ?>">

                                <?php
                                if ($rowrt['paymentStatus'] == 'Paid') {
                                    echo "<button type='submit' class='edit-window' name='trade-payment-details' style='color: #23b14d; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'><i class='fa fa-check'></i> পরিশোধিত</button>";
                                } else {
                                    echo "<button onclick='LoaderShow()' type='submit' name='trade-payment-details' class='edit-window' style='cursor: pointer; color: #ff3333; background: none; height: auto; border: 1px solid #ff3333; margin: 0; padding: 3px 10px; width: auto; font-weight: bold;'>পেমেন্ট করুন</button>";
                                }
                                ?>


                            </form>
                        </td>
                    </tr>

                    </tbody>
                    </table>

                    <?php
                }
                echo " <br/><br/>";
            }
            ?>






            <?php
        }
        ?>


        <?php
        if ($_SESSION['user_role'] == "house-holding") {
        ?>


            <?php
            $formID = $rowChk['formID'];
            $sqlrh = "SELECT * FROM renew_house_holding_database WHERE (linkedForm = '$formID' AND paymentStatus = 'Unpaid') ORDER BY id ASC";
            $resultrh = mysqli_query($db, $sqlrh);
            $countrh = mysqli_num_rows($resultrh);
            if ($countrh > 0) {
                ?>

                <br/>

        <h2 style="font-family:'Bangla';color: #5b86e5;"><i class="fa fa-cog"></i> হোল্ডিং ট্যাক্সঃ</h2>

        <table class="responstable">
            <tbody>

            <tr>
                <th>নবায়নের তারিখ</th>
                <th class='table-display'>হোল্ডিং ফী</th>
                <th class='table-display'>ডিস্কাউন্ট</th>
                <th>পরিশোধিত টাকা</th>
                <th>পেমেন্ট স্ট্যাটাস</th>
                <th>অন্যান্য</th>
            </tr>
                <?php
                while ($rowrh = mysqli_fetch_array($resultrh, MYSQLI_ASSOC)) {
                    ?>
                    <tr>
                        <td>
                            <?php
                            $bDate1=$rowrh['renewStartDate'];
                            $format_bDate1=date("d-m-Y",strtotime($bDate1));
                            $format_bDate1 = banglaNumber($format_bDate1);
                            $bDate2=$rowrh['renewEndDate'];
                            $format_bDate2=date("d-m-Y",strtotime($bDate2));
                            $format_bDate2 = banglaNumber($format_bDate2);
                            echo "$format_bDate1 হইতে $format_bDate2";
                            ?>
                        </td>
                        <td class="table-display">
                            <?php echo banglaNumber($rowrh['holdingFee']); ?> টাকা
                        </td>
                        <td class="table-display">
                            <?php echo banglaNumber($rowrh['feeDiscount']); ?> টাকা
                        </td>
                        <td>
                            <?php echo banglaNumber($rowrh['payableAmount']); ?> টাকা
                        </td>
                        <td>
                            <a class="<?php echo(($rowrh['paymentStatus'] == 'Paid' ? 'paymentDone' : 'paymentDue')) ?>"><?php echo $rowrh['paymentStatus'] ?></a>
                        </td>
                        <td>
                            <form action="citizen/holding-tax-details" method="post" enctype="multipart/form-data" style="display: inline-block;">
                                <input type="hidden" name="linkedForm" value="<?php echo $rowrh['linkedForm'] ?>">
                                <input type="hidden" name="renewHoldingID" value="<?php echo $rowrh['renewHoldingID'] ?>">

                                <?php
                                if ($rowrh['paymentStatus'] == 'Paid') {
                                    echo "<button type='submit' class='edit-window' name='holding-payment-details' style='color: #23b14d; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'><i class='fa fa-check'></i> পরিশোধিত</button>";
                                } else {
                                    echo "<button onclick='LoaderShow()' type='submit' name='holding-payment-details' class='edit-window' style='cursor: pointer; color: #ff3333; background: none; height: auto; border: 1px solid #ff3333; margin: 0; padding: 3px 10px; width: auto; font-weight: bold;'>পেমেন্ট করুন</button>";
                                }
                                ?>


                            </form>
                        </td>
                    </tr>

            </tbody>
        </table>

                    <?php
                }
                echo " <br/><br/>";
            }
            ?>






            <?php
            $formID = $rowChk['formID'];

            $sqlc = "SELECT * FROM character_certificate_apply WHERE (linkedForm = '$formID' AND paymentStatus = 'Unpaid') ORDER BY id ASC";
            $resultc = mysqli_query($db, $sqlc);
            $countc = mysqli_num_rows($resultc);

            $sqlu = "SELECT * FROM unmarried_certificate_apply WHERE (linkedForm = '$formID' AND paymentStatus = 'Unpaid') ORDER BY id ASC";
            $resultu = mysqli_query($db, $sqlu);
            $countu = mysqli_num_rows($resultu);

            $sqld = "SELECT * FROM death_certificate_apply WHERE (linkedForm = '$formID' AND paymentStatus = 'Unpaid') ORDER BY id ASC";
            $resultd = mysqli_query($db, $sqld);
            $countd = mysqli_num_rows($resultd);

            $sqlb = "SELECT * FROM burial_certificate_apply WHERE (linkedForm = '$formID' AND paymentStatus = 'Unpaid') ORDER BY id ASC";
            $resultb = mysqli_query($db, $sqlb);
            $countb = mysqli_num_rows($resultb);

            $sqll = "SELECT * FROM legacy_certificate_apply WHERE (linkedForm = '$formID' AND paymentStatus = 'Unpaid') ORDER BY id ASC";
            $resultl = mysqli_query($db, $sqll);
            $countl = mysqli_num_rows($resultl);

            $sqlr = "SELECT * FROM remarriage_certificate_apply WHERE (linkedForm = '$formID' AND paymentStatus = 'Unpaid') ORDER BY id ASC";
            $resultr = mysqli_query($db, $sqlr);
            $countr = mysqli_num_rows($resultr);

            $totalCounter = ($countc + $countu + $countd + $countb + $countl + $countr);


            if ($totalCounter > 0) {
            ?>

                <br/>
        <h2 style="font-family:'Bangla';color: #5b86e5;"><i class="fa fa-cog"></i> সনদপত্রঃ</h2>

        <table class="responstable">
            <tbody>
                <tr>
                    <th>সনদপত্রের ধরণ</th>
                    <th>আবেদনের তারিখ</th>
                    <th>পেমেন্ট স্ট্যাটাস</th>
                    <th>অন্যান্য</th>
                </tr>
                <!-- ------------------------------------------ -->
            <?php
            while ($rowc = mysqli_fetch_array($resultc, MYSQLI_ASSOC)) {
            ?>
                <tr>
                    <td>চারিত্রিক সনদপত্র</td>
                    <td>
                        <?php
                        $bDate1=$rowc['applyDate'];
                        $format_bDate=date("d-m-Y",strtotime($bDate1));
                        echo banglaNumber($format_bDate);
                        ?>
                    </td>
                    <td>
                        <a class="<?php echo(($rowc['paymentStatus'] == 'Paid' ? 'paymentDone' : 'paymentDue')) ?>"><?php echo $rowc['paymentStatus'] ?></a>
                    </td>
                    <td>
                        <form action="citizen/character-certificate-details" method="post" enctype="multipart/form-data" style="display: inline-block;">
                            <input type="hidden" name="linkedForm" value="<?php echo $rowc['linkedForm'] ?>">
                            <input type="hidden" name="certificateID" value="<?php echo $rowc['certificateID'] ?>">
                            <?php
                            if ($rowc['status'] != "Rejected") {
                                ?>
                                <a class='table-display'><button onclick='LoaderShow()' type='submit' name='certificate-details' class='view-window' style='cursor: pointer; color: #007CC7; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'>দেখুন</button> | </a>
                                <?php
                                if ($rowc['paymentStatus'] == 'Paid') {
                                    echo "<button onclick='LoaderShow()' type='submit' name='certificate-details' class='edit-window' style='cursor: pointer; color: #23b14d; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'>ডাউনলোড করুন</button>";
                                } else {
                                    echo "<button onclick='LoaderShow()' type='submit' name='certificate-details' class='edit-window' style='cursor: pointer; color: #ff3333; background: none; height: auto; border: 1px solid #ff3333; margin: 0; width: auto; padding: 3px 10px; font-weight: bold;'>পেমেন্ট করুন</button>";
                                }
                                ?>
                                <?php
                            } else {
                                echo "<a style='color: #ff3333;font-weight: bold;'><i class='fa fa-close'></i> সনদপত্রটি বাতিল করা হয়েছে!</a>";
                            }
                            ?>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>

                <!-- ------------------------------------------ -->
                <?php
                while ($rowu = mysqli_fetch_array($resultu, MYSQLI_ASSOC)) {
                    ?>
                    <tr>
                        <td>অবিবাহিত সনদপত্র</td>
                        <td>
                            <?php
                            $bDate1=$rowu['applyDate'];
                            $format_bDate=date("d-m-Y",strtotime($bDate1));
                            echo banglaNumber($format_bDate);
                            ?>
                        </td>
                        <td>
                            <a class="<?php echo(($rowu['paymentStatus'] == 'Paid' ? 'paymentDone' : 'paymentDue')) ?>"><?php echo $rowu['paymentStatus'] ?></a>
                        </td>
                        <td>
                            <form action="citizen/unmarried-certificate-details" method="post" enctype="multipart/form-data" style="display: inline-block;">
                                <input type="hidden" name="linkedForm" value="<?php echo $rowu['linkedForm'] ?>">
                                <input type="hidden" name="certificateID" value="<?php echo $rowu['certificateID'] ?>">
                                <?php
                                if ($rowu['status'] != "Rejected") {
                                    ?>
                                    <a class='table-display'><button onclick='LoaderShow()' type='submit' name='certificate-details' class='view-window' style='cursor: pointer; color: #007CC7; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'>দেখুন</button> | </a>
                                    <?php
                                    if ($rowu['paymentStatus'] == 'Paid') {
                                        echo "<button onclick='LoaderShow()' type='submit' name='certificate-details' class='edit-window' style='cursor: pointer; color: #23b14d; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'>ডাউনলোড করুন</button>";
                                    } else {
                                        echo "<button onclick='LoaderShow()' type='submit' name='certificate-details' class='edit-window' style='cursor: pointer; color: #ff3333; background: none; height: auto; border: 1px solid #ff3333; margin: 0; width: auto; padding: 3px 10px; font-weight: bold;'>পেমেন্ট করুন</button>";
                                    }
                                    ?>
                                    <?php
                                } else {
                                    echo "<a style='color: #ff3333;font-weight: bold;'><i class='fa fa-close'></i> সনদপত্রটি বাতিল করা হয়েছে!</a>";
                                }
                                ?>
                            </form>
                        </td>
                    </tr>
                    <?php
                }
                ?>

                <!-- ------------------------------------------ -->
                <?php
                while ($rowd = mysqli_fetch_array($resultd, MYSQLI_ASSOC)) {
                    ?>
                    <tr>
                        <td>মৃত্যু তারিখের সনদপত্র</td>
                        <td>
                            <?php
                            $bDate1=$rowd['applyDate'];
                            $format_bDate=date("d-m-Y",strtotime($bDate1));
                            echo banglaNumber($format_bDate);
                            ?>
                        </td>
                        <td>
                            <a class="<?php echo(($rowd['paymentStatus'] == 'Paid' ? 'paymentDone' : 'paymentDue')) ?>"><?php echo $rowd['paymentStatus'] ?></a>
                        </td>
                        <td>
                            <form action="citizen/death-certificate-details" method="post" enctype="multipart/form-data" style="display: inline-block;">
                                <input type="hidden" name="linkedForm" value="<?php echo $rowd['linkedForm'] ?>">
                                <input type="hidden" name="certificateID" value="<?php echo $rowd['certificateID'] ?>">
                                <?php
                                if ($rowd['status'] != "Rejected") {
                                    ?>
                                    <a class='table-display'><button onclick='LoaderShow()' type='submit' name='certificate-details' class='view-window' style='cursor: pointer; color: #007CC7; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'>দেখুন</button> | </a>
                                    <?php
                                    if ($rowd['paymentStatus'] == 'Paid') {
                                        echo "<button onclick='LoaderShow()' type='submit' name='certificate-details' class='edit-window' style='cursor: pointer; color: #23b14d; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'>ডাউনলোড করুন</button>";
                                    } else {
                                        echo "<button onclick='LoaderShow()' type='submit' name='certificate-details' class='edit-window' style='cursor: pointer; color: #ff3333; background: none; height: auto; border: 1px solid #ff3333; margin: 0; width: auto; padding: 3px 10px; font-weight: bold;'>পেমেন্ট করুন</button>";
                                    }
                                    ?>
                                    <?php
                                } else {
                                    echo "<a style='color: #ff3333;font-weight: bold;'><i class='fa fa-close'></i> সনদপত্রটি বাতিল করা হয়েছে!</a>";
                                }
                                ?>
                            </form>
                        </td>
                    </tr>
                    <?php
                }
                ?>

                <!-- ------------------------------------------ -->
            <?php
            while ($rowb = mysqli_fetch_array($resultb, MYSQLI_ASSOC)) {
            ?>
                <tr>
                    <td>দাফন সনদপত্র</td>
                    <td>
                        <?php
                        $bDate1=$rowb['applyDate'];
                        $format_bDate=date("d-m-Y",strtotime($bDate1));
                        echo banglaNumber($format_bDate);
                        ?>
                    </td>
                    <td>
                        <a class="<?php echo(($rowb['paymentStatus'] == 'Paid' ? 'paymentDone' : 'paymentDue')) ?>"><?php echo $rowb['paymentStatus'] ?></a>
                    </td>
                    <td>
                        <form action="citizen/burial-certificate-details" method="post" enctype="multipart/form-data" style="display: inline-block;">
                            <input type="hidden" name="linkedForm" value="<?php echo $rowb['linkedForm'] ?>">
                            <input type="hidden" name="certificateID" value="<?php echo $rowb['certificateID'] ?>">
                            <?php
                            if ($rowb['status'] != "Rejected") {
                                ?>
                                <a class='table-display'><button onclick='LoaderShow()' type='submit' name='certificate-details' class='view-window' style='cursor: pointer; color: #007CC7; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'>দেখুন</button> | </a>
                                <?php
                                if ($rowb['paymentStatus'] == 'Paid') {
                                    echo "<button onclick='LoaderShow()' type='submit' name='certificate-details' class='edit-window' style='cursor: pointer; color: #23b14d; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'>ডাউনলোড করুন</button>";
                                } else {
                                    echo "<button onclick='LoaderShow()' type='submit' name='certificate-details' class='edit-window' style='cursor: pointer; color: #ff3333; background: none; height: auto; border: 1px solid #ff3333; margin: 0; width: auto; padding: 3px 10px; font-weight: bold;'>পেমেন্ট করুন</button>";
                                }
                                ?>
                                <?php
                            } else {
                                echo "<a style='color: #ff3333;font-weight: bold;'><i class='fa fa-close'></i> সনদপত্রটি বাতিল করা হয়েছে!</a>";
                            }
                            ?>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>

                <!-- ------------------------------------------ -->
            <?php
            while ($rowl = mysqli_fetch_array($resultl, MYSQLI_ASSOC)) {
            ?>
                <tr>
                    <td>ওয়ারিশনামা সনদপত্র</td>
                    <td>
                        <?php
                        $bDate1=$rowl['applyDate'];
                        $format_bDate=date("d-m-Y",strtotime($bDate1));
                        echo banglaNumber($format_bDate);
                        ?>
                    </td>
                    <td>
                        <a class="<?php echo(($rowl['paymentStatus'] == 'Paid' ? 'paymentDone' : 'paymentDue')) ?>"><?php echo $rowl['paymentStatus'] ?></a>
                    </td>
                    <td>
                        <form action="citizen/legacy-certificate-details" method="post" enctype="multipart/form-data" style="display: inline-block;">
                            <input type="hidden" name="linkedForm" value="<?php echo $rowl['linkedForm'] ?>">
                            <input type="hidden" name="certificateID" value="<?php echo $rowl['certificateID'] ?>">
                            <?php
                            if ($rowl['status'] != "Rejected") {
                                ?>
                                <a class='table-display'><button onclick='LoaderShow()' type='submit' name='certificate-details' class='view-window' style='cursor: pointer; color: #007CC7; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'>দেখুন</button> | </a>
                                <?php
                                if ($rowl['paymentStatus'] == 'Paid') {
                                    echo "<button onclick='LoaderShow()' type='submit' name='certificate-details' class='edit-window' style='cursor: pointer; color: #23b14d; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'>ডাউনলোড করুন</button>";
                                } else {
                                    echo "<button onclick='LoaderShow()' type='submit' name='certificate-details' class='edit-window' style='cursor: pointer; color: #ff3333; background: none; height: auto; border: 1px solid #ff3333; margin: 0; width: auto; padding: 3px 10px; font-weight: bold;'>পেমেন্ট করুন</button>";
                                }
                                ?>
                                <?php
                            } else {
                                echo "<a style='color: #ff3333;font-weight: bold;'><i class='fa fa-close'></i> সনদপত্রটি বাতিল করা হয়েছে!</a>";
                            }
                            ?>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>

                <!-- ------------------------------------------ -->
            <?php
            while ($rowr = mysqli_fetch_array($resultr, MYSQLI_ASSOC)) {
            ?>
                <tr>
                    <td>পুনঃবিবাহ না হওয়া সনদপত্র</td>
                    <td>
                        <?php
                        $bDate1=$rowr['applyDate'];
                        $format_bDate=date("d-m-Y",strtotime($bDate1));
                        echo banglaNumber($format_bDate);
                        ?>
                    </td>
                    <td>
                        <a class="<?php echo(($rowr['paymentStatus'] == 'Paid' ? 'paymentDone' : 'paymentDue')) ?>"><?php echo $rowr['paymentStatus'] ?></a>
                    </td>
                    <td>
                        <form action="citizen/remarriage-certificate-details" method="post" enctype="multipart/form-data" style="display: inline-block;">
                            <input type="hidden" name="linkedForm" value="<?php echo $rowr['linkedForm'] ?>">
                            <input type="hidden" name="certificateID" value="<?php echo $rowr['certificateID'] ?>">
                            <?php
                            if ($rowr['status'] != "Rejected") {
                                ?>
                                <a class='table-display'><button onclick='LoaderShow()' type='submit' name='certificate-details' class='view-window' style='cursor: pointer; color: #007CC7; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'>দেখুন</button> | </a>
                                <?php
                                if ($rowr['paymentStatus'] == 'Paid') {
                                    echo "<button onclick='LoaderShow()' type='submit' name='certificate-details' class='edit-window' style='cursor: pointer; color: #23b14d; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'>ডাউনলোড করুন</button>";
                                } else {
                                    echo "<button onclick='LoaderShow()' type='submit' name='certificate-details' class='edit-window' style='cursor: pointer; color: #ff3333; background: none; height: auto; border: 1px solid #ff3333; margin: 0; width: auto; padding: 3px 10px; font-weight: bold;'>পেমেন্ট করুন</button>";
                                }
                                ?>
                                <?php
                            } else {
                                echo "<a style='color: #ff3333;font-weight: bold;'><i class='fa fa-close'></i> সনদপত্রটি বাতিল করা হয়েছে!</a>";
                            }
                            ?>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>


            </tbody>
        </table>

                <?php
            }
            ?>


        <?php
        }
        ?>



<?php
if ($countrh == 0 & $totalCounter == 0 & $countrt == 0) {
?>
        <style>
            #dashboard-empty-div {
                margin: 0 auto;
                height: 50vh;
                background-image: url(assets/images/watermark2.png);
                background-repeat: no-repeat;
                background-position: center;
                background-size: contain;
                margin-top: 50px;
            }
        </style>

        <div id="dashboard-empty-div"></div>

<?php
}
?>


    </div>

</div>




<!--
<style>
    #dashboard-empty-div {
        margin: 0 auto;
        height: 70vh;
        background-image: url(assets/images/watermark2.png);
        background-repeat: no-repeat;
        background-position: center;
        background-size: auto;
    }
</style>

<div id="dashboard-empty-div">

</div>
-->

