<?php

if (empty($_POST["operatorID"])) {
    echo "<script type='text/javascript'> document.location = 'admin/dashboard'; </script>";
    die();
}

include "../config/database-connection.php";

$operatorID = $_POST["operatorID"];
?>

<script>
    document.title = 'অপারেটর ডাটা এন্ট্রি - ইউনিয়ন পরিষদ';
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
</style>


<div class="content-body-main-div">

    <p class="page-direction"><i class="fa fa-link"></i> ড্যাশবোর্ড / অপারেটর ডাটা এন্ট্রি /</p>

    <div class="dashboard-table-container">
        <?php
        function banglaNumber($englishToBangla) {
            $englishNum=array("0","1","2","3","4","5",'6',"7","8","9","-");
            $banglaNum=array("০","১","২","৩","৪","৫",'৬',"৭","৮","৯","/");
            return str_replace($englishNum,$banglaNum,$englishToBangla);
        }

        require ('config/database-connection.php');
        $sqlr = "SELECT * FROM house_holding_database WHERE dataEntryBy='$operatorID' ORDER BY id ASC";
        $resultr = mysqli_query($db, $sqlr);
        $countr = mysqli_num_rows($resultr);

        $sqlrOperator = "SELECT * FROM user_admin WHERE user_id='$operatorID'";
        $resultrOperator = mysqli_query($db, $sqlrOperator);
        $rowrOperator = mysqli_fetch_array($resultrOperator, MYSQLI_ASSOC)
        ?>
        <p class="dashboard-table-container-heading"><?php echo $rowrOperator['full_name'] ?> (<?php echo banglaNumber($countr); ?> টি ডাটা)</p>

            <table class="responstable">
                <tbody>
                <?php
                if ($countr > 0) {
                ?>
                    <tr>
                        <th>কার্ড নাম্বার</th>
                        <th>সুবিধাভোগীর নাম</th>
                        <th>পিতা/ স্বামীর নাম</th>
                        <th>পরিচয় পত্র নাম্বার</th>
                        <th>মোবাইল নাম্বার</th>
                        <th class="printDisplayNone">অ্যাকশন</th>
                    </tr>
                <?php
                while ($rowr = mysqli_fetch_array($resultr, MYSQLI_ASSOC)) {

                    $dataEntry = "SELECT full_name FROM user_admin WHERE user_id='$rowr[dataEntryBy]'";
                    $dataEntryResult = mysqli_query($db, $dataEntry);
                    $dataEntryRow = mysqli_fetch_array($dataEntryResult, MYSQLI_ASSOC);
                ?>
                    <tr title="Entry By: <?php echo $dataEntryRow['full_name']; ?>">
                        <td><?php echo banglaNumber($rowr['idNumber']) ?></td>
                        <td><?php echo $rowr['personName'] ?></td>
                        <td><?php echo $rowr['guardianName'] ?></td>
                        <td><?php echo banglaNumber($rowr['idNo']) ?></td>
                        <td><?php echo banglaNumber($rowr['mobile']) ?></td>
                        <td class="printDisplayNone">
                            <button class="view-window" data-formid="<?php echo $rowr['formID'] ?>" style="cursor: pointer; color: #FFFFFF; background: #007CC7; height: auto; border: 1px solid #007CC7; margin: 0; width: auto; padding: 0 5px;border-radius: 2px;font-size: 14px;">দেখুন</button>
                            <?php
                            if ($user_role == "admin" OR $user_id == $rowr['dataEntryBy']) {
                                ?>
                                <form method="post" action="admin/update-house-holding" style="display: inline-block;">
                                    <input type="hidden" name="formID" value="<?php echo $rowr['formID'] ?>">
                                    <button onclick="LoaderShow()" type="submit" class="edit-window" data-formid="<?php echo $rowr['formID'] ?>" style="cursor: pointer; color: #FFFFFF; background: #23b14d; height: auto; border: 1px solid #23b14d; margin: 0; width: auto;padding: 0 5px;border-radius: 2px;font-size: 14px;">সংশোধন করুন</button>
                                </form>
                                <?php
                            }
                            ?>

                        </td>
                    </tr>
                    <?php
                }
                } else {
                    echo "<p style='font-size: 16px;font-family: Bangla;text-align: center;padding: 50px 0;font-style: italic;color: #ff3333;'><i class='fa fa-warning'></i> কোনো তথ্য পাওয়া যায় নি!</p>";
                }
                ?>
                </tbody>
            </table>

    </div>

</div>


<div class="modal">
    <div class="modal-form">
        <a class="modal-title" style="padding: 5px"><p style="margin-top: 5px; padding: 0 5px; display: inline-block; color: #5b86e5; font-weight: 600;font-size: 16px; font-family: 'Bangla';">বসত বাড়ী হোল্ডিং তথ্য</p>
            <button class="print-btn" onclick="printContent('details');" style="margin: 0;"><i class="fa fa-print"></i> প্রিন্ট করুন</button>
            <div class="close-btn">X</div>
        </a>
        <div class="ajax_loader" style="margin-top: 15%;">
            <img src="assets/images/loading.gif" alt="loading icon">
        </div>
        <div id="details">

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on("click", ".view-window", function() {
        document.body.style.overflow = "hidden";
        $(".modal").fadeIn('fast');
        var formID = $(this).data("formid");

        $.ajax({
            url: "script/holding-single-data-show",
            type: "POST",
            data: {
                formID: formID
            },
            beforeSend: function() {
                $('.ajax_loader').show();
                $('#details').hide();
            },
            success: function(data) {
                $(".modal-form #details").html(data);
                $('.ajax_loader').hide();
                $('#details').show();
            }
        })
    });

    $(".close-btn").on("click", function() {
        $(".modal").fadeOut('fast');
        document.body.style.overflow = "auto";
    });


    var modal = document.querySelector('.modal')
    window.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            $(".modal").fadeOut('fast');
            document.body.style.overflow = "auto";
        }
    })

</script>

<script>
    function printContent(el) {

        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;

        $(".close-btn").on("click", function() {
            $(".modal").fadeOut('fast');
            document.body.style.overflow = "auto";
        });

        $(document).ready(function() {
            $('.sub-btn').click(function() {
                $(this).next('.sub-menu').slideToggle();
            });
        });
    }
</script>


