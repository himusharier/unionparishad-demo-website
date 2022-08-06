
<?php


if (empty($_POST["formID"])) {
    echo "<script type='text/javascript'> document.location = 'admin/list-house-holding'; </script>";
    die();
}

include "../config/database-connection.php";

$formID = $_POST["formID"];

if (isset($_POST['delete-btn']) && $user_role == "admin"){

    $formID = $_POST["formID"];

    $delSql = "DELETE FROM house_holding_database WHERE formID = '$formID'";
    if (mysqli_query($db, $delSql)) {

        $delSql2 = "DELETE FROM house_holding_database_children WHERE linkedForm = '$formID'";
        if (mysqli_query($db, $delSql2)) {
            echo "<script type='text/javascript'> document.location = 'admin/list-house-holding'; </script>";
            die();
        }
    }
}

if (isset($_POST['family-delete-btn']) && $_POST['familyDataId']){

    $formID = $_POST["formID"];
    $familyDataId = $_POST['familyDataId'];

    $delSql = "DELETE FROM house_holding_database_children WHERE (linkedForm = '$formID' AND id = '$familyDataId')";
    mysqli_query($db, $delSql);
}

function banglaNumber($englishToBangla) {
    $englishNum=array("0","1","2","3","4","5",'6',"7","8","9","-");
    $banglaNum=array("০","১","২","৩","৪","৫",'৬',"৭","৮","৯","/");
    return str_replace($englishNum,$banglaNum,$englishToBangla);
}

$sql = "SELECT * FROM house_holding_database WHERE formID = {$formID}";
$result = mysqli_query($db, $sql) or die("Not Found!");

if (mysqli_num_rows($result) == 1) {

while ($row = mysqli_fetch_assoc($result)) {

?>

<script>
    document.title = 'বসত বাড়ী হোল্ডিং - ইউনিয়ন পরিষদ';
</script>

<div class="content-body-main-div">

    <p class="page-direction"><i class="fa fa-link"></i> বসত বাড়ী হোল্ডিং / তথ্য তালিকা / সংশোধন /</p>

    <div id="response"></div>

    <form id="holding-form-data" method="post" enctype="multipart/form-data">

        <div class="dashboard-table-container" style="margin-bottom: 25px;">
            <p class="dashboard-table-container-heading">নাগরিক কার্ড সংক্রান্ত তথ্য</p>
            <div class="dashboard-table-container-div">

                <table>
                    <tbody>
                    <tr>
                        <td>
                            <label>আইডি নাম্বারঃ</label>
                            <input type="text" name="idNumber" id="idNumber" autocomplete="off" value="<?php echo banglaNumber($row['idNumber']); ?>">
                        </td>
                        <td>
                            <label>পিন নাম্বারঃ</label>
                            <input type="text" name="pinNumber" id="pinNumber" autocomplete="off" value="<?php echo banglaNumber($row['pinNumber']); ?>">
                        </td>
                        <td>
                            <label>কার্ড স্ট্যাটাসঃ</label>
                            <select name="cardStatus" id="cardStatus">
                                <option value="<?php echo $row['cardStatus']; ?>" hidden selected><?php echo $row['cardStatus']; ?></option>
                                <option value="সক্রিয়">সক্রিয়</option>
                                <option value="নিষ্ক্রিয়">নিষ্ক্রিয়</option>
                            </select>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>

        <div class="dashboard-table-container" style="margin-top: 25px;">
            <p class="dashboard-table-container-heading">ঠিকানা</p>
            <div class="dashboard-table-container-div">

                <table>
                    <tbody>
                    <tr>
                        <td>
                            <label>হোল্ডিং নংঃ</label>
                            <input type="text" name="holdingNo" value="<?php echo banglaNumber($row['holdingNo']); ?>">
                        </td>
                        <td>
                            <label>ওয়ার্ড নংঃ</label>
                            <input type="text" name="wardNo" value="<?php echo banglaNumber($row['wardNo']); ?>">
                        </td>
                        <td>
                            <label>গ্রামঃ</label>
                            <input type="text" name="village" value="<?php echo $row['village']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>পোস্টাল কোড / জিপ কোডঃ</label>
                            <input type="text" name="zip" value="<?php echo banglaNumber($row['zip']); ?>">
                        </td>
                        <td>
                            <label>ডাকঘরঃ</label>
                            <input type="text" name="post" value="<?php echo $row['post']; ?>">
                        </td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>

        <div class="dashboard-table-container" style="margin-top: 25px;">
            <p class="dashboard-table-container-heading">সাধারণ তথ্য</p>
            <div class="dashboard-table-container-div">

                <table>
                    <tbody>
                    <tr>
                        <td>
                            <label>হোল্ডিং এর ধরণঃ</label>
                            <select name="holdingType" id="holdingType">
                                <option value="<?php echo $row['holdingType']; ?>" hidden selected><?php echo $row['holdingType']; ?></option>
                                <option value="আবাসিক হোল্ডিং">আবাসিক হোল্ডিং</option>
                                <option value="বাণিজ্যিক হোল্ডিং">বাণিজ্যিক হোল্ডিং</option>
                            </select>
                        </td>
                        <td>
                            <label>সুবিধাভোগীর নামঃ</label>
                            <input type="text" name="personName" id="personName" autocomplete="off" value="<?php echo $row['personName']; ?>">
                        </td>
                        <!--
                        <td>
                            <label>অভিভাবকের ধরণঃ</label>
                            <select name="guardianType" id="guardianType">
                                <option value="<?php echo $row['guardianType']; ?>" hidden selected><?php echo $row['guardianType']; ?></option>
                                <option value="পিতার নাম">পিতার নাম</option>
                                <option value="স্বামীর নাম">স্বামীর নাম</option>
                            </select>
                        </td>
                        -->
                        <td>
                            <label>পিতা/ স্বামীর নামঃ</label>
                            <input type="text" name="guardianName" autocomplete="off" value="<?php echo $row['guardianName']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>মায়ের নামঃ</label>
                            <input type="text" name="motherName" autocomplete="off" value="<?php echo $row['motherName']; ?>">
                        </td>
                        <td>
                            <label>লিঙ্গঃ</label>
                            <select name="gender">
                                <option value="<?php echo $row['gender']; ?>" hidden selected><?php echo $row['gender']; ?></option>
                                <option value="পুরুষ">পুরুষ</option>
                                <option value="মহিলা">মহিলা</option>
                                <option value="অন্যান্য">অন্যান্য</option>
                            </select>
                        </td>
                        <td>
                            <label>মোবাইল নাম্বারঃ</label>
                            <input type="text" name="mobile" autocomplete="off" value="<?php echo banglaNumber($row['mobile']); ?>">
                        </td>
                    </tr>
                    <!--
                    <tr>
                        <td>
                            <label>বৈবাহিক অবস্থাঃ</label>
                            <select name="maritalStatus">
                                <option value="<?php echo $row['maritalStatus']; ?>" hidden selected><?php echo $row['maritalStatus']; ?></option>
                                <option value="বিবাহিত">বিবাহিত</option>
                                <option value="অবিবাহিত">অবিবাহিত</option>
                                <option value="বিধবা">বিধবা</option>
                            </select>
                        </td>
                        <td>
                            <label>জন্ম তারিখঃ (মাস/দিন/সাল)</label>
                            <input type="date" name="birthDate" autocomplete="off" value="<?php echo $row['birthDate']; ?>">
                        </td>
                        <td>
                            <label>পরিচয়ের ধরনঃ</label>
                            <select name="idType">
                                <option value="<?php echo $row['idType']; ?>" hidden selected><?php echo $row['idType']; ?></option>
                                <option value="এনআইডি নাম্বার">এনআইডি নাম্বার</option>
                                <option value="জন্ম নিবন্ধন নাম্বার">জন্ম নিবন্ধন নাম্বার</option>
                            </select>
                        </td>
                    </tr>
                    -->
                    <tr>
                        <td>
                            <label>পরিচয় পত্রের নাম্বারঃ (এনআইডি/ জন্ম সনদ)</label>
                            <input type="text" name="idNo" autocomplete="off" value="<?php echo banglaNumber($row['idNo']); ?>">
                        </td>
                        <td>
                            <label>বয়সঃ</label>
                            <input type="text" name="personAge" autocomplete="off" value="<?php echo banglaNumber($row['personAge']); ?>">
                        </td>
                        <td>
                            <label>ধর্মঃ</label>
                            <select name="religion">
                                <option value="<?php echo $row['religion']; ?>" hidden selected><?php echo $row['religion']; ?></option>
                                <option value="ইসলাম">ইসলাম</option>
                                <option value="হিন্দু">হিন্দু</option>
                                <option value="বৌদ্ধধর্ম">বৌদ্ধধর্ম</option>
                                <option value="খ্রিস্টান">খ্রিস্টান</option>
                                <option value="অন্যান্য">অন্যান্য</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>পরিবারে মোট সদস্য সংখ্যাঃ</label>
                            <input type="text" name="totalFamilyMember" autocomplete="off" value="<?php echo banglaNumber($row['totalFamilyMember']); ?>">
                        </td>
                        <td>
                            <label>পুরুষ সদস্য সংখ্যাঃ</label>
                            <input type="text" name="maleNumber" autocomplete="off" value="<?php echo banglaNumber($row['maleNumber']); ?>">
                        </td>
                        <td>
                            <label>মহিলা সদস্য সংখ্যাঃ</label>
                            <input type="text" name="femaleNumber" autocomplete="off" value="<?php echo banglaNumber($row['femaleNumber']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>ছেলে সন্তান কতজন?</label>
                            <input type="text" name="maleChildNumber" autocomplete="off" value="<?php echo banglaNumber($row['maleChildNumber']); ?>">
                        </td>
                        <td>
                            <label>মেয়ে সন্তান কতজন?</label>
                            <input type="text" name="femaleChildNumber" autocomplete="off" value="<?php echo banglaNumber($row['femaleChildNumber']); ?>">
                        </td>
                        <td>
                            <label>নিবন্ধন ফিঃ</label>
                            <input type="text" name="applicationFee" autocomplete="off" value="<?php echo banglaNumber($row['applicationFee']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>পেমেন্টের ধরনঃ</label>
                            <select name="paymentType">
                                <option value="<?php echo $row['paymentType']; ?>" hidden selected><?php echo $row['paymentType']; ?></option>
                                <option value="নগদ টাকা">নগদ টাকা</option>
                                <option value="নগদ (মোবাইল ব্যাংকিং)">নগদ (মোবাইল ব্যাংকিং)</option>
                                <option value="বিকাশ (মোবাইল ব্যাংকিং)">বিকাশ (মোবাইল ব্যাংকিং)</option>
                                <option value="ব্যাংক">ব্যাংক</option>
                            </select>
                        </td>
                        <td>
                            <label>আপনি কি ভাতা পান?</label>
                            <select name="isAllowance">
                                <option value="<?php echo $row['isAllowance']; ?>" hidden selected><?php echo $row['isAllowance']; ?></option>
                                <option value="হ্যাঁ">হ্যাঁ</option>
                                <option value="না">না</option>
                            </select>
                        </td>
                        <td>
                            <label>ভাতা নির্বাচন করুনঃ</label>
                            <select name="allowanceType">
                                <option value="<?php echo $row['allowanceType']; ?>" hidden selected><?php echo $row['allowanceType']; ?></option>
                                <option value="">কোনো ভাতা প্রদান করা হয়নি</option>
                                <option value="বয়স্ক ভাতা">বয়স্ক ভাতা</option>
                                <option value="প্রতিবন্ধী ভাতা">প্রতিবন্ধী ভাতা</option>
                                <option value="বিধবা ভাতা">বিধবা ভাতা</option>
                                <option value="মুক্তিযোদ্ধা ভাতা">মুক্তিযোদ্ধা ভাতা</option>
                                <option value="চাল">চাল</option>
                                <option value="দৃষ্টি প্রতিবন্ধী">দৃষ্টি প্রতিবন্ধী</option>
                                <option value="বাকপ্রতিবন্ধী">বাকপ্রতিবন্ধী</option>
                                <option value="মানসিক প্রতিবন্ধী">মানসিক প্রতিবন্ধী</option>
                                <option value="পঙ্গু">পঙ্গু</option>
                                <option value="ধানের বীজ">ধানের বীজ</option>
                                <option value="শীতের কম্বল">শীতের কম্বল</option>
                                <option value="নগদ অর্থ প্রদান">নগদ অর্থ প্রদান</option>
                                <option value="বীজ">বীজ</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>ভাতার পরিমানঃ (টাকা/অন্যান্য)</label>
                            <input type="text" name="allowanceAmount" autocomplete="off" value="<?php echo banglaNumber($row['allowanceAmount']); ?>">
                        </td>
                        <td>
                            <label>পরিবারে কতজন ভাতা পান?</label>
                            <input type="text" name="allowanceMember" autocomplete="off" value="<?php echo banglaNumber($row['allowanceMember']); ?>">
                        </td>
                        <td>
                            <label>পরিবারে কেউ প্রতিবন্ধী আছে?</label>
                            <select name="disability">
                                <option value="<?php echo $row['disability']; ?>" hidden selected><?php echo $row['disability']; ?></option>
                                <option value="হ্যাঁ">হ্যাঁ</option>
                                <option value="না">না</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>প্রতিবন্ধী কতজন?</label>
                            <input type="text" name="disabilityNumber" value="<?php echo banglaNumber($row['disabilityNumber']); ?>">
                        </td>
                        <td>
                            <label>ছেলে প্রতিবন্ধী সংখ্যাঃ</label>
                            <input type="text" name="maleDisabilityNumber" value="<?php echo banglaNumber($row['maleDisabilityNumber']); ?>">
                        </td>
                        <td>
                            <label>মেয়ে প্রতিবন্ধী সংখ্যাঃ</label>
                            <input type="text" name="femaleDisabilityNumber" value="<?php echo banglaNumber($row['femaleDisabilityNumber']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>আপনি কি মুক্তিযোদ্ধা?</label>
                            <select name="freedomFighter">
                                <option value="<?php echo $row['freedomFighter']; ?>" hidden selected><?php echo $row['freedomFighter']; ?></option>
                                <option value="হ্যাঁ">হ্যাঁ</option>
                                <option value="না">না</option>
                            </select>
                        </td>
                        <td>
                            <label>পানির সংযোগ আছে কিনা?</label>
                            <select name="waterConnection">
                                <option value="<?php echo $row['waterConnection']; ?>" hidden selected><?php echo $row['waterConnection']; ?></option>
                                <option value="হ্যাঁ">হ্যাঁ</option>
                                <option value="না">না</option>
                            </select>
                        </td>
                        <!--
                        <td>
                            <label>পরিবারে জন্ম নিবন্ধনে কতজন আছে?</label>
                            <input type="text" name="nidHolder" autocomplete="off" value="<?php echo $row['nidHolder']; ?>">
                        </td>
                        -->
                        <td>
                            <label>আপনি কি ভোটার?</label>
                            <select name="voter">
                                <option value="<?php echo $row['isVoter']; ?>" hidden selected><?php echo $row['isVoter']; ?></option>
                                <option value="হ্যাঁ">হ্যাঁ</option>
                                <option value="না">না</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>পরিবারে ভোটার সংখ্যাঃ</label>
                            <input type="text" name="voterNumber" value="<?php echo banglaNumber($row['voterNumber']); ?>">
                        </td>
                        <td>
                            <label>পরিবারে বেকার সদস্য সংখ্যাঃ</label>
                            <input type="text" name="unemployedMember" value="<?php echo banglaNumber($row['unemployedMember']); ?>">
                        </td>
                        <td>
                            <label>পরিবারে কর্মজীবী সদস্য সংখ্যাঃ</label>
                            <input type="text" name="workerMember" value="<?php echo banglaNumber($row['workerMember']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>পরিবারের বার্ষিক আয় কত?</label>
                            <input type="text" name="familyIncome" value="<?php echo banglaNumber($row['familyIncome']); ?>">
                        </td>
                        <td>
                            <label>পারিবারিক অবস্থার ধরনঃ</label>
                            <select name="familyCondition">
                                <option value="<?php echo $row['familyCondition']; ?>" hidden selected><?php echo $row['familyCondition']; ?></option>
                                <option value="উচ্চবিত্ত">উচ্চবিত্ত</option>
                                <option value="মধ্যবিত্ত">মধ্যবিত্ত</option>
                                <option value="নিম্নবিত্ত">নিম্নবিত্ত</option>
                            </select>
                        </td>
                        <td>
                            <label>ছেলে-মেয়ে কি লেখাপড়া করে?</label>
                            <select name="isChildEducation">
                                <option value="<?php echo $row['isChildEducation']; ?>" hidden selected><?php echo $row['isChildEducation']; ?></option>
                                <option value="হ্যাঁ">হ্যাঁ</option>
                                <option value="না">না</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>কতজন লেখাপড়া করে?</label>
                            <input type="text" name="childEducationNumber" value="<?php echo banglaNumber($row['childEducationNumber']); ?>">
                        </td>
                        <td>
                            <label>জমির পরিমাণঃ (শতাংশে)</label>
                            <input type="text" name="landAmount" value="<?php echo banglaNumber($row['landAmount']); ?>">
                        </td>
                        <td>
                            <label>বসত বাড়ি জমির পরিমাণঃ</label>
                            <input type="text" name="homeLandAmount" value="<?php echo banglaNumber($row['homeLandAmount']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>আবাদী জমির পরিমাণঃ</label>
                            <input type="text" name="agriLandAmount" value="<?php echo banglaNumber($row['agriLandAmount']); ?>">
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>

        <div class="dashboard-table-container" style="margin-top: 25px;">
            <p class="dashboard-table-container-heading">পারিবারিক সম্পর্ক সংক্রান্ত তথ্য <a onclick="add_more()" class="add-btn2" style="display:inline-block;margin: 0;margin-top: -4px;float: right;border-radius: 4px;margin-right: -10px;"><i class="fa fa-plus"></i> আরেকটি তথ্য যোগ করুন</a></p>
            <div class="dashboard-table-container-div" id="form-wrap">


                <?php
                $sqlPr = "SELECT * FROM house_holding_database_children WHERE linkedForm = {$formID} ORDER BY id ASC";
                $resultPr = mysqli_query($db, $sqlPr);
                $prRowCount = mysqli_num_rows($resultPr);

                $i = 1;

                if ($prRowCount > 0) {
                $projects = array();
                while ($project = mysqli_fetch_assoc($resultPr))
                {
                    $projects[] = $project;
                }
                foreach ($projects as $project)
                {
                ?>

                <table>
                    <tbody>

                    <tr>
                        <td>
                            <label>সন্তানের নামঃ</label>
                            <input type="hidden" name="pr<?php echo $i; ?>FamilyId" value="<?php echo $project['id']; ?>">
                            <input type="text" name="pr<?php echo $i; ?>Name" value="<?php echo $project['personName']; ?>">
                        </td>
                        <td>
                            <label>সন্তানের বয়সঃ</label>
                            <input type="text" name="pr<?php echo $i; ?>Age" value="<?php echo banglaNumber($project['personAge']); ?>">
                        </td>
                        <td>
                            <form method="post" enctype="multipart/form-data">
                                <input type="hidden" name="formID" value="<?php echo $project['linkedForm']; ?>">
                                <input type="hidden" name="familyDataId" value="<?php echo $project['id']; ?>">
                                <button onclick="return confirm('আপনি কি এই তথ্যটি বাতিল করতে চান?');" type="submit" name="family-delete-btn" id="family-delete-btn" class="delete-btn2" style="margin: 0;margin-top: 30px;"><i class="fa fa-trash"></i> বাতিল করুন</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                    $i++;
                    }
                    }
                    ?>
                    </tbody>
                </table>

            </div>

            <input type="hidden" id="box_count" name="box_count" value="<?php echo $prRowCount; ?>">
        </div>

        <div class="dashboard-table-container" style="margin-top: 25px;">
            <p class="dashboard-table-container-heading">অন্যান্য তথ্য</p>
            <div class="dashboard-table-container-div">

                <table>
                    <tbody>
                    <tr>
                        <td>
                            <label>বৈদ্যুতিক অবস্থাঃ</label>
                            <select name="electricity">
                                <option value="<?php echo $row['electricity']; ?>" hidden selected><?php echo $row['electricity']; ?></option>
                                <option value="হ্যাঁ">হ্যাঁ</option>
                                <option value="না">না</option>
                            </select>
                        </td>
                        <td>
                            <label>স্যানিটেশনের অবস্থাঃ</label>
                            <select name="sanitation">
                                <option value="<?php echo $row['sanitation']; ?>" hidden selected><?php echo $row['sanitation']; ?></option>
                                <option value="পাকা">পাকা</option>
                                <option value="কাচা">কাচা</option>
                                <option value="অস্বাস্থ্যকর">অস্বাস্থ্যকর</option>
                            </select>
                        </td>
                        <td>
                            <label>বাড়ির ধরনঃ</label>
                            <select name="houseType">
                                <option value="<?php echo $row['houseType']; ?>" hidden selected><?php echo $row['houseType']; ?></option>
                                <option value="পাকা বাড়ি">পাকা বাড়ি</option>
                                <option value="কাঁচা বাড়ি">কাঁচা বাড়ি</option>
                                <option value="আধাপাকা">আধাপাকা</option>
                                <option value="ভাড়াটিয়া ঘর নাই">ভাড়াটিয়া ঘর নাই</option>
                                <option value="পাকা বাড়ি আবাসিক">পাকা বাড়ি আবাসিক</option>
                                <option value="কাঁচা বাড়ি আবাসিক">কাঁচা বাড়ি আবাসিক</option>
                                <option value="আধাপাকা আবাসিক">আধাপাকা আবাসিক</option>
                                <option value="পাকা ১ তলা">পাকা ১ তলা</option>
                                <option value="পাকা ২ তলা">পাকা ২ তলা</option>
                                <option value="পাকা ৩ তলা">পাকা ৩ তলা</option>
                                <option value="পাকা ৪ তলা">পাকা ৪ তলা</option>
                                <option value="পাকা ৫ তলা">পাকা ৫ তলা</option>
                                <option value="পাকা ৬ তলা">পাকা ৬ তলা</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <!--
                        <td>
                            <label>মোট বাড়িঃ</label>
                            <input type="text" name="totalHouse" autocomplete="off" value="<?php echo $row['totalHouse']; ?>">
                        </td>
                        -->
                        <td>
                            <label>পেশাঃ</label>
                            <select name="occupation">
                                <option value="<?php echo $row['occupation']; ?>" hidden selected><?php echo $row['occupation']; ?></option>
                                <option value="প্রবাসী">প্রবাসী</option>
                                <option value="চাকরি">চাকরি</option>
                                <option value="ব্যবসা">ব্যবসা</option>
                                <option value="দিন মজুর">দিন মজুর</option>
                                <option value="শিক্ষক">শিক্ষক</option>
                                <option value="ড্রাইভার">ড্রাইভার</option>
                                <option value="কৃষক">কৃষক</option>
                                <option value="গৃহিণী">গৃহিণী</option>
                                <option value="বেকার">বেকার</option>
                                <option value="মৃৎশিল্পী">মৃৎশিল্পী</option>
                                <option value="দর্জি">দর্জি</option>
                                <option value="ইলেকট্রিশিয়ান">ইলেকট্রিশিয়ান</option>
                                <option value="ডাক্তার">ডাক্তার</option>
                                <option value="সরকারি চাকরি">সরকারি চাকরি</option>
                                <option value="আইনজীবী">আইনজীবী</option>
                                <option value="ব্যাংকার">ব্যাংকার</option>
                                <option value="দলিল লেখক">দলিল লেখক</option>
                                <option value="সেলসম্যান">সেলসম্যান</option>
                                <option value="রিটার্ড">রিটার্ড</option>
                                <option value="সাংবাদিক">সাংবাদিক</option>
                                <option value="ঠিকাদার">ঠিকাদার</option>
                                <option value="রাজনীতিবিদ">রাজনীতিবিদ</option>
                                <option value="সেলুন">সেলুন</option>
                                <option value="ছাত্র">ছাত্র</option>
                                <option value="সমাজসেবক">সমাজসেবক</option>
                                <option value="হুজুর">হুজুর</option>
                                <option value="মোয়াজ্জেম">মোয়াজ্জেম</option>
                                <option value="ুলিশ কর্মকর্তা">পুলিশ কর্মকর্তা</option>
                                <option value="পুরোহিত">পুরোহিত</option>
                                <option value="বৌদ্ধ ভিক্ষু">বৌদ্ধ ভিক্ষু</option>
                                <option value="সেনাবাহিনী">সেনাবাহিনী</option>
                                <option value="ডিজাইন ইন্জিনিয়ার">ডিজাইন ইন্জিনিয়ার</option>
                                <option value="ইঞ্জিনিয়ার">ইঞ্জিনিয়ার</option>
                                <option value="পেইন্টার">পেইন্টার</option>
                                <option value="বেসরকারি কর্মচারী">বেসরকারি কর্মচারী</option>
                                <option value="জেলে">জেলে</option>
                                <option value="স্বাস্হ্যকর্মী">স্বাস্হ্যকর্মী</option>
                                <option value="কাউন্সেলর">কাউন্সেলর</option>
                            </select>
                        </td>
                        <td>
                            <label>শেষ ট্যাক্স প্রদানের অর্থবছরঃ</label>
                            <select name="lastTaxDate">
                                <option value="<?php echo $row['lastTaxDate']; ?>" hidden selected><?php echo banglaNumber($row['lastTaxDate']); ?></option>
                                <option value="2010">2010</option>
                                <option value="2011">2011</option>
                                <option value="2012">2012</option>
                                <option value="2013">2013</option>
                                <option value="2014">2014</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                            </select>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!--
        <div class="dashboard-table-container" style="margin-top: 25px;">
            <p class="dashboard-table-container-heading">পারিবারিক সম্পর্ক সংক্রান্ত তথ্য <a onclick="add_more()" class="add-btn2" style="display:inline-block;margin: 0;margin-top: -4px;float: right;border-radius: 4px;"><i class="fa fa-plus"></i> আরেকটি তথ্য যোগ করুন</a></p>
            <div class="dashboard-table-container-div" id="form-wrap">


                <?php
                $sqlPr = "SELECT * FROM house_holding_database_family WHERE linkedForm = {$formID} ORDER BY id ASC";
                $resultPr = mysqli_query($db, $sqlPr);
                $prRowCount = mysqli_num_rows($resultPr);

                $i = 1;

                if ($prRowCount > 0) {
                $projects = array();
                while ($project = mysqli_fetch_assoc($resultPr))
                {
                    $projects[] = $project;
                }
                foreach ($projects as $project)
                {
                ?>

                <table style="border-bottom: 2px dashed #5B86E5;">
                    <tbody>

                    <tr>
                        <td>
                            <label>নামঃ</label>
                            <input type="hidden" name="pr<?php echo $i; ?>FamilyId" value="<?php echo $project['id']; ?>">
                            <input type="text" name="pr<?php echo $i; ?>Name" value="<?php echo $project['personName']; ?>">
                        </td>
                        <td>
                            <label>সম্পর্কঃ</label>
                            <select name="pr<?php echo $i; ?>Relation">
                                <option value="<?php echo $project['relationType']; ?>" hidden selected><?php echo $project['relationType']; ?></option>
                                <option value="ছেলে">ছেলে</option>
                                <option value="মেয়ে">মেয়ে</option>
                                <option value="ভাই">ভাই</option>
                                <option value="বোন">বোন</option>
                                <option value="মা">মা</option>
                                <option value="বাবা">বাবা</option>
                            </select>
                        </td>
                        <td>
                            <label>পরিচয় পত্র নাম্বারঃ</label>
                            <input type="text" name="pr<?php echo $i; ?>IdNo" value="<?php echo $project['idNumber']; ?>">
                        </td>
                        <td>
                            <label>মোবাইল নাম্বারঃ</label>
                            <input type="text" name="pr<?php echo $i; ?>Mobile" value="<?php echo $project['mobileNumber']; ?>">
                        </td>
                        <td>
                            <form method="post" enctype="multipart/form-data">
                            <input type="hidden" name="formID" value="<?php echo $project['linkedForm']; ?>">
                            <input type="hidden" name="familyDataId" value="<?php echo $project['id']; ?>">
                            <button onclick="return confirm('আপনি কি এই তথ্যটি বাতিল করতে চান?');" type="submit" name="family-delete-btn" id="family-delete-btn" class="delete-btn2" style="margin: 0;margin-top: 30px;"><i class="fa fa-trash"></i> বাতিল করুন</button>
                            </form>
                        </td>
                    </tr>
                            <tr>
                                <td>
                                    <label>মুক্তিযোদ্ধা কিনা?</label>
                                    <select name="pr<?php echo $i; ?>Freedom">
                                        <option value="<?php echo $project['isFreedom']; ?>" hidden selected><?php echo $project['isFreedom']; ?></option>
                                        <option value="হ্যাঁ">হ্যাঁ</option>
                                        <option value="না">না</option>
                                    </select>
                                </td>
                                <td>
                                    <label>গেজেট নংঃ</label>
                                    <input type="text" name="pr<?php echo $i; ?>Gazette" value="<?php echo $project['gazetteNo']; ?>">
                                </td>
                                <td>
                                    <label>প্রতিবন্ধী কিনা?</label>
                                    <select name="pr<?php echo $i; ?>Disability">
                                        <option value="<?php echo $project['disability']; ?>" hidden selected><?php echo $project['disability']; ?></option>
                                        <option value="হ্যাঁ">হ্যাঁ</option>
                                        <option value="না">না</option>
                                    </select>
                                </td>
                                <td>
                                    <label>বয়সঃ</label>
                                    <input type="text" name="pr<?php echo $i; ?>Age" value="<?php echo $project['age']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>ভাতা ভোগী কিনা?</label>
                                    <select name="pr<?php echo $i; ?>Allowance">
                                        <option value="<?php echo $project['isAllowance']; ?>" hidden selected><?php echo $project['isAllowance']; ?></option>
                                        <option value="হ্যাঁ">হ্যাঁ</option>
                                        <option value="না">না</option>
                                    </select>
                                </td>
                                <td>
                                    <label>কার্ড নাম্বারঃ</label>
                                    <input type="text" name="pr<?php echo $i; ?>Card" value="<?php echo $project['allowanceCardNo']; ?>">
                                </td>
                                <td>
                                    <label>পাবলিক ভার্সিটিতে পড়ে কিনা?</label>
                                    <select name="pr<?php echo $i; ?>Education">
                                        <option value="<?php echo $project['isVarsity']; ?>" hidden selected><?php echo $project['isVarsity']; ?></option>
                                        <option value="হ্যাঁ">হ্যাঁ</option>
                                        <option value="না">না</option>
                                    </select>
                                </td>
                                <td>
                                    <label>বিশ্ববিদ্যালয়ের নামঃ</label>
                                    <input type="text" name="pr<?php echo $i; ?>Varsity" value="<?php echo $project['varsityName']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>ভোটার কিনা?</label>
                                    <select name="pr<?php echo $i; ?>Voter">
                                        <option value="<?php echo $project['isVoter']; ?>" hidden selected><?php echo $project['isVoter']; ?></option>
                                        <option value="হ্যাঁ">হ্যাঁ</option>
                                        <option value="না">না</option>
                                    </select>
                                </td>
                                <td>
                                    <label>এনআইডি নাম্বারঃ</label>
                                    <input type="text" name="pr<?php echo $i; ?>Nid" value="<?php echo $project['nidNumber']; ?>">
                                </td>
                            </tr>
                    <?php
                        $i++;
                    }
                    }
                    ?>
                    </tbody>
                </table>

            </div>
        </div>
        -->

        <input type="hidden" name="formID" value="<?php echo $row['formID']; ?>">
        <button onclick="showForm()" type="button" name="submit-btn" id="submit-btn"><i class="fa fa-save"></i> তথ্য সংশোধন করুন</button>
    </form>

        <?php
        if ($user_role == "admin") {
        ?>
        <form id="form-delete-btn" method="post" enctype="multipart/form-data" onsubmit="return confirm('আপনি কি এই ফর্মটি বাতিল করতে চান?');">
            <input type="hidden" name="formID" value="<?php echo $row['formID']; ?>">
            <button type="submit" name="delete-btn" id="delete-btn" class="delete-btn"><i class="fa fa-trash"></i> ফর্মটি বাতিল করুন</button>
        </form>
        <?php
        }
        ?>


</div>

    <?php

}

} else {
    echo "<script type='text/javascript'> document.location = 'admin/list-house-holding'; </script>";
    exit();
}



?>


<script src="assets/js/jquery.js"></script>

<script>
    $(document).ready(function () {
        $("#submit-btn").click(function () {

            var idNumber = $("#idNumber").val().trim();
            var pinNumber = $("#pinNumber").val().trim();
            var cardStatus = $("#cardStatus").val().trim();
            var holdingType = $("#holdingType").val().trim();
            var personName = $("#personName").val().trim();

            if(idNumber == "" || pinNumber == "" || cardStatus == "" || holdingType == "" || personName == "") {

                alert("ফর্মটি সঠিকভাবে পূরণ করুন!");

            } else {

                $.ajax({
                    url: 'script/holding-single-data-update',
                    type: 'POST',
                    data: $('#holding-form-data').serialize(),
                    beforeSend: function () {
                        $("#submit-btn").html(
                            '<img src="assets/images/loader.gif" width="30" />');
                        $('#loader').show();
                        $('#delete-btn').hide();
                    },
                    success: function (data) {
                        $("#submit-btn").html('<i class="fa fa-save"></i> তথ্য সংশোধন করুন');
                        $('#response').fadeIn();
                        $('#response').html(data);
                        $('#holding-form-data').trigger("reset");
                        $("#holding-form-data").hide();
                        $("#form-delete-btn").hide();
                        $('#loader').hide();
                        $('#delete-btn').show();
                    }
                });
            }

        });
    });
</script>



<script>
    function showForm () {
        $('#holding-form-data').show();
        $('#form-delete-btn').show();
        $('#response').hide();
    }

</script>

<script>
    function add_more(){
        var box_count=jQuery("#box_count").val();
        box_count++;
        jQuery("#box_count").val(box_count);
        jQuery("#form-wrap").append('<table id="box_loop_'+box_count+'">' +
            '                    <tbody>' +
            '                    <tr>' +
            '                        <td>' +
            '                            <label>সন্তানের নামঃ</label>' +
            '                            <input type="text" name="pr'+box_count+'Name" value="">' +
            '                        </td>' +
            '                        <td>' +
            '                            <label>সন্তানের বয়সঃ</label>' +
            '                            <input type="text" name="pr'+box_count+'Age" value="">' +
            '                        </td>' +
            '                        <td>' +
            '                            <a onclick="remove_more('+box_count+')" class="delete-btn2" style="display:inline-block;margin: 0;margin-top: 25px;border-radius: 4px;"><i class="fa fa-trash"></i> বাতিল করুন</a>' +
            '                        </td>' +
            '                    </tr>' +
            '                    </tbody>' +
            '                </table>');
    }
    function remove_more(box_count){
        jQuery("#box_loop_"+box_count).remove();
        var box_count=jQuery("#box_count").val();
        box_count--;
        jQuery("#box_count").val(box_count);
    }
</script>

