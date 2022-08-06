<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (empty($_POST["formID"]) && empty($_POST["formType"])) {
        die();
    }

    include "../config/database-connection.php";

    $formID = $_POST["formID"];
    $formType = $_POST["formType"];

    $databaseTable = $formType.'_certificate_apply';

    $sql = "SELECT * FROM `$databaseTable` WHERE certificateID = '$formID'";
    $result = mysqli_query($db, $sql) or die("Not Found!");
    $output = '';


    if (mysqli_num_rows($result) == 1) {

        while ($row = mysqli_fetch_assoc($result)) {

            $bDate1=$row['birthDate'];
            $format_bDate1=date("d/m/Y",strtotime($bDate1));

            $bDate2=$row['deathDate'];
            $format_bDate2=date("d/m/Y",strtotime($bDate2));

            $paymentClass = $row['paymentStatus'] == 'Paid' ? 'paymentDone' : 'paymentDue';

            if ($formType == "character") {
                $formType2 = "চারিত্রিক সনদপত্র";
            }
            if ($formType == "unmarried") {
                $formType2 = "অবিবাহিত সনদপত্র";
            }
            if ($formType == "death") {
                $formType2 = "মৃত্যু তারিখের সনদপত্র";
            }
            if ($formType == "burial") {
                $formType2 = "দাফন সনদপত্র";
            }
            if ($formType == "legacy") {
                $formType2 = "ওয়ারিশনামা সনদপত্র";
            }
            if ($formType == "remarriage") {
                $formType2 = "পুনঃবিবাহ না হওয়া সনদপত্র";
            }

            if ($row['paymentStatus'] == 'Paid') {
                $downloadBtn = "<button onclick='getPDF()' class='edit-window' style='cursor: pointer; color: #23b14d; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;'><i class='fa fa-download'></i> ডাউনলোড করুন</button>";
            } else {
                $downloadBtn = "";
            }


            function banglaNumber($englishToBangla) {
                $englishNum=array("0","1","2","3","4","5",'6',"7","8","9","-");
                $banglaNum=array("০","১","২","৩","৪","৫",'৬',"৭","৮","৯","/");
                return str_replace($englishNum,$banglaNum,$englishToBangla);
            }


            $certificateID = banglaNumber($row['certificateID']);
            $applyDate = banglaNumber($row['applyDate']);
            $nidNo = banglaNumber($row['nidNo']);
            $birthDate = banglaNumber($format_bDate1);
            $wardNo = banglaNumber($row['wardNo']);
            $deathDate = banglaNumber($format_bDate2);




            if ($formType == "character") {
                $output = "
            
            
                    <table class='responstable'>
                    <tbody>
                    <tr>
                        <td>সার্টিফিকেট নাম্বার</td>
                        <td>{$row['certificateID']}</td>
                    </tr>
                    <tr>
                        <td>সার্টিফিকেট ধরণ</td>
                        <td>{$formType2}</td>
                    </tr>
                    <tr>
                        <td>আবেদনের তারিখ</td>
                        <td>{$row['applyDate']}</td>
                    </tr>
                    <tr>
                        <td>পেমেন্ট স্ট্যাটাস</td>
                        <td><a style='display: inline-block;' class='{$paymentClass}'>{$row['paymentStatus']}</a></td>
                    </tr>
                    <tr>
                        <td>সনদ তথ্য</td>
                        <td>
                            <b>নামঃ</b> {$row['fullName']}<br/>
                            <b>পিতা/স্বামীঃ</b> {$row['guardianName']}<br/>
                            <b>মাতাঃ</b> {$row['motherName']}<br/>
                            <b>জাতীয় পরিচয়পত্রঃ</b> {$row['nidNo']}<br/>
                            <b>জন্ম তারিখঃ</b> {$format_bDate1}<br/>
                            <b>গ্রাম/মহল্লাঃ</b> {$row['village']}<br/>
                            <b>ওয়ার্ডঃ</b> {$row['wardNo']}<br/>
                            <b>উপজেলাঃ</b> {$row['upozilla']}<br/>
                            <b>জেলাঃ</b> {$row['zilla']}<br/>
                        </td>
                    </tr>
                        <tr>
                            <td>আবেদনের ধরণ</td>
                            <td>{$row['applyType']}</td>
                        </tr>
                    <tr>
                        <td>সনদ ডাউনলোড</td>
                        <td>{$downloadBtn}</td>
                    </tr>
                    </tbody>
                </table>
                 
                 
                 <br/>
                    <div id='print-main-div'>
                <div style='border: 3px solid #1e2039;padding: 10px;'>
                    <div class='print-header-top'>
                        <p>স্মারক নংঃ ইউ/পরি/২০{$certificateID}</p>
                        <p>তারিখঃ {$applyDate} ইং</p>
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
        
                    <p style='text-align: center;margin-top: 80px;color: #1e2039;font-size: 52px;font-weight: bold;font-family: Bangla;'>চারিত্রিক সনদপত্র</p>
                    <p style='font-size: 24px;margin-top: 50px;padding: 0 80px;font-family: Bangla;'>
                        এই মর্মে প্রত্যয়ন করা যাচ্ছে যে,
                        নামঃ <b style='display: inline-block;padding: 0 10px;'>{$row['fullName']}</b>
                        পিতা/স্বামীঃ <b style='display: inline-block;padding: 0 10px;'>{$row['guardianName']}</b>
                        মাতাঃ <b style='display: inline-block;padding: 0 10px;'>{$row['motherName']}</b>
                        জাতীয় পরিচয়পত্রঃ <b style='display: inline-block;padding: 0 10px;'>{$nidNo}</b>
                        জন্ম তারিখঃ <b style='display: inline-block;padding: 0 10px;'>{$birthDate}</b>
                        গ্রাম/মহল্লাঃ <b style='display: inline-block;padding: 0 10px;'>{$row['village']}</b>
                        ওয়ার্ডঃ <b style='display: inline-block;padding: 0 10px;'>{$wardNo}</b>
                        উপজেলাঃ <b style='display: inline-block;padding: 0 10px;'>{$row['upozilla']}</b>
                        জেলাঃ <b style='display: inline-block;padding: 0 10px;'>{$row['zilla']}</b>।
                        <br/><br/>
                        তিনি মাদারগঞ্জ পৌরসভার <b>{$wardNo}</b> নং ওয়ার্ডের স্থায়ী বাসিন্দা। আমি তাকে চিনি এবং জানি। তিনি জন্মসূত্রে বাংলাদেশের নাগরিক। আমার জানামতে সে রাষ্ট্র বা সমাজ বিরোধী কোনো কাজে লিপ্ত নয়। তার নৈতিক চরিত্র ভালো।
                        <br/><br/><br/>
                        <a style='text-align: center;display: inline-block;'>আমি তার ভবিষ্যৎ জীবনের সার্বিক উন্নতি ও মঙ্গল কামনা করি।</a>
                    </p>
                    <div style='display: flex; justify-content: space-between;margin-top: 200px;margin-bottom: 50px;'>
                        <p></p>
                        <p style='text-align: center; font-size: 18px;width: 300px;font-family: Bangla;'>
                            <img src='assets/images/mayor-signature.jpg' height='50'/><br/><br/>
                            মেয়র<br/>
                            ইউনিয়ন পরিষদ<br/>
                        </p>
                    </div>
                </div>
            </div>
                     
                    
                ";

            }


            if ($formType == "unmarried") {
                $output = "
            
            
                    <table class='responstable'>
                    <tbody>
                    <tr>
                        <td>সার্টিফিকেট নাম্বার</td>
                        <td>{$row['certificateID']}</td>
                    </tr>
                    <tr>
                        <td>সার্টিফিকেট ধরণ</td>
                        <td>{$formType2}</td>
                    </tr>
                    <tr>
                        <td>আবেদনের তারিখ</td>
                        <td>{$row['applyDate']}</td>
                    </tr>
                    <tr>
                        <td>পেমেন্ট স্ট্যাটাস</td>
                        <td><a style='display: inline-block;' class='{$paymentClass}'>{$row['paymentStatus']}</a></td>
                    </tr>
                    <tr>
                        <td>সনদ তথ্য</td>
                        <td>
                            <b>নামঃ</b> {$row['fullName']}<br/>
                            <b>পিতা/স্বামীঃ</b> {$row['guardianName']}<br/>
                            <b>মাতাঃ</b> {$row['motherName']}<br/>
                            <b>জাতীয় পরিচয়পত্রঃ</b> {$row['nidNo']}<br/>
                            <b>জন্ম তারিখঃ</b> {$format_bDate1}<br/>
                            <b>গ্রাম/মহল্লাঃ</b> {$row['village']}<br/>
                            <b>ওয়ার্ডঃ</b> {$row['wardNo']}<br/>
                            <b>উপজেলাঃ</b> {$row['upozilla']}<br/>
                            <b>জেলাঃ</b> {$row['zilla']}<br/>
                        </td>
                    </tr>
                        <tr>
                            <td>আবেদনের ধরণ</td>
                            <td>{$row['applyType']}</td>
                        </tr>
                    <tr>
                        <td>সনদ ডাউনলোড</td>
                        <td>{$downloadBtn}</td>
                    </tr>
                    </tbody>
                </table>
                 
                 
                 <br/>
                    <div id='print-main-div'>
                <div style='border: 3px solid #1e2039;padding: 10px;'>
                    <div class='print-header-top'>
                        <p>স্মারক নংঃ মাদার/পৌর/অবি/স/{$certificateID}</p>
                        <p>তারিখঃ {$applyDate} ইং</p>
                    </div>
                    <div class='print-header'>
                        <div style='text-align: center;'>
                            <img src='assets/images/favicon.png' height='120' />
                            <p style='font-size:42px;font-weight:bold;'>মাদারগঞ্জ পৌরসভা, জামালপুর<br/>
                            <div style='font-size:18px;font-weight:400;text-align:center;'>
                                <a style='line-height: 25px;display:block;'>স্থাপিতঃ ১৯৯৯ খ্রীষ্টাব্দ</a>
                                <a style='line-height: 25px;display:block;'>ফোনঃ ০৯৮২-৫৫৬২২৭</a>
                            </div>
                            </p>
                        </div>
                    </div>
        
                    <p style='text-align: center;margin-top: 80px;color: #1e2039;font-size: 52px;font-weight: bold;font-family: Bangla;'>অবিবাহিত সনদপত্র</p>
                    <p style='font-size: 24px;margin-top: 50px;padding: 0 80px;font-family: Bangla;'>
                        এই মর্মে প্রত্যয়ন করা যাচ্ছে যে,
                        নামঃ <b style='display: inline-block;padding: 0 10px;'>{$row['fullName']}</b>
                        পিতা/স্বামীঃ <b style='display: inline-block;padding: 0 10px;'>{$row['guardianName']}</b>
                        মাতাঃ <b style='display: inline-block;padding: 0 10px;'>{$row['motherName']}</b>
                        জাতীয় পরিচয়পত্রঃ <b style='display: inline-block;padding: 0 10px;'>{$nidNo}</b>
                        জন্ম তারিখঃ <b style='display: inline-block;padding: 0 10px;'>{$birthDate}</b>
                        গ্রাম/মহল্লাঃ <b style='display: inline-block;padding: 0 10px;'>{$row['village']}</b>
                        ওয়ার্ডঃ <b style='display: inline-block;padding: 0 10px;'>{$wardNo}</b>
                        উপজেলাঃ <b style='display: inline-block;padding: 0 10px;'>{$row['upozilla']}</b>
                        জেলাঃ <b style='display: inline-block;padding: 0 10px;'>{$row['zilla']}</b>।
                        <br/><br/>
                        তিনি মাদারগঞ্জ পৌরসভার <b>{$wardNo}</b> নং ওয়ার্ডের স্থায়ী বাসিন্দা। আমি তাকে চিনি এবং জানি। তিনি জন্মসূত্রে বাংলাদেশের নাগরিক। আমার জানামতে সে কোনো বিবাহ বন্ধনে আবদ্ধ হয় নাই। তার নৈতিক চরিত্র ভালো।
                        <br/><br/><br/>
                        <a style='text-align: center;display: inline-block;'>আমি তার ভবিষ্যৎ জীবনের সার্বিক উন্নতি ও মঙ্গল কামনা করি।</a>
                    </p>
                    <div style='display: flex; justify-content: space-between;margin-top: 200px;margin-bottom: 50px;'>
                        <p></p>
                        <p style='text-align: center; font-size: 18px;width: 300px;font-family: Bangla;'>
                            <img src='assets/images/mayor-signature.jpg' height='50'/><br/><br/>
                            মেয়র<br/>
                            মাদারগঞ্জ পৌরসভা<br/>
                            মাদারগঞ্জ, জামালপুর<br/>
                        </p>
                    </div>
                </div>
            </div>
                     
                    
                ";

            }


            if ($formType == "death") {
                $output = "
            
            
                    <table class='responstable'>
                    <tbody>
                    <tr>
                        <td>সার্টিফিকেট নাম্বার</td>
                        <td>{$row['certificateID']}</td>
                    </tr>
                    <tr>
                        <td>সার্টিফিকেট ধরণ</td>
                        <td>{$formType2}</td>
                    </tr>
                    <tr>
                        <td>আবেদনের তারিখ</td>
                        <td>{$row['applyDate']}</td>
                    </tr>
                    <tr>
                        <td>পেমেন্ট স্ট্যাটাস</td>
                        <td><a style='display: inline-block;' class='{$paymentClass}'>{$row['paymentStatus']}</a></td>
                    </tr>
                    <tr>
                        <td>সনদ তথ্য</td>
                        <td>
                            <b>নামঃ</b> {$row['fullName']}<br/>
                            <b>পিতা/স্বামীঃ</b> {$row['guardianName']}<br/>
                            <b>মাতাঃ</b> {$row['motherName']}<br/>
                            <b>জাতীয় পরিচয়পত্রঃ</b> {$row['nidNo']}<br/>
                            <b>জন্ম তারিখঃ</b> {$format_bDate1}<br/>
                            <b>গ্রাম/মহল্লাঃ</b> {$row['village']}<br/>
                            <b>ওয়ার্ডঃ</b> {$row['wardNo']}<br/>
                            <b>উপজেলাঃ</b> {$row['upozilla']}<br/>
                            <b>জেলাঃ</b> {$row['zilla']}<br/>
                            <b>মৃত্যু তারিখঃ</b> {$format_bDate2}<br/>
                        </td>
                    </tr>
                        <tr>
                            <td>আবেদনের ধরণ</td>
                            <td>{$row['applyType']}</td>
                        </tr>
                    <tr>
                        <td>সনদ ডাউনলোড</td>
                        <td>{$downloadBtn}</td>
                    </tr>
                    </tbody>
                </table>
                 
                 
                 <br/>
                    <div id='print-main-div'>
                <div style='border: 3px solid #1e2039;padding: 10px;'>
                    <div class='print-header-top'>
                        <p>স্মারক নংঃ মাদার/পৌর/মৃ/তা/স/{$certificateID}</p>
                        <p>তারিখঃ {$applyDate} ইং</p>
                    </div>
                    <div class='print-header'>
                        <div style='text-align: center;'>
                            <img src='assets/images/favicon.png' height='120' />
                            <p style='font-size:42px;font-weight:bold;'>মাদারগঞ্জ পৌরসভা, জামালপুর<br/>
                            <div style='font-size:18px;font-weight:400;text-align:center;'>
                                <a style='line-height: 25px;display:block;'>স্থাপিতঃ ১৯৯৯ খ্রীষ্টাব্দ</a>
                                <a style='line-height: 25px;display:block;'>ফোনঃ ০৯৮২-৫৫৬২২৭</a>
                            </div>
                            </p>
                        </div>
                    </div>
        
                    <p style='text-align: center;margin-top: 80px;color: #1e2039;font-size: 52px;font-weight: bold;font-family: Bangla;'>মৃত্যু তারিখের সনদপত্র</p>
                    <p style='font-size: 24px;margin-top: 50px;padding: 0 80px;font-family: Bangla;'>
                        এই মর্মে প্রত্যয়ন করা যাচ্ছে যে,
                        নামঃ <b style='display: inline-block;padding: 0 10px;'>{$row['fullName']}</b>
                        পিতা/স্বামীঃ <b style='display: inline-block;padding: 0 10px;'>{$row['guardianName']}</b>
                        মাতাঃ <b style='display: inline-block;padding: 0 10px;'>{$row['motherName']}</b>
                        জাতীয় পরিচয়পত্রঃ <b style='display: inline-block;padding: 0 10px;'>{$nidNo}</b>
                        জন্ম তারিখঃ <b style='display: inline-block;padding: 0 10px;'>{$birthDate}</b>
                        গ্রাম/মহল্লাঃ <b style='display: inline-block;padding: 0 10px;'>{$row['village']}</b>
                        ওয়ার্ডঃ <b style='display: inline-block;padding: 0 10px;'>{$wardNo}</b>
                        উপজেলাঃ <b style='display: inline-block;padding: 0 10px;'>{$row['upozilla']}</b>
                        জেলাঃ <b style='display: inline-block;padding: 0 10px;'>{$row['zilla']}</b>।
                        <br/><br/>
                        তিনি মাদারগঞ্জ পৌরসভার <b>{$wardNo}</b> নং ওয়ার্ডের স্থায়ী বাসিন্দা। আমি তাকে চিনি এবং জানি। আমার জানামতে তিনি গত <b style='display: inline-block;padding: 0 10px;'>{$deathDate}</b> ইং তারিখে ইন্তেকাল করেন (ইন্নালিল্লাহি ওয়া ইন্না ইলাইহি রাজি’উন)। মৃত ব্যক্তিকে তার পারিবারিক গোরস্থানে দাফন করা হয়।
                        <br/><br/><br/>
                        <a style='text-align: center;display: inline-block;'>আমি তার বিদেহী আত্মার মাগফিরাত কামনা করি।</a>
                    </p>
                    <div style='display: flex; justify-content: space-between;margin-top: 200px;margin-bottom: 50px;'>
                        <p></p>
                        <p style='text-align: center; font-size: 18px;width: 300px;font-family: Bangla;'>
                            <img src='assets/images/mayor-signature.jpg' height='50'/><br/><br/>
                            মেয়র<br/>
                            মাদারগঞ্জ পৌরসভা<br/>
                            মাদারগঞ্জ, জামালপুর<br/>
                        </p>
                    </div>
                </div>
            </div>
                     
                    
                ";

            }


            if ($formType == "burial") {
                $output = "
            
            
                    <table class='responstable'>
                    <tbody>
                    <tr>
                        <td>সার্টিফিকেট নাম্বার</td>
                        <td>{$row['certificateID']}</td>
                    </tr>
                    <tr>
                        <td>সার্টিফিকেট ধরণ</td>
                        <td>{$formType2}</td>
                    </tr>
                    <tr>
                        <td>আবেদনের তারিখ</td>
                        <td>{$row['applyDate']}</td>
                    </tr>
                    <tr>
                        <td>পেমেন্ট স্ট্যাটাস</td>
                        <td><a style='display: inline-block;' class='{$paymentClass}'>{$row['paymentStatus']}</a></td>
                    </tr>
                    <tr>
                        <td>সনদ তথ্য</td>
                        <td>
                            <b>নামঃ</b> {$row['fullName']}<br/>
                            <b>পিতা/স্বামীঃ</b> {$row['guardianName']}<br/>
                            <b>মাতাঃ</b> {$row['motherName']}<br/>
                            <b>জাতীয় পরিচয়পত্রঃ</b> {$row['nidNo']}<br/>
                            <b>জন্ম তারিখঃ</b> {$format_bDate1}<br/>
                            <b>গ্রাম/মহল্লাঃ</b> {$row['village']}<br/>
                            <b>ওয়ার্ডঃ</b> {$row['wardNo']}<br/>
                            <b>উপজেলাঃ</b> {$row['upozilla']}<br/>
                            <b>জেলাঃ</b> {$row['zilla']}<br/>
                            <b>মৃত্যু তারিখঃ</b> {$format_bDate2}<br/>
                        </td>
                    </tr>
                        <tr>
                            <td>আবেদনের ধরণ</td>
                            <td>{$row['applyType']}</td>
                        </tr>
                    <tr>
                        <td>সনদ ডাউনলোড</td>
                        <td>{$downloadBtn}</td>
                    </tr>
                    </tbody>
                </table>
                 
                 
                 <br/>
                    <div id='print-main-div'>
                <div style='border: 3px solid #1e2039;padding: 10px;'>
                    <div class='print-header-top'>
                        <p>স্মারক নংঃ মাদার/পৌর/দা/স/{$certificateID}</p>
                        <p>তারিখঃ {$applyDate} ইং</p>
                    </div>
                    <div class='print-header'>
                        <div style='text-align: center;'>
                            <img src='assets/images/favicon.png' height='120' />
                            <p style='font-size:42px;font-weight:bold;'>মাদারগঞ্জ পৌরসভা, জামালপুর<br/>
                            <div style='font-size:18px;font-weight:400;text-align:center;'>
                                <a style='line-height: 25px;display:block;'>স্থাপিতঃ ১৯৯৯ খ্রীষ্টাব্দ</a>
                                <a style='line-height: 25px;display:block;'>ফোনঃ ০৯৮২-৫৫৬২২৭</a>
                            </div>
                            </p>
                        </div>
                    </div>
        
                    <p style='text-align: center;margin-top: 80px;color: #1e2039;font-size: 52px;font-weight: bold;font-family: Bangla;'>দাফন সনদপত্র</p>
                    <p style='font-size: 24px;margin-top: 50px;padding: 0 80px;font-family: Bangla;'>
                        এই মর্মে প্রত্যয়ন করা যাচ্ছে যে,
                        নামঃ <b style='display: inline-block;padding: 0 10px;'>{$row['fullName']}</b>
                        পিতা/স্বামীঃ <b style='display: inline-block;padding: 0 10px;'>{$row['guardianName']}</b>
                        মাতাঃ <b style='display: inline-block;padding: 0 10px;'>{$row['motherName']}</b>
                        জাতীয় পরিচয়পত্রঃ <b style='display: inline-block;padding: 0 10px;'>{$nidNo}</b>
                        জন্ম তারিখঃ <b style='display: inline-block;padding: 0 10px;'>{$birthDate}</b>
                        গ্রাম/মহল্লাঃ <b style='display: inline-block;padding: 0 10px;'>{$row['village']}</b>
                        ওয়ার্ডঃ <b style='display: inline-block;padding: 0 10px;'>{$wardNo}</b>
                        উপজেলাঃ <b style='display: inline-block;padding: 0 10px;'>{$row['upozilla']}</b>
                        জেলাঃ <b style='display: inline-block;padding: 0 10px;'>{$row['zilla']}</b>।
                        <br/><br/>
                        তিনি মাদারগঞ্জ পৌরসভার <b>{$wardNo}</b> নং ওয়ার্ডের স্থায়ী বাসিন্দা। আমি তাকে চিনি এবং জানি। আমার জানামতে তিনি গত <b style='display: inline-block;padding: 0 10px;'>{$deathDate}</b> ইং তারিখে ইন্তেকাল করেন (ইন্নালিল্লাহি ওয়া ইন্না ইলাইহি রাজি’উন)। মৃত ব্যক্তিকে তার পারিবারিক গোরস্থানে দাফন করা হয়।
                        <br/><br/><br/>
                        <a style='text-align: center;display: inline-block;'>আমি তার বিদেহী আত্মার মাগফিরাত কামনা করি।</a>
                    </p>
                    <div style='display: flex; justify-content: space-between;margin-top: 200px;margin-bottom: 50px;'>
                        <p></p>
                        <p style='text-align: center; font-size: 18px;width: 300px;font-family: Bangla;'>
                            <img src='assets/images/mayor-signature.jpg' height='50'/><br/><br/>
                            মেয়র<br/>
                            মাদারগঞ্জ পৌরসভা<br/>
                            মাদারগঞ্জ, জামালপুর<br/>
                        </p>
                    </div>
                </div>
            </div>
                     
                    
                ";

            }


            if ($formType == "legacy") {
                $output .= "
            
            
                    <table class='responstable'>
                    <tbody>
                    <tr>
                        <td>সার্টিফিকেট নাম্বার</td>
                        <td>{$row['certificateID']}</td>
                    </tr>
                    <tr>
                        <td>সার্টিফিকেট ধরণ</td>
                        <td>{$formType2}</td>
                    </tr>
                    <tr>
                        <td>আবেদনের তারিখ</td>
                        <td>{$row['applyDate']}</td>
                    </tr>
                    <tr>
                        <td>পেমেন্ট স্ট্যাটাস</td>
                        <td><a style='display: inline-block;' class='{$paymentClass}'>{$row['paymentStatus']}</a></td>
                    </tr>
                    <tr>
                        <td>সনদ তথ্য</td>
                        <td>
                            <b>নামঃ</b> মৃত {$row['fullName']}<br/>
                            <b>পিতা/স্বামীঃ</b> {$row['guardianName']}<br/>
                            <b>গ্রাম/মহল্লাঃ</b> {$row['village']}<br/>
                            <b>ওয়ার্ডঃ</b> {$row['wardNo']}<br/>
                            <b>পৌরসভাঃ</b> {$row['pouroshova']}<br/>
                            <b>জেলাঃ</b> {$row['zilla']}<br/>
                        ";


                        $sqlPr = "SELECT * FROM legacy_certificate_apply_heredity WHERE (linkedForm = '$row[linkedForm]' AND linkedCertificate = '$row[certificateID]') ORDER BY id ASC";
                        $resultPr = mysqli_query($db, $sqlPr);

                        if (mysqli_num_rows($resultPr) > 0) {

                            $output .= "
                    <br/>
                    <h3 style='font-family:Bangla;color: #5e5e5e;border-bottom:1px solid #cccccc;'>ওয়ারিশগণঃ</h3>
                    <table>
                        <tbody>
                        <tr>
                            <th>ক্রমিক নং</th>
                            <th>নাম</th>
                            <th>মৃত ব্যক্তির সাথে সম্পর্ক</th>
                        </tr>
                        ";
                        while ($rowPr = mysqli_fetch_assoc($resultPr)) {

                            $ic2 = ($ic2+1);
                            $ic2b = banglaNumber($ic2);
                            $output .="
                        <tr>
                            <td>{$ic2b}</td>
                            <td>{$rowPr['personName']}</td>
                            <td>{$rowPr['relationType']}</td>
                        </tr>
                        ";

                        }

                        $output .= "
                        </tbody>
                        </table>
                        ";

                        }

                $output .="
                        </td>
                    </tr>
                        <tr>
                            <td>আবেদনের ধরণ</td>
                            <td>{$row['applyType']}</td>
                        </tr>
                    <tr>
                        <td>সনদ ডাউনলোড</td>
                        <td>{$downloadBtn}</td>
                    </tr>
                    </tbody>
                </table>
                 
                 
                 <br/>
                    <div id='print-main-div'>
                <div style='border: 3px solid #1e2039;padding: 10px;'>
                    <div class='print-header-top'>
                        <p>স্মারক নংঃ মাদার/পৌর/ওয়ারি/স/{$certificateID}</p>
                        <p>তারিখঃ {$applyDate} ইং</p>
                    </div>
                    <div class='print-header'>
                        <div style='text-align: center;'>
                            <img src='assets/images/favicon.png' height='120' />
                            <p style='font-size:42px;font-weight:bold;'>মাদারগঞ্জ পৌরসভা, জামালপুর<br/>
                            <div style='font-size:18px;font-weight:400;text-align:center;'>
                                <a style='line-height: 25px;display:block;'>স্থাপিতঃ ১৯৯৯ খ্রীষ্টাব্দ</a>
                                <a style='line-height: 25px;display:block;'>ফোনঃ ০৯৮২-৫৫৬২২৭</a>
                            </div>
                            </p>
                        </div>
                    </div>
        
                    <p style='text-align: center;margin-top: 80px;color: #1e2039;font-size: 52px;font-weight: bold;font-family: Bangla;'>ওয়ারিশনামা সনদপত্র</p>
                    <p style='font-size: 24px;margin-top: 50px;padding: 0 80px;font-family: Bangla;'>
                        এই মর্মে প্রত্যয়ন করা যাচ্ছে যে,
                        নামঃ <b style='display: inline-block;padding: 0 10px;'>{$row['fullName']}</b>
                        পিতা/স্বামীঃ <b style='display: inline-block;padding: 0 10px;'>{$row['guardianName']}</b>
                        গ্রাম/মহল্লাঃ <b style='display: inline-block;padding: 0 10px;'>{$row['village']}</b>
                        ওয়ার্ডঃ <b style='display: inline-block;padding: 0 10px;'>{$wardNo}</b>
                        পৌরসভাঃ <b style='display: inline-block;padding: 0 10px;'>{$row['pouroshova']}</b>
                        জেলাঃ <b style='display: inline-block;padding: 0 10px;'>{$row['zilla']}</b>।
                        আমার জানামতে এবং সংশ্লিষ্ট ওয়ার্ড কাউন্সিলরের প্রদত্ত বিবরণের ভিত্তিতে মৃত্যুকালে তিনি নিম্ন বর্ণিত ওয়ারিশগণকে রেখে গেছেন।
                    </p>
                    ";


                $sqlPr = "SELECT * FROM legacy_certificate_apply_heredity WHERE (linkedForm = '$row[linkedForm]' AND linkedCertificate = '$row[certificateID]') ORDER BY id ASC";
                $resultPr = mysqli_query($db, $sqlPr);

                if (mysqli_num_rows($resultPr) > 0) {

                    $output .= "
                    <br/>
                    <div class='certificateTable'>
                    <table>
                        <tbody>
                        <tr>
                            <th>ক্রমিক নং</th>
                            <th>নাম</th>
                            <th>মৃত ব্যক্তির সাথে সম্পর্ক</th>
                        </tr>
                        ";
                    while ($rowPr = mysqli_fetch_assoc($resultPr)) {

                        $ip2 = ($ip2+1);
                        $ip2b = banglaNumber($ip2);
                        $output .="
                        <tr>
                            <td>{$ip2b}</td>
                            <td>{$rowPr['personName']}</td>
                            <td>{$rowPr['relationType']}</td>
                        </tr>
                        ";

                    }

                    $output .= "
                        </tbody>
                        </table>
                        </div>
                        ";

                }



                    $output .="
                    <br/><br/><br/><br/>
                    <p style='font-size: 24px;padding: 0 80px;font-family: Bangla;'>
                        <a style='text-align: center;display: inline-block;'>আমি তার বিদেহী আত্মার মাগফিরাত কামনা করি।</a>
                    </p>
                    <div style='display: flex; justify-content: space-between;margin-top: 100px;margin-bottom: 50px;'>
                        <p></p>
                        <p style='text-align: center; font-size: 18px;width: 300px;font-family: Bangla;'>
                            <img src='assets/images/mayor-signature.jpg' height='50'/><br/><br/>
                            মেয়র<br/>
                            মাদারগঞ্জ পৌরসভা<br/>
                            মাদারগঞ্জ, জামালপুর<br/>
                        </p>
                    </div>
                </div>
            </div>
                     
                    
                ";

            }


            if ($formType == "remarriage") {
                $output = "
            
            
                    <table class='responstable'>
                    <tbody>
                    <tr>
                        <td>সার্টিফিকেট নাম্বার</td>
                        <td>{$row['certificateID']}</td>
                    </tr>
                    <tr>
                        <td>সার্টিফিকেট ধরণ</td>
                        <td>{$formType2}</td>
                    </tr>
                    <tr>
                        <td>আবেদনের তারিখ</td>
                        <td>{$row['applyDate']}</td>
                    </tr>
                    <tr>
                        <td>পেমেন্ট স্ট্যাটাস</td>
                        <td><a style='display: inline-block;' class='{$paymentClass}'>{$row['paymentStatus']}</a></td>
                    </tr>
                    <tr>
                        <td>সনদ তথ্য</td>
                        <td>
                            <b>নামঃ</b> {$row['fullName']}<br/>
                            <b>পিতা/স্বামীঃ</b> {$row['guardianName']}<br/>
                            <b>মাতাঃ</b> {$row['motherName']}<br/>
                            <b>জাতীয় পরিচয়পত্রঃ</b> {$row['nidNo']}<br/>
                            <b>জন্ম তারিখঃ</b> {$format_bDate1}<br/>
                            <b>গ্রাম/মহল্লাঃ</b> {$row['village']}<br/>
                            <b>ওয়ার্ডঃ</b> {$row['wardNo']}<br/>
                            <b>উপজেলাঃ</b> {$row['upozilla']}<br/>
                            <b>জেলাঃ</b> {$row['zilla']}<br/>
                        </td>
                    </tr>
                        <tr>
                            <td>আবেদনের ধরণ</td>
                            <td>{$row['applyType']}</td>
                        </tr>
                    <tr>
                        <td>সনদ ডাউনলোড</td>
                        <td>{$downloadBtn}</td>
                    </tr>
                    </tbody>
                </table>
                 
                 
                 <br/>
                    <div id='print-main-div'>
                <div style='border: 3px solid #1e2039;padding: 10px;'>
                    <div class='print-header-top'>
                        <p>স্মারক নংঃ মাদার/পৌর/পুনঃবি/না/হ/স/{$certificateID}</p>
                        <p>তারিখঃ {$applyDate} ইং</p>
                    </div>
                    <div class='print-header'>
                        <div style='text-align: center;'>
                            <img src='assets/images/favicon.png' height='120' />
                            <p style='font-size:42px;font-weight:bold;'>মাদারগঞ্জ পৌরসভা, জামালপুর<br/>
                            <div style='font-size:18px;font-weight:400;text-align:center;'>
                                <a style='line-height: 25px;display:block;'>স্থাপিতঃ ১৯৯৯ খ্রীষ্টাব্দ</a>
                                <a style='line-height: 25px;display:block;'>ফোনঃ ০৯৮২-৫৫৬২২৭</a>
                            </div>
                            </p>
                        </div>
                    </div>
        
                    <p style='text-align: center;margin-top: 80px;color: #1e2039;font-size: 52px;font-weight: bold;font-family: Bangla;'>পুনঃবিবাহ না হওয়ার সনদপত্র</p>
                    <p style='font-size: 24px;margin-top: 50px;padding: 0 80px;font-family: Bangla;'>
                        এই মর্মে প্রত্যয়ন করা যাচ্ছে যে,
                        নামঃ <b style='display: inline-block;padding: 0 10px;'>{$row['fullName']}</b>
                        পিতা/স্বামীঃ <b style='display: inline-block;padding: 0 10px;'>{$row['guardianName']}</b>
                        মাতাঃ <b style='display: inline-block;padding: 0 10px;'>{$row['motherName']}</b>
                        জাতীয় পরিচয়পত্রঃ <b style='display: inline-block;padding: 0 10px;'>{$nidNo}</b>
                        জন্ম তারিখঃ <b style='display: inline-block;padding: 0 10px;'>{$birthDate}</b>
                        গ্রাম/মহল্লাঃ <b style='display: inline-block;padding: 0 10px;'>{$row['village']}</b>
                        ওয়ার্ডঃ <b style='display: inline-block;padding: 0 10px;'>{$wardNo}</b>
                        উপজেলাঃ <b style='display: inline-block;padding: 0 10px;'>{$row['upozilla']}</b>
                        জেলাঃ <b style='display: inline-block;padding: 0 10px;'>{$row['zilla']}</b>।
                        <br/><br/>
                        তিনি মাদারগঞ্জ পৌরসভার <b>{$wardNo}</b> নং ওয়ার্ডের স্থায়ী বাসিন্দা। আমি তাকে চিনি এবং জানি। আমার জানামতে তিনি পুনরায় কোনো বিবাহ বন্ধনে আবদ্ধ হন নাই।
                        <br/><br/><br/>
                        <a style='text-align: center;display: inline-block;'>আমি তার ভবিষ্যৎ জীবনের সার্বিক উন্নতি ও মঙ্গল কামনা করি।</a>
                    </p>
                    <div style='display: flex; justify-content: space-between;margin-top: 200px;margin-bottom: 50px;'>
                        <p></p>
                        <p style='text-align: center; font-size: 18px;width: 300px;font-family: Bangla;'>
                            <img src='assets/images/mayor-signature.jpg' height='50'/><br/><br/>
                            মেয়র<br/>
                            মাদারগঞ্জ পৌরসভা<br/>
                            মাদারগঞ্জ, জামালপুর<br/>
                        </p>
                    </div>
                </div>
            </div>
                     
                    
                ";

            }








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