<?php

include "../config/database-connection.php";

$sql_holding = "SELECT * FROM house_holding_database";
$result_holding = mysqli_query($db, $sql_holding);
$count_holding = mysqli_num_rows($result_holding);

$sql_holding_cardStatus = "SELECT * FROM house_holding_database WHERE cardStatus = 'সক্রিয়'";
$result_holding_cardStatus = mysqli_query($db, $sql_holding_cardStatus);
$count_holding_activeCards = mysqli_num_rows($result_holding_cardStatus);

$sql_trade_cardStatus = "SELECT * FROM trade_license_database WHERE cardStatus = 'সক্রিয়'";
$result_trade_cardStatus = mysqli_query($db, $sql_trade_cardStatus);
$count_trade_activeCards = mysqli_num_rows($result_trade_cardStatus);

$sql_trade = "SELECT * FROM trade_license_database";
$result_trade = mysqli_query($db, $sql_trade);
$count_trade = mysqli_num_rows($result_trade);


function englishNumber($BanglaToEnglish) {
    $banglaNum=array("০","১","২","৩","৪","৫",'৬',"৭","৮","৯","/");
    $englishNum=array("0","1","2","3","4","5",'6',"7","8","9","-");
    return str_replace($banglaNum,$englishNum,$BanglaToEnglish);
}


if (isset($_POST['houseHoldingSearchBtn']) && isset($_POST['houseHoldingSearchTxt'])) {

    $searchKey = englishNumber($_POST['houseHoldingSearchTxt']);
    $searchKey = strip_tags($searchKey);
    $searchKey = htmlspecialchars($searchKey);
    $searchKey = mysqli_real_escape_string($db, $searchKey);
    $searchKey = str_replace ('"', ' ', $searchKey);
    $searchKey = str_replace ("'", " ", $searchKey);
    $searchKey = str_replace (str_split('\\/:*?<>|,.[]{}`~!@#$%^*()_-+=;&'), " ", $searchKey);
    $searchKey = preg_replace('/\s+/', '-', $searchKey);

    echo "<script type='text/javascript'> document.location = 'house-holding-search/{$searchKey}'; </script>";
    exit();
}

if (!empty($searchKey)) {
    $inputValue = $searchKey;
} else {
    $inputValue = "";
}




if (isset($_POST['tradeLicSearchBtn']) && isset($_POST['tradeLicSearchTxt'])) {

    $searchKey = englishNumber($_POST['tradeLicSearchTxt']);
    $searchKey = strip_tags($searchKey);
    $searchKey = htmlspecialchars($searchKey);
    $searchKey = mysqli_real_escape_string($db, $searchKey);
    $searchKey = str_replace ('"', ' ', $searchKey);
    $searchKey = str_replace ("'", " ", $searchKey);
    $searchKey = str_replace (str_split('\\/:*?<>|,.[]{}`~!@#$%^*()_-+=;&'), " ", $searchKey);
    $searchKey = preg_replace('/\s+/', '-', $searchKey);

    echo "<script type='text/javascript'> document.location = 'trade-lic-search/{$searchKey}'; </script>";
    exit();
}

if (!empty($searchKey)) {
    $inputValue = $searchKey;
} else {
    $inputValue = "";
}


function banglaNumber($englishToBangla) {
    $englishNum=array("0","1","2","3","4","5",'6',"7","8","9","-");
    $banglaNum=array("০","১","২","৩","৪","৫",'৬',"৭","৮","৯","/");
    return str_replace($englishNum,$banglaNum,$englishToBangla);
}


?>


<script>
    document.title = 'এডমিন ড্যাশবোর্ড - ইউনিয়ন পরিষদ';
</script>

<div class="content-body-main-div">

    <p class="page-direction"><i class="fa fa-link"></i> এডমিন প্যানেল / ড্যাশবোর্ড /</p>

    <div class="admin-dashboard-content-div">

        <h1 style="font-family:'Bangla';color: #5e5e5e;border-bottom:1px solid #5e5e5e;">স্বাগতম, ইউনিয়ন পরিষদ</h1>



        <div style="display: inline">

            <table class="responstable2">
                <tbody>
                <tr>
                    <td>পুরুষ</td>
                    <?php
                    $peopleMale = "SELECT SUM(maleNumber) AS malePeople FROM house_holding_database";
                    $peopleMaleResult = mysqli_query($db, $peopleMale);
                    //$peopleCount = mysqli_num_rows($peopleResult);
                    $peopleMaleRow = mysqli_fetch_array($peopleMaleResult, MYSQLI_ASSOC);
                    $peopleMaleNumber = $peopleMaleRow['malePeople'];
                    if (empty($peopleMaleNumber)) {
                        $peopleMaleNumber = 0;
                    }
                    ?>
                    <td style="text-align:center;"><a style="font-family:Arial;"><?php echo banglaNumber($peopleMaleNumber); ?></a> জন</td>
                </tr>
                <tr>
                    <td>নারী</td>
                    <?php
                    $peopleFemale = "SELECT SUM(femaleNumber) AS femalePeople FROM house_holding_database";
                    $peopleFemaleResult = mysqli_query($db, $peopleFemale);
                    //$peopleCount = mysqli_num_rows($peopleResult);
                    $peopleFemaleRow = mysqli_fetch_array($peopleFemaleResult, MYSQLI_ASSOC);
                    $peopleFemaleNumber = $peopleFemaleRow['femalePeople'];
                    if (empty($peopleFemaleNumber)) {
                        $peopleFemaleNumber = 0;
                    }
                    ?>
                    <td style="text-align:center;"><a style="font-family:Arial;"><?php echo banglaNumber($peopleFemaleNumber); ?></a> জন</td>
                </tr>
                <tr>
                    <td><a href="admin/freedom-fighter-list" style="text-decoration: none; color: #024457;">মুক্তিযোদ্ধা <i class="fa fa-external-link"></i></a></td>
                    <?php
                    $freedom = "SELECT * FROM house_holding_database WHERE freedomFighter='হ্যাঁ'";
                    $freedomResult = mysqli_query($db, $freedom);
                    $freedomCount = mysqli_num_rows($freedomResult);
                    $freedom2 = "SELECT * FROM house_holding_database_family WHERE isFreedom='হ্যাঁ'";
                    $freedomResult2 = mysqli_query($db, $freedom2);
                    $freedomCount2 = mysqli_num_rows($freedomResult2);
                    $freedomTotal = $freedomCount + $freedomCount2;
                    ?>
                    <td style="text-align:center;"><a style="font-family:Arial;"><?php echo banglaNumber($freedomTotal); ?></a> জন</td>
                </tr>
                <tr>
                    <td><a href="admin/disability-list" style="text-decoration: none; color: #024457;">প্রতিবন্ধী <i class="fa fa-external-link"></i></a></td>
                    <?php
                    $disable = "SELECT * FROM house_holding_database WHERE disability='হ্যাঁ'";
                    $disableResult = mysqli_query($db, $disable);
                    $disableCount = mysqli_num_rows($disableResult);
                    /*
                    $disable2 = "SELECT * FROM house_holding_database_family WHERE disability='হ্যাঁ'";
                    $disableResult2 = mysqli_query($db, $disable2);
                    $disableCount2 = mysqli_num_rows($disableResult2);
                    $disableTotal = $disableCount2;
                    */
                    ?>
                    <td style="text-align:center;"><a style="font-family:Arial;"><?php echo banglaNumber($disableCount); ?></a> জন</td>
                </tr>
                <tr>
                    <td><a href="admin/allowance-list" style="text-decoration: none; color: #024457;">ভাতা ভোগী <i class="fa fa-external-link"></i></a></td>
                    <?php
                    $allowance = "SELECT * FROM house_holding_database WHERE allowanceType>''";
                    $allowanceResult = mysqli_query($db, $allowance);
                    $allowanceCount = mysqli_num_rows($allowanceResult);
                    $allowance2 = "SELECT * FROM house_holding_database_family WHERE isAllowance='হ্যাঁ'";
                    $allowanceResult2 = mysqli_query($db, $allowance2);
                    $allowanceCount2 = mysqli_num_rows($allowanceResult2);
                    $allowanceTotal = $allowanceCount + $allowanceCount2;
                    ?>
                    <td style="text-align:center;"><a style="font-family:Arial;"><?php echo banglaNumber($allowanceTotal); ?></a> জন</td>
                </tr>
                <!--
                <tr>
                    <td><a href="admin/university-student-list" style="text-decoration: none; color: #024457;">বিশ্ববিদ্যালয় শিক্ষার্থী <i class="fa fa-external-link"></i></a></td>
                    <?php
                    //$varsity = "SELECT * FROM house_holding_database WHERE isVoter='হ্যাঁ'";
                    //$varsityResult = mysqli_query($db, $voter);
                    //$varsityCount = mysqli_num_rows($varsityResult);
                    $varsity2 = "SELECT * FROM house_holding_database_family WHERE isVarsity='হ্যাঁ'";
                    $varsityResult2 = mysqli_query($db, $varsity2);
                    $varsityCount2 = mysqli_num_rows($varsityResult2);
                    $varsityTotal = $varsityCount2;
                    ?>
                    <td style="text-align:center;"><a style="font-family:Arial;"><?php echo banglaNumber($varsityTotal); ?></a> জন</td>
                </tr>
                -->
                <!--
                <tr>
                    <td style="font-size: 18px; font-weight: bolder;">মোট ভোটার</td>
                    <?php
                    $voter = "SELECT * FROM house_holding_database WHERE isVoter='হ্যাঁ'";
                    $voterResult = mysqli_query($db, $voter);
                    $voterCount = mysqli_num_rows($voterResult);
                    $voter2 = "SELECT * FROM house_holding_database_family WHERE isVoter='হ্যাঁ'";
                    $voterResult2 = mysqli_query($db, $voter2);
                    $voterCount2 = mysqli_num_rows($voterResult2);
                    $voterTotal = $voterCount + $voterCount2;
                    ?>
                    <td style="text-align:center;font-size: 20px; font-weight: bolder;"><a style="font-family:Arial;"><?php echo banglaNumber($voterTotal); ?></a> জন</td>
                </tr>
                -->
                <tr>
                    <td style="font-size: 18px; font-weight: bolder;">মোট জনসংখ্যা</td>
                    <?php
                    $peopleMale = "SELECT SUM(maleNumber) AS malePeople FROM house_holding_database";
                    $peopleMaleResult = mysqli_query($db, $peopleMale);
                    //$peopleCount = mysqli_num_rows($peopleResult);
                    $peopleMaleRow = mysqli_fetch_array($peopleMaleResult, MYSQLI_ASSOC);
                    $peopleMaleNumber = $peopleMaleRow['malePeople'];

                    $peopleFemale = "SELECT SUM(femaleNumber) AS femalePeople FROM house_holding_database";
                    $peopleFemaleResult = mysqli_query($db, $peopleFemale);
                    //$peopleCount = mysqli_num_rows($peopleResult);
                    $peopleFemaleRow = mysqli_fetch_array($peopleFemaleResult, MYSQLI_ASSOC);
                    $peopleFemaleNumber = $peopleFemaleRow['femalePeople'];

                    $totalPeople = $peopleMaleNumber + $peopleFemaleNumber;
                    ?>
                    <td style="text-align:center;font-size: 20px; font-weight: bolder;"><a style="font-family:Arial;"><?php echo banglaNumber($totalPeople); ?></a> জন</td>
                </tr>
                </tbody>
            </table>

        </div>



        <div>

            <div class="dashboard-element-body">
                <div class="dashboard-card-1">
                    <h3>
                        বসত বাড়ী হোল্ডিংঃ
                        <a href="admin/list-house-holding" style="text-decoration: none; color: #024457;font-size: 18px;"><i class="fa fa-external-link"></i></a>
                    </h3>
                    <p style="font-size: 32px; font-family: Arial;"><?php echo banglaNumber($count_holding); ?>
                        <a style="font-family: 'Bangla'"> টি</a>
                    </p>
                </div>
            </div>
            <div class="dashboard-element-body">
                <div class="dashboard-card-1">
                    <h3>
                        সক্রিয় নাগরিক কার্ডঃ
                        <a href="admin/active-house-holding" style="text-decoration: none; color: #024457;font-size: 18px;"><i class="fa fa-external-link"></i></a>
                    </h3>
                    <p style="font-size: 32px; font-family: Arial;"><?php echo banglaNumber($count_holding_activeCards); ?><a style="font-family: 'Bangla'"> টি</a></p>
                </div>
            </div>

            <div class="dashboard-element-body">
                <div class="dashboard-card-2">
                    <h3>ট্রেড লাইসেন্সঃ</h3>
                    <p style="font-size: 32px; font-family: Arial;"><?php echo banglaNumber($count_trade); ?><a style="font-family: 'Bangla'"> টি</a></p>
                </div>
            </div>
            <div class="dashboard-element-body">
                <div class="dashboard-card-2">
                    <h3>সক্রিয় লাইসেন্স কার্ডঃ</h3>
                    <p style="font-size: 32px; font-family: Arial;"><?php echo banglaNumber($count_trade_activeCards); ?><a style="font-family: 'Bangla'"> টি</a></p>
                </div>
            </div>

        </div>

        <br/><br/>





        <div class="dashboard-table-container" style="margin-bottom: 25px;border: 1px solid #23b14d;">
            <p class="dashboard-table-container-heading" style="background: rgba(35, 177, 77, 0.7);"><i class="fa fa-building-o"></i> বসত বাড়ী হোল্ডিং</p>
            <div class="dashboard-table-container-div">

                <table class="responstable">
                    <tbody>
                    <form method="POST" enctype="multipart/form-data">
                    <tr>
                        <td>
                            <label>কার্ড নাম্বার/ জাতীয় পরিচয় পত্রঃ</label>
                            <input type="text" name="houseHoldingSearchTxt" id="houseHoldingSearchTxt" autocomplete="off" value="" required>
                        </td>
                        <td>
                            <label>&nbsp;</label>
                            <button onsubmit="LoaderShow()" type="submit" name="houseHoldingSearchBtn" class="add-btn2"><i class="fa fa-search"></i> অনুসন্ধান করুন</button>
                        </td>
                    </tr>
                    </form>
                    </tbody>
                </table>

                <br/><br/>

            </div>
        </div>






        <div class="dashboard-table-container" style="margin-bottom: 25px;">
            <p class="dashboard-table-container-heading" style="background: rgba(91, 134, 229, 0.7);"><i class="fa fa-drivers-license-o"></i> ট্রেড লাইসেন্স</p>
            <div class="dashboard-table-container-div">

                <table class="responstable">
                    <tbody>
                    <form method="POST" enctype="multipart/form-data">
                    <tr>
                        <td>
                            <label>ট্রেড লাইসেন্স কার্ড নাম্বারঃ</label>
                            <input type="text" name="tradeLicSearchTxt" id="tradeLicSearchTxt" autocomplete="off" value="" required>
                        </td>
                        <td>
                            <label>&nbsp;</label>
                            <button onsubmit="LoaderShow()" type="submit" name="tradeLicSearchBtn" class="add-btn2"><i class="fa fa-search"></i> অনুসন্ধান করুন</button>
                        </td>
                    </tr>
                    </form>
                    </tbody>
                </table>

                <br/><br/>

            </div>
        </div>




        <div style="display: inline">
            <h2 style="font-family: 'Bangla';margin-top: 100px;text-decoration: underline;">অপারেটর ডাটা এন্ট্রিঃ</h2>

            <?php
            if ($user_role == "admin") {
            ?>
            <div class='reg_data_container'>
                <?php
                /*$operatorDataFetch = "SELECT * FROM user_admin WHERE role='operator'";*/
                $operatorDataFetch = "SELECT * FROM user_admin";
                $fetchDataResult = mysqli_query($db, $operatorDataFetch);
                if (mysqli_num_rows($fetchDataResult) > 0) {

                while ($row = mysqli_fetch_assoc($fetchDataResult)) {
                    $userId = $row['user_id'];
                ?>
                <form method="post" action="admin/operator-data-entry" style="display: inline-block;">
                    <input type="hidden" name="operatorID" value="<?php echo $row['user_id'] ?>">
                    <div class='tdata'>
                        <p class='ttitle'><?php echo $row['role'];?></p>
                        <p class='tvalue'>
                            <a>
                                <?php echo $row['full_name'];?>
                                <a></a>
                            </a>
                            <a style="background-color: #b8f1f1;padding: 3px 7px;margin-top: -15px;border-radius: 4px;font-family: 'Bangla';font-size: 22px;text-decoration: none;color: initial;">
                                <?php
                                $counterDataFetch = "SELECT * FROM house_holding_database WHERE dataEntryBy='$userId'";
                                $counterDataResult = mysqli_query($db, $counterDataFetch);
                                $countResult = mysqli_num_rows($counterDataResult);
                                echo banglaNumber($countResult);
                                ?> টি
                                <button style="padding: 0;margin: 0;width: 20px;height: 20px;background: none;border: 0;color: #007CC7;" title="ডাটাগুলা দেখুন"><i style="font-size: 16px;" class="fa fa-external-link"></i></button>
                            </a>
                        </p>
                    </div>
                </form>
                <?php
                }
                }
                ?>
            </div>
            <?php
            }
            ?>

            <?php
            if ($user_role == "operator") {
            ?>
            <div class='reg_data_container'>
                <?php
                /*$operatorDataFetch = "SELECT * FROM user_admin WHERE role='operator'";*/
                $operatorDataFetch = "SELECT * FROM user_admin WHERE user_id='$user_id'";
                $fetchDataResult = mysqli_query($db, $operatorDataFetch);
                if (mysqli_num_rows($fetchDataResult) > 0) {

                while ($row = mysqli_fetch_assoc($fetchDataResult)) {
                    $userId = $row['user_id'];
                ?>
                <form method="post" action="admin/operator-data-entry" style="display: inline-block;">
                    <input type="hidden" name="operatorID" value="<?php echo $row['user_id'] ?>">
                    <div class='tdata'>
                        <p class='ttitle'><?php echo $row['role'];?></p>
                        <p class='tvalue'>
                            <a>
                                <?php echo $row['full_name'];?>
                                <a></a>
                            </a>
                            <a style="background-color: #b8f1f1;padding: 3px 7px;margin-top: -15px;border-radius: 4px;font-family: 'Bangla';font-size: 22px;text-decoration: none;color: initial;">
                                <?php
                                $counterDataFetch = "SELECT * FROM house_holding_database WHERE dataEntryBy='$userId'";
                                $counterDataResult = mysqli_query($db, $counterDataFetch);
                                $countResult = mysqli_num_rows($counterDataResult);
                                echo banglaNumber($countResult);
                                ?> টি
                                <button style="padding: 0;margin: 0;width: 20px;height: 20px;background: none;border: 0;color: #007CC7;" title="ডাটাগুলা দেখুন"><i style="font-size: 16px;" class="fa fa-external-link"></i></button>
                            </a>
                        </p>
                    </div>
                </form>
                <?php
                }
                }
                ?>
            </div>
            <?php
            }
            ?>


        </div>




    </div>

</div>