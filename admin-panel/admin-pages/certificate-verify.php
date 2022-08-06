
<?php
if ($_SESSION['admin_role'] != "admin") {
    echo "<script type='text/javascript'> document.location = 'admin/dashboard'; </script>";
}
?>


<script>
    document.title = 'সনদপত্র ভেরিফাই - ইউনিয়ন পরিষদ';
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
</style>

<div class="content-body-main-div">

    <p class="page-direction"><i class="fa fa-link"></i> নাগরিক সেবা / সনদপত্র ভেরিফাই /</p>

    <div class="admin-dashboard-content-div">
        <h2 style="font-family:'Bangla';color: #5e5e5e;border-bottom:1px solid #5e5e5e;">সনদপত্র ভেরিফাই করুনঃ</h2>

        <br/>
        <table class="responstable">
            <tbody>
                <tr>
                    <td>
                        <label>সনদপত্রের ধরণঃ</label>
                        <select name="certificateType" id="certificateType">
                            <option value="" selected>-- নির্বাচন করুন --</option>
                            <option value="character">চারিত্রিক সনদপত্র</option>
                            <option value="unmarried">অবিবাহিত সনদপত্র</option>
                            <option value="death">মৃত্যু তারিখের সনদপত্র</option>
                            <option value="burial">দাফন সনদপত্র</option>
                            <option value="legacy">ওয়ারিশনামা সনদপত্র</option>
                            <option value="remarriage">পুনঃবিবাহ না হওয়া সনদপত্র</option>
                        </select>
                    </td>
                    <td>
                        <label>সার্টিফিকেট নাম্বারঃ</label>
                        <input type="text" name="certificateNumber" id="certificateNumber" autocomplete="off" value="">
                    </td>
                    <td>
                        <label>&nbsp;</label>
                        <button type="button" name="submit-btn" id="submit-btn" class="add-btn2"><i class="fa fa-search"></i> ভেরিফাই করুন</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <br/><br/>

        <div id="response"></div>

        <!--
        <table class="responstable" style="max-width: 900px;border: 1px solid #5b86e5;">
            <tbody>
                <tr>
                    <td style="font-weight: bold;">ভেরিফিকেশন স্ট্যাটাস</td>
                    <td><a style="color: #23b14d;font-weight: bold;"><i class="fa fa-check"></i> ভেরিফিকেশন সম্পন্ন</a></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">সনদপত্রের ধরণ</td>
                    <td>চারিত্রিক সনদপত্র</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">সার্টিফিকেট নাম্বার</td>
                    <td>5345643674</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">আবেদনকারীর নাম</td>
                    <td>বি, এম, শাহ্‌রিয়ার কবির</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">আবেদনের তারিখ</td>
                    <td>17-04-2022</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">আবেদনের ধরণ</td>
                    <td>জরুরি</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">পেমেন্ট স্ট্যাটাস</td>
                    <td>Paid</td>
                </tr>
            </tbody>
        </table>
        -->


    </div>

</div>




<script src="assets/js/jquery.js"></script>

<script>
    $(document).ready(function () {
        $("#submit-btn").click(function () {

            var certificateType = $("#certificateType").val().trim();
            var certificateNumber = $("#certificateNumber").val().trim();

            if(certificateType == "" || certificateNumber == "") {

                alert("ফর্মটি সঠিকভাবে পূরণ করুন!");

            } else {

                $.ajax({
                    url: 'script/certificate-verification',
                    type: 'POST',
                    data: {
                        certificateType: certificateType,
                        certificateNumber: certificateNumber
                    },
                    beforeSend: function () {
                        $('#loader').show();
                    },
                    success: function (data) {
                        $("#submit-btn").html('<i class="fa fa-search"></i> ভেরিফাই করুন');
                        $('#response').fadeIn();
                        $('#response').html(data);
                        $('#loader').hide();
                    }
                });

            }

        });
    });
</script>

