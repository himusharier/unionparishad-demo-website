<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if(isset($_POST['perPageLimit'])){


        function clean_inputs($data)
        {
            include "config/database-connection.php";
            $data = htmlspecialchars($data);
            $data = stripslashes($data);
            $data = trim($data);
            $data = mysqli_real_escape_string($db, $data);
            return $data;
        }

        if (clean_inputs($_POST['perPageLimit']) == "100") {
            $_SESSION['perPageLimit'] = "100";
            echo "<script type='text/javascript'> document.location = 'admin/allowance-list'; </script>";
        }
        elseif (clean_inputs($_POST['perPageLimit']) == "300") {
            $_SESSION['perPageLimit'] = "300";
            echo "<script type='text/javascript'> document.location = 'admin/allowance-list'; </script>";
        }
        elseif (clean_inputs($_POST['perPageLimit']) == "500") {
            $_SESSION['perPageLimit'] = "500";
            echo "<script type='text/javascript'> document.location = 'admin/allowance-list'; </script>";
        } else {
            $_SESSION['perPageLimit'] = clean_inputs($_POST['perPageLimit']);
            echo "<script type='text/javascript'> document.location = 'admin/allowance-list'; </script>";
        }

    }
} else {
    if (isset($_SESSION['perPageLimit'])) {
        $perPageLimit = $_SESSION['perPageLimit'];

    } else {
        $perPageLimit = 100;
    }
}

?>

<script>
    document.title = 'ভাতা ভোগী তথ্য তালিকা - ইউনিয়ন পরিষদ';
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

    <p class="page-direction"><i class="fa fa-link"></i> ড্যাশবোর্ড / ভাতা ভোগী তথ্য তালিকা /</p>

    <div class="dashboard-table-container">

        <?php
        function banglaNumber($englishToBangla) {
            $englishNum=array("0","1","2","3","4","5",'6',"7","8","9","-");
            $banglaNum=array("০","১","২","৩","৪","৫",'৬',"৭","৮","৯","/");
            return str_replace($englishNum,$banglaNum,$englishToBangla);
        }

        require ('config/database-connection.php');

        $results_per_page = $perPageLimit; // number of results per page

        if (isset($_GET['page'])) {
            function clean_inputs($data)
            {
                include "config/database-connection.php";
                $data = htmlspecialchars($data);
                $data = stripslashes($data);
                $data = trim($data);
                $data = mysqli_real_escape_string($db, $data);
                return $data;
            }

            $get_page = clean_inputs($_GET['page']);
        } else {
            $get_page = null;
        }

        if (isset($get_page)) { $page = $get_page; } else { $page=1; };
        $start_from = ($page-1) * $results_per_page;

        $sqlr = "SELECT * FROM house_holding_database WHERE allowanceType>'' ORDER BY id ASC LIMIT {$start_from}, ".$results_per_page;
        $resultr = mysqli_query($db, $sqlr);
        $countr = mysqli_num_rows($resultr);

        $sqlr2Count = "SELECT * FROM house_holding_database WHERE allowanceType>''";
        $resultr2Count = mysqli_query($db, $sqlr2Count);
        $countr2Count = mysqli_num_rows($resultr2Count);

        $totalCounter = $countr; /* + $countr2 */
        ?>

        <p class="dashboard-table-container-heading">ভাতা ভোগী তথ্য তালিকা (<?php echo banglaNumber($countr2Count); ?> জন)</p>
        <table class="responstable">
            <tbody>

        <?php
        if ($totalCounter > 0) {
        ?>
                <tr>
                    <th>কার্ড নাম্বার</th>
                    <th>সুবিধাভোগীর নাম</th>
                    <th>ভাতার ধরণ</th>
                    <th>ভাতার পরিমাণ</th>
                    <!--<th>কার্ড নাম্বার</th>-->
                    <th>পরিচয় পত্র নাম্বার</th>
                    <th>মোবাইল নাম্বার</th>
                    <th class="printDisplayNone">অন্যান্য</th>
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
                        <td><?php echo $rowr['allowanceType'] ?></td>
                        <td><?php echo banglaNumber($rowr['allowanceAmount']) ?></td>
                        <!--<td></td>-->
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
                ?>
                <?php
                } else {
                echo "<p style='font-size: 16px;font-family: Bangla;text-align: center;padding: 50px 0;font-style: italic;color: #ff3333;'><i class='fa fa-warning'></i> কোনো তথ্য পাওয়া যায় নি!</p>";
                }
                ?>
                </tbody>
            </table>

    </div>

    <?php
    if ($totalCounter > 0) {
    ?>
    <div class="bottom-pagination">
        <?php
        $sqlpn = "SELECT COUNT(id) AS total FROM house_holding_database WHERE allowanceType>'' ORDER BY id ASC";
        $resultpn = mysqli_query($db, $sqlpn);
        $rowpn = mysqli_fetch_array($resultpn,MYSQLI_ASSOC);
        $total_pages = ceil($rowpn["total"] / $results_per_page); // calculate total pages with results

        //for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
        $i=$page;
        ?>

        <div style="display: flex;justify-content: center;margin-right: 5px;margin-left: -10px;">
            <form method="POST">
                <select name="perPageLimit" onchange='this.form.submit(), LoaderShow()'>
                    <option hidden>প্রতি পেইজে ১০০টি তথ্য</option>
                    <option value="100" <?php if($perPageLimit=='100') {echo 'selected';}?>>প্রতি পেইজে ১০০টি তথ্য</option>
                    <option value="300" <?php if($perPageLimit=='300') {echo 'selected';}?>>প্রতি পেইজে ৩০০টি তথ্য</option>
                    <option value="500" <?php if($perPageLimit=='500') {echo 'selected';}?>>প্রতি পেইজে ৫০০টি তথ্য</option>
                    <option value="<?php echo $rowpn["total"]; ?>" <?php if($perPageLimit==$rowpn["total"]) {echo 'selected';}?>>এক পেইজে সব তথ্য</option>
                </select>
            </form>
        </div>
        <?php
        }
        ?>

        <?php
        for ($i=1; $i<=$total_pages; $i++) {

            //echo "<option value='{$i}'>{$i}</option>";
            echo "<a onClick='LoaderShow()' style='";
            if ($page == $i) {
                echo "background-color: #5b86e5; color: #ffffff;";
            }
            echo "' href='admin/allowance-list?page={$i}'>{$i}</a>";

        };
        ?>

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


