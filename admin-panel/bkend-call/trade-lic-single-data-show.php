<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (empty($_POST["formID"])) {
        die();
    }

    include "../config/database-connection.php";

    $formID = $_POST["formID"];

    $sql = "SELECT * FROM trade_license_database WHERE formID = {$formID}";
    $result = mysqli_query($db, $sql) or die("Not Found!");
    $output = '';

    $year = date("Y");
    $date = date("d/m/Y");

    if (mysqli_num_rows($result) == 1) {

        while ($row = mysqli_fetch_assoc($result)) {

            if (!empty($row['haveLicense'])) {
                $showBoxText = "আছে";
            } else {
                $showBoxText = "নাই";
            }

            $rNewDate1=$row['lastRenew'];
            $format_rNewDate=date("d/m/Y",strtotime($rNewDate1));

            $output .= "
            <img style='display:none;' src='assets/images/watermark.png' />
            <div class='print-header'>
            <img src='assets/images/logo-site.jpg' height='80' />
            <div style='margin-left:20%;'>
                <p style='font-size:24px;font-weight:bold;'>ইউনিয়ন পরিষদ<br/>
                    <div style='font-size:14px;font-weight:400;text-align:center;'>
                        <a style='line-height: 15px;display:block;'>স্থাপিতঃ xxxx ইং</a>
                        <a style='line-height: 15px;display:block;'>ফোনঃ xxxx-xxxxxx</a>
                    </div>
                </p>
            </div>
            </div>
            <div class='print-header-bottom'>
                <p>স্মারক নংঃ ইউ/পরি/২০</p>
                <p>তারিখঃ {$date} ইং</p>
            </div>
            
            <h3 style='font-family: Bangla; text-decoration: underline;'>কার্ড সংক্রান্ত তথ্যঃ</h3>
            <table style='margin-top: -5px;'>
                 <tbody>
                <tr>
                    <td>
                        <label>কার্ড নাম্বারঃ</label>
                        <input type='text' name='idNumber' id='idNumber' autocomplete='off' disabled value='{$row['idNumber']}'>
                    </td>
                    <td>
                        <label>পিন নাম্বারঃ</label>
                        <input type='text' name='pinNumber' id='idNumber' autocomplete='off' disabled value='{$row['pinNumber']}'>
                    </td>
                    <td>
                        <label>কার্ড স্ট্যাটাসঃ</label>
                        <input type='text' name='cardStatus' id='cardStatus' autocomplete='off' disabled value='{$row['cardStatus']}'>
                    </td>
                </tr>
                </tbody>
            </table>
            
            <br/>
            <h3 style='font-family: Bangla; text-decoration: underline;'>সাধারণ তথ্যঃ</h3>
            <table style='margin-top: 0px;'>
                <tbody>
                    <tr>
                        <td>
                            <label>ট্রেড লাইসেন্স করা আছে?</label>
                            <div style='display: flex;'>
                                <input type='checkbox' name='haveLicense' id='haveLicense' {$row['haveLicense']}>
                                <a style='margin-left: 5px;font-family: Bangla;font-size: 16px;'>({$showBoxText})</a>
                            </div>
                        </td>
                        <td>
                            <label>ট্রেড লাইসেন্স নংঃ</label>
                            <input type='text' name='tradeLicense' id='tradeLicense' autocomplete='off' disabled value='{$row['tradeLicense']}'>
                        </td>
                        <td>
                            <label>ক্রমিক নংঃ</label>
                            <input type='text' name='serialNo' autocomplete='off' disabled value='{$row['serialNo']}'>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>শেষ নবায়নের তারিখঃ (দিন/মাস/সাল)</label>
                            <input type='text' name='lastRenew' id='lastRenew' autocomplete='off' disabled value='{$format_rNewDate}'>
                        </td>
                        <td>
                            <label>ট্রেড লাইসেন্স পরিচিত নংঃ</label>
                            <input type='text' name='tradeLicIntroNo' autocomplete='off' disabled value='{$row['tradeLicIntroNo']}'>
                        </td>
                        <td>
                            <label>ব্যবসা প্রতিষ্ঠানের নামঃ</label>
                            <input type='text' name='businessName' autocomplete='off' disabled value='{$row['businessName']}'>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>প্রোপাইটরের নামঃ</label>
                            <input type='text' name='proprietorName' autocomplete='off' disabled value='{$row['proprietorName']}'>
                        </td>
                        <td>
                            <label>পিতার নামঃ</label>
                            <input type='text' name='fatherName' autocomplete='off' disabled value='{$row['fatherName']}'>
                        </td>
                        <td>
                            <label>মাতার নামঃ</label>
                            <input type='text' name='motherName' autocomplete='off' disabled value='{$row['motherName']}'>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>ব্যবসা প্রতিষ্ঠানের ঠিকানাঃ</label>
                            <input type='text' name='address' autocomplete='off' disabled value='{$row['address']}'>
                        </td>
                        <td>
                            <label>মোবাইল নাম্বারঃ</label>
                            <input type='text' name='mobile' autocomplete='off' disabled value='{$row['mobile']}'>
                        </td>
                        <td>
                            <label>জাতীয় পরিচয় পত্র নম্বরঃ</label>
                            <input type='text' name='nidNo' autocomplete='off' disabled value='{$row['nidNo']}'>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>ব্যবসার ধরণঃ</label>
                            <select name='businessType'>
                                <option value='{$row['businessType']}' selected>{$row['businessType']}</option>
                            </select>
                        </td>
                        <td>
                            <label>ট্রেড লাইসেন্স ফিঃ (বার্ষিক)</label>
                            <input type='text' name='tradeLicFee' autocomplete='off' disabled value='{$row['tradeLicFee']}'>
                        </td>
                        <td>
                            <label>সাইনবোর্ড করঃ (বার্ষিক)</label>
                            <input type='text' name='signboardTax' autocomplete='off' disabled value='{$row['signboardTax']}'>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>ভ্যাটঃ</label>
                            <input type='text' name='totalTax' autocomplete='off' disabled value='{$row['totalTax']}'>
                        </td>
                        <td>
                            <label>সর্বমোট টাকাঃ</label>
                            <input type='text' name='totalAmount' autocomplete='off' disabled value='{$row['totalAmount']}'>
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            
            <br/>
            
            <h3 style='font-family: Bangla; text-decoration: underline;'>ঠিকানাঃ</h3>
            <table>
                <tbody>
                    <tr>
                        <td>
                            <label>ওয়ার্ড নংঃ</label>
                            <input type='text' name='wardNo' autocomplete='off' disabled value='{$row['wardNo']}'>
                        </td>
                        <td>
                            <label>গ্রামঃ</label>
                            <input type='text' name='village' autocomplete='off' disabled value='{$row['village']}'>
                        </td>
                        <td>
                            <label>পোস্টাল কোড/ জিপ কোডঃ</label>
                            <input type='text' name='zip' autocomplete='off' disabled value='{$row['zip']}'>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>ডাকঘরঃ</label>
                            <input type='text' name='post' autocomplete='off' disabled value='{$row['post']}'>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        
        
        ";

        }

        echo $output;
    } else {
        echo "<div style='margin-top: 200px; text-align: center;'><p style='font-size: 24px; color: #cccccc;'><i class='fa fa-warning fa-2x''></i><br/>Empty</p></div>";
        exit();
    }


} else {
    exit();
}


?>