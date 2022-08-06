
<?php
if ($_SESSION['admin_role'] != "admin") {
    echo "<script type='text/javascript'> document.location = 'admin/dashboard'; </script>";
}
?>


<script>
    document.title = 'হোল্ডিং নবায়ন - ইউনিয়ন পরিষদ';
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
</style>

<div class="content-body-main-div">

    <p class="page-direction"><i class="fa fa-link"></i> নাগরিক সেবা / হোল্ডিং নবায়ন /</p>

    <div class="admin-dashboard-content-div">
        <h2 style="font-family:'Bangla';color: #5e5e5e;border-bottom:1px solid #5e5e5e;">হোল্ডিং নবায়ন সেবাঃ</h2>

        <br/>
        <table class="responstable">
            <tbody>
            <tr>
                <td>
                    <label>নাগরিক কার্ড নাম্বারঃ</label>
                    <input type="text" name="citizenCardNo" id="citizenCardNo" autocomplete="off" value="" autofocus>
                </td>
                <td>
                    <label>&nbsp;</label>
                    <button type="button" name="search-btn" id="search-btn" class="add-btn2"><i class="fa fa-search"></i> তথ্য দেখুন</button>
                </td>
            </tr>
            </tbody>
        </table>




        <div id="response"></div>




    </div>

</div>



<script src="assets/js/jquery.js"></script>

<script>
    $(document).ready(function () {
        $("#search-btn").click(function () {

            var citizenCardNo = $("#citizenCardNo").val().trim();

            if(citizenCardNo == "") {

                alert("ফর্মটি সঠিকভাবে পূরণ করুন!");

            } else {

                $.ajax({
                    url: 'script/renew-house-holding-script-step1',
                    type: 'POST',
                    data: {
                        citizenCardNo: citizenCardNo
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


