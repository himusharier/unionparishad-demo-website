<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    include "../config/database-connection.php";

    if (isset($_POST["formID"]) && isset($_POST["tradeID"])) {

        $formID = strip_tags($_POST['formID']);
        $formID = htmlspecialchars($formID);
        $formID = mysqli_real_escape_string($db, $formID);

        $tradeID = strip_tags($_POST['tradeID']);
        $tradeID = htmlspecialchars($tradeID);
        $tradeID = mysqli_real_escape_string($db, $tradeID);

        if ($formID != "" && $tradeID != "") {

            $sql_query = "SELECT * FROM renew_trade_licence_database WHERE (linkedForm='$formID' AND renewTradeID = '$tradeID')";
            $result = mysqli_query($db, $sql_query);
            $count = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);

            if ($count == 1) {

                    echo "
                <div class='dashboard-table-container' style='margin-top: 25px;'>
            <p class='dashboard-table-container-heading'>ট্রেড লাইসেন্স নবায়ন তথ্য সংশোধন</p>
            <div class='dashboard-table-container-div'>
                <table>
                    <tbody>
                    <tr>
                        <td>
                            <label>নামঃ<i style='color: red;'>*</i></label>
                            <input type='text' name='fullName' id='fullName' autocomplete='off' value='{$row['fullName']}' readonly>
                        </td>
                        <td>
                            <label>মোবাইলঃ<i style='color: red;'>*</i></label>
                            <input type='text' name='mobile' id='mobile' autocomplete='off' value='{$row['mobile']}' readonly>
                        </td>
                        <td>
                            <label>নবায়নের শুরুর তারিখঃ<i style='color: red;'>*</i></label>
                            <input type='date' name='renewStartDate' id='renewStartDate' autocomplete='off' value='{$row['renewStartDate']}'>
                        </td>
                        <td>
                            <label>নবায়নের শেষের তারিখঃ<i style='color: red;'>*</i></label>
                            <input type='date' name='renewEndDate' id='renewEndDate' autocomplete='off' value='{$row['renewEndDate']}'>
                        </td>
                     </tr>
                     <tr>
                        <td>
                            <label>ট্রেড লাইসেন্স নংঃ<i style='color: red;'>*</i></label>
                            <input type='text' name='tradeLicNo' id='tradeLicNo' autocomplete='off' value='{$row['tradeLicNo']}' readonly>
                        </td>
                        <td>
                            <label>ব্যবসা প্রতিষ্ঠানের নামঃ<i style='color: red;'>*</i></label>
                            <input type='text' name='businessName' id='businessName' autocomplete='off' value='{$row['businessName']}' readonly>
                        </td>
                        <td>
                            <label>ব্যবসার ধরণঃ<i style='color: red;'>*</i></label>
                            <select name='businessType' id='businessType'>
                                <option value='{$row['businessType']}' selected>{$row['businessType']}</option>
                                <option value='কাপড়ের দোকান'>কাপড়ের দোকান</option>
                                <option value='মুদির দোকান'>মুদির দোকান</option>
                                <option value='ফার্নিচার মার্ট'>ফার্নিচার মার্ট</option>
                                <option value='ইলেকট্রনিকস দোকান'>ইলেকট্রনিকস দোকান</option>
                                <option value='প্রযুক্তি দোকান'>প্রযুক্তি দোকান</option>
                                <option value='সেলুন'>সেলুন</option>
                                <option value='স্টুডিও'>স্টুডিও</option>
                                <option value='হোটেল'>হোটেল</option>
                                <option value='রেস্টুরেন্ট'>রেস্টুরেন্ট</option>
                                <option value='মোটরের খুচরা যন্ত্রাংশের'>মোটরের খুচরা যন্ত্রাংশের</option>
                                <option value='দর্জি দোকান'>দর্জি দোকান</option>
                                <option value='টাইলস দোকান'>টাইলস দোকান</option>
                                <option value='বেড়ার দোকান'>বেড়ার দোকান</option>
                                <option value='বিউটি পার্লার'>বিউটি পার্লার</option>
                                <option value='পোলট্রি ফিড'>পোলট্রি ফিড</option>
                                <option value='টিভি ফ্রিজ এবং অন্যান্য সামগ্রীর মেরামতে দোকান'>টিভি ফ্রিজ এবং অন্যান্য সামগ্রীর মেরামতে দোকান</option>
                                <option value='সি এন জি অটো পার্টস'>সি এন জি অটো পার্টস</option>
                                <option value='ইন্জিনিয়ারিং মেটাল ওয়ার্কস'>ইন্জিনিয়ারিং মেটাল ওয়ার্কস</option>
                                <option value='রড় সিমেন্ট দোকান'>রড় সিমেন্ট দোকান</option>
                                <option value='গ্যারেজ'>গ্যারেজ</option>
                                <option value='হোটেল (বড়)'>হোটেল (বড়)</option>
                                <option value='চা দোকান'>চা দোকান</option>
                                <option value='কুলিং কর্ণার'>কুলিং কর্ণার</option>
                                <option value='মিষ্টি দোকান'>মিষ্টি দোকান</option>
                                <option value='এ্যালমুনিয়াম এর দোকানএ্যালমুনিয়াম এর দোকান'>এ্যালমুনিয়াম এর দোকান</option>
                                <option value='কাঠমিস্ত্রীর দোকান'>কাঠমিস্ত্রীর দোকান</option>
                                <option value='টিভি ফ্রিজ এর দোকান'>টিভি ফ্রিজ এর দোকান</option>
                                <option value='সি এন জি গ্যারেজ'>সি এন জি গ্যারেজ</option>
                                <option value='হার্ডওয়ার'>হার্ডওয়ার</option>
                                <option value='ডাব ও নারিকেল বিক্রেত'>ডাব ও নারিকেল বিক্রেতা</option>
                                <option value='লাকড়ি দোকান'>লাকড়ি দোকান</option>
                                <option value='ইন্জিনিয়ারিং ওয়ার্কসপ'>ইন্জিনিয়ারিং ওয়ার্কসপ</option>
                                <option value='ট্রাভেল এজেন্সি'>ট্রাভেল এজেন্সি</option>
                                <option value='ফার্মেসী (বড়)'>ফার্মেসী (বড়)</option>
                                <option value='স্টুডিও'>স্টুডিও</option>
                                <option value='কার্টন বিক্রেতা'>কার্টন বিক্রেতা</option>
                                <option value='ডিপার্টমেন্টাল ষ্টোর'>ডিপার্টমেন্টাল ষ্টোর</option>
                                <option value='কনফেকশনারী'>কনফেকশনারী</option>
                                <option value='টেলিকম সেন্টার'>টেলিকম সেন্টার</option>
                                <option value='কম্পিউটার কম্পোজ'>কম্পিউটার কম্পোজ</option>
                                <option value='পুষ্প বিতান'>পুষ্প বিতান</option>
                                <option value='লাইব্রেরি'>লাইব্রেরি</option>
                                <option value='হোমিও ফার্মেসী'>হোমিও ফার্মেসী</option>
                                <option value='স্যানিটারী দোকান'>স্যানিটারী দোকান</option>
                                <option value='কাঠের আসবাবপত্র দোকান কারখানা'>কাঠের আসবাবপত্র দোকান কারখানা</option>
                                <option value='ডেকোরেটার্স'>ডেকোরেটার্স</option>
                                <option value='ফার্মেসী (ছোট)'>ফার্মেসী (ছোট)</option>
                                <option value='হোটেল (ছোট)'>হোটেল (ছোট)</option>
                                <option value='ফ্যাক্স ফোন ও কুরিয়া সার্ভিস'>ফ্যাক্স ফোন ও কুরিয়া সার্ভিস</option>
                                <option value='ফানির্চার দোকান'>ফানির্চার দোকান</option>
                                <option value='বাঁশের দোকান'>বাঁশের দোকান</option>
                                <option value='জুতার দোকান'>জুতার দোকান</option>
                                <option value='স্বর্ণের দোকা'>স্বর্ণের দোকান</option>
                                <option value='সাইকেলের দোকান'>সাইকেলের দোকান</option>
                                <option value='কসমেটিকের দোকান'>কসমেটিকের দোকান</option>
                                <option value='ডিমের আরত'>ডিমের আরত</option>
                                <option value='চালের আরত'>চালের আরত</option>
                                <option value='চাউল দোকান'>চাউল দোকান</option>
                                <option value='সার ,বীজ ও কীটনাশক, রড, সিমেন্ট ও হার্ডওয়ার'>সার ,বীজ ও কীটনাশক, রড, সিমেন্ট ও হার্ডওয়ার</option>
                                <option value='কোকারিজ'>কোকারিজ</option>
                                <option value='ফলের দোকান'>ফলের দোকান</option>
                                <option value='মোটরসাইকেল গ্যারেজ'>মোটরসাইকেল গ্যারেজ</option>
                                <option value='মিষ্টি দোকান'>মিষ্টি দোকান</option>
                                <option value='বিরিয়ানির দোকান'>বিরিয়ানির দোকান</option>
                                <option value='ফার্মেসী ছোট'>ফার্মেসী ছোট</option>
                                <option value='কসমেটিক্স ছোট'>কসমেটিক্স ছোট</option>
                                <option value='জুয়েলারী কারিগর'>জুয়েলারী কারিগর</option>
                                <option value='জুয়েলারি দোকান মাঝারি'>জুয়েলারি দোকান মাঝারি</option>
                                <option value='জুয়েলারি দোকান মাঝারি'>জুয়েলারি দোকান মাঝারি</option>
                                <option value='সীসার বাতিলের দোকান'>সীসার বাতিলের দোকান</option>
                                <option value='ছোট টং দোকান'>ছোট টং দোকান</option>
                                <option value='হোটেল ছোট'>হোটেল ছোট</option>
                                <option value='চা দোকান'>চা দোকান</option>
                                <option value='হোটেল এন্ড রেস্টুরেন্ট'>হোটেল এন্ড রেস্টুরেন্ট</option>
                                <option value='কাপড়ের দোকান (ছোট)'>কাপড়ের দোকান (ছোট)</option>
                                <option value='মুদি দোকান (ছোট)'>মুদি দোকান (ছোট)</option>
                                <option value='ফার্মেসী'>ফার্মেসী</option>
                                <option value='টাইলস দোকান'>টাইলস দোকান</option>
                                <option value='হার্ডওয়ার দোকান'>হার্ডওয়ার দোকান</option>
                                <option value='লাইব্রেরি'>লাইব্রেরি</option>
                                <option value='চশমা দোকান'>চশমা দোকান</option>
                                <option value='টেলিকম দোকান'>টেলিকম দোকান</option>
                                <option value='কৃষি বীজ উৎপাদন ও বিক্রয়'>কৃষি বীজ উৎপাদন ও বিক্রয়</option>
                                <option value='শঙ্খ জাত দ্রব্য বিক্রেতা'>শঙ্খ জাত দ্রব্য বিক্রেতা</option>
                                <option value='পাটর্স এর দোকান'>পাটর্স এর দোকান</option>
                                <option value='চটপট্রি ফোচকার দোকান'>চটপট্রি ফোচকার দোকান</option>
                                <option value='মাছের ব্যবসা'>মাছের ব্যবসা</option>
                                <option value='সবজির দোকান'>সবজির দোকান</option>
                                <option value='শাড়ির দোকান'>শাড়ির দোকান</option>
                                <option value='মোবাইল সার্ভিসিং এন্ড গিফট সেন্টার'>মোবাইল সার্ভিসিং এন্ড গিফট সেন্টার</option>
                                <option value='বেডিং'>বেডিং</option>
                                <option value='সরবরাহকারী প্রতিষ্ঠান'>সরবরাহকারী প্রতিষ্ঠান</option>
                                <option value='রেস্তোরাঁ (মাঝারি)'>রেস্তোরাঁ (মাঝারি)</option>
                                <option value='ডিস ক্যাবল সংযোগকারী ব্যবসায় প্রতিষ্ঠান'>ডিস ক্যাবল সংযোগকারী ব্যবসায় প্রতিষ্ঠান</option>
                                <option value='বাদ্যযন্ত্র বিক্রেতা'>বাদ্যযন্ত্র বিক্রেতা</option>
                                <option value='জাল দোকান'>জাল দোকান</option>
                                <option value='জলিলনগর বাসস্ট্যান্ড'>জলিলনগর বাসস্ট্যান্ড</option>
                                <option value='মিষ্টির দোকান ছোট'>মিষ্টির দোকান ছোট</option>
                                <option value='সাধারণ রেস্তোরা (মাঝারি)'>সাধারণ রেস্তোরা (মাঝারি)</option>
                                <option value='মেট্রেস হাউসে'>মেট্রেস হাউসে</option>
                                <option value='মোবাইল সার্ভিসিং'>মোবাইল সার্ভিসিং</option>
                                <option value='সুতার ব্যবসা ছোট'>সুতার ব্যবসা ছোট</option>
                                <option value='কলার দোকান ছোট'>কলার দোকান ছোট</option>
                                <option value='মুরগির দোকান ছোট'>মুরগির দোকান ছোট</option>
                                <option value='কনফিশনারী ছোট'>কনফিশনারী ছোট</option>
                                <option value='ইলেকট্রিক ছোট'>ইলেকট্রিক ছোট</option>
                                <option value='পান-সিগারেটের দোকান'>পান-সিগারেটের দোকান</option>
                                <option value='ওয়েল্ডিং ওয়াকসপ'>ওয়েল্ডিং ওয়াকসপ</option>
                                <option value='মুড়ির দোকান'>মুড়ির দোকান</option>
                                <option value='মুড়ির আরত'>মুড়ির আরত</option>
                                <option value='অটোমোবাইল মেরামত কারখানা (ছোট)'>অটোমোবাইল মেরামত কারখানা (ছোট)</option>
                                <option value='টায়ার পাংচার ছোট'>টায়ার পাংচার ছোট</option>
                                <option value='ওয়ালিং ইঞ্জিনিয়ারিং'>ওয়ালিং ইঞ্জিনিয়ারিং</option>
                                <option value='ডায়াগনস্টিক সেন্টার'>ডায়াগনস্টিক সেন্টার</option>
                                <option value='প্যাথলজিক্যাল বা ডায়াগনস্টিক সেন্টার (ছোট)'>প্যাথলজিক্যাল বা ডায়াগনস্টিক সেন্টার (ছোট)</option>
                                <option value='সুপার ড্রাই ক্লিনার্স'>সুপার ড্রাই ক্লিনার্স</option>
                                <option value='স্টিলের আলমারি ছোট'>স্টিলের আলমারি ছোট</option>
                                <option value='তেল, গ্যাসের বোতল বিক্রেতা, ছোট'>তেল, গ্যাসের বোতল বিক্রেতা, ছোট</option>
                                <option value='স্টেশনারি দোকান'>স্টেশনারি দোকান</option>
                                <option value='বিয়ে, বউভাত, আকিকা, মেজবান ও সেমিনার সহ'>বিয়ে, বউভাত, আকিকা, মেজবান ও সেমিনার সহ</option>
                                <option value='ডেইরি ফার্ম'>ডেইরি ফার্ম</option>
                                <option value='পশু-পাখি খাবার বিক্রয়ের দোকান'>পশু-পাখি খাবার বিক্রয়ের দোকান</option>
                                <option value='ফিভ ও চিকস বিত্রেতা'>ফিভ ও চিকস বিত্রেতা</option>
                                <option value='গ্লাস বিক্রেতা'>গ্লাস বিক্রেতা</option>
                                <option value='শেরোয়ানী হাউস'>শেরোয়ানী হাউস</option>
                                <option value='কম্পিউটার কম্পোজ'>কম্পিউটার কম্পোজ</option>
                                <option value='মসলা মিলিং'>মসলা মিলিং</option>
                                <option value='কনফেকশনারী'>কনফেকশনারী</option>
                                <option value='ফুল/ফলের দোকান'>ফুল/ফলের দোকান</option>
                                <option value='পোল্ট্রি ফিড এন্ড মেডিসিন ছোট'>পোল্ট্রি ফিড এন্ড মেডিসিন ছোট</option>
                                <option value='কাপড়ের দোকান বড়'>কাপড়ের দোকান বড়</option>
                                <option value='কাপড়ের দোকান ছোট'>কাপড়ের দোকান ছোট</option>
                                <option value='মাইক সার্ভিস'>মাইক সার্ভিস</option>
                                <option value='ইন্টারনেট সংযোগদান'>ইন্টারনেট সংযোগদান</option>
                                <option value='সাইকেল গ্যারেজ (ছোট)'>সাইকেল গ্যারেজ (ছোট)</option>
                                <option value='বেকারী কারখানা (ছোট)'>বেকারী কারখানা (ছোট)</option>
                                <option value='ডেকোরেটর এর দোকান'>ডেকোরেটর এর দোকান</option>
                                <option value='হাঁস মুরগির দোকান'>হাঁস মুরগির দোকান</option>
                                <option value='মাইকের দোকান'>মাইকের দোকান</option>
                                <option value='সার, বীজ, শু বালাইনাশক'>সার, বীজ, শু বালাইনাশক</option>
                                <option value='গ্যাস সিলিনডার এন্ড সিমেন্ট দোকান'>গ্যাস সিলিনডার এন্ড সিমেন্ট দোকান</option>
                                <option value='ব্যাটারির দোকান'>ব্যাটারির দোকান</option>
                                <option value='টেইলার্স'>টেইলার্স</option>
                                <option value='জালানী তেলের দোকান'>জালানী তেলের দোকান</option>
                                <option value='এস্কেরাফ ব্যবসা'>এস্কেরাফ ব্যবসা</option>
                                <option value='ভাংগা ছুরা পুরাতন টিন, লোহা, প্লাস্টিক ক্র&zwj;য় ব্যবসা'>ভাংগা ছুরা পুরাতন টিন, লোহা, প্লাস্টিক ক্র&zwj;য় ব্যবসা</option>
                                <option value='ঢেউটিন প্লেন সেট'>ঢেউটিন প্লেন সেট</option>
                                <option value='মোবাইল ফোন বিক্রতা'>মোবাইল ফোন বিক্রতা</option>
                                <option value='ঝালাই মেরামত দোকান'>ঝালাই মেরামত দোকান</option>
                                <option value='রসুনের, সবজি পাইকারি দোকান'>রসুনের, সবজি পাইকারি দোকান</option>
                            </select>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>ট্রেড লাইসেন্স ফিঃ<i style='color: red;'>*</i></label>
                            <input type='text' name='tradeLicFee' id='tradeLicFee' autocomplete='off' value='{$row['tradeLicFee']}'>
                        </td>
                        <td>
                            <label>সাইনবোর্ড করঃ<i style='color: red;'>*</i></label>
                            <input type='text' name='signboardTax' id='signboardTax' autocomplete='off' value='{$row['signboardTax']}'>
                        </td>
                        <td>
                            <label>ভ্যাটঃ<i style='color: red;'>*</i></label>
                            <input type='text' name='totalTax' id='totalTax' autocomplete='off' value='{$row['totalTax']}'>
                        </td>
                        <td>
                            <label>সর্বমোট টাকাঃ<i style='color: red;'>*</i></label>
                            <input type='text' name='totalAmount' id='totalAmount' autocomplete='off' value='{$row['totalAmount']}'>
                        </td>
                        </tr>
                    </tbody>
                </table>
        
            <input type='hidden' name='linkedForm' id='linkedForm' value='{$row['linkedForm']}'>
            <input type='hidden' name='renewTradeID' id='renewTradeID' value='{$row['renewTradeID']}'>
        <button style='margin-bottom: 10px;' type='button' name='submit-btn' id='submit-btn'><i class='fa fa-save'></i> সংশোধন করুন</button>
        <button style='margin-bottom: 10px;' type='button' name='delete-btn' id='delete-btn' class='delete-btn'><i class='fa fa-trash'></i> বাতিল করুন</button>
            </div>
        </div>
        ";






                echo "
        <script>
    $(document).ready(function () {
        $('#submit-btn').click(function () {
            
            var fullName = $('#fullName').val().trim();
            var mobile = $('#mobile').val().trim();
            var renewStartDate = $('#renewStartDate').val().trim();
            var renewEndDate = $('#renewEndDate').val().trim();
            var tradeLicNo = $('#tradeLicNo').val().trim();
            var businessName = $('#businessName').val().trim();
            var businessType = $('#businessType').val().trim();
            var tradeLicFee = $('#tradeLicFee').val().trim();
            var signboardTax = $('#signboardTax').val().trim();
            var totalTax = $('#totalTax').val().trim();
            var totalAmount = $('#totalAmount').val().trim();
            var linkedForm = $('#linkedForm').val().trim();
            var renewTradeID = $('#renewTradeID').val().trim();

            if(fullName == '' || mobile == '' || renewStartDate == '' || renewEndDate == '' || tradeLicNo == '' || businessName == '' || businessType == '' || tradeLicFee == '' || signboardTax == '' || totalTax == '' || totalAmount == '' || linkedForm == '' || renewTradeID == '') {

                alert('ফর্মটি সঠিকভাবে পূরণ করুন!');

            } else {

                $.ajax({
                    url: 'script/renew-trade-licence-script-step-edit-2',
                    type: 'POST',
                    data: {
                        fullName: fullName,
                        mobile: mobile,
                        renewStartDate: renewStartDate,
                        renewEndDate: renewEndDate,
                        tradeLicNo: tradeLicNo,
                        businessName: businessName,
                        businessType: businessType,
                        tradeLicFee: tradeLicFee,
                        signboardTax: signboardTax,
                        totalTax: totalTax,
                        totalAmount: totalAmount,
                        linkedForm: linkedForm,
                        renewTradeID: renewTradeID
                    },
                    beforeSend: function () {
                        $('#loader').show();
                    },
                    success: function (data) {
                        $('#response').fadeIn();
                        $('#response').html(data);
                        $('#loader').hide();
                    }
                });
                
                } 
            
        });
    });
        </script>
        ";




                echo "
        <script>
    $(document).ready(function () {
        $('#delete-btn').click(function () {
            
            
            var conf = confirm('আপনি কি এই তথ্যটি বাতিল করতে চান?');
            
            if (conf === true) {
            
            var linkedForm = $('#linkedForm').val().trim();
            var renewTradeID = $('#renewTradeID').val().trim();

            if(linkedForm == '' || renewTradeID == '') {

                alert('ফর্মটি সঠিকভাবে পূরণ করুন!');

            } else {

                $.ajax({
                    url: 'script/renew-trade-licence-script-step-edit-delete',
                    type: 'POST',
                    data: {
                        linkedForm: linkedForm,
                        renewTradeID: renewTradeID
                    },
                    beforeSend: function () {
                        $('#loader').show();
                    },
                    success: function (data) {
                        $('#response').fadeIn();
                        $('#response').html(data);
                        $('#loader').hide();
                    }
                });
                
                } 
            
            }
            
            
            
        });
    });
        </script>
        ";



                exit();

            } else {
                echo "<br/><br/><div class='error_msg'><i style='font-size: 26px;' class='fa fa-warning'></i><br/>আইডি নাম্বারটি খুঁজে পাওয়া যায় নি!</div>";
                exit();
            }

        } else {
            echo "<br/><br/><div class='error_msg'>সবগুলো তথ্য সঠিকভাবে দিন!</div>";
            exit();
        }

    }


    if (!isset($_POST["formID"]) && !isset($_POST["allowID"])) {
        exit();
    }


} else {
    include "../not-found.php";
    exit();
}


?>