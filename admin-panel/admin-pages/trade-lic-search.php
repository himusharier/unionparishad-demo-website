<?php

if (isset($_GET['searchKey'])) {
    $searchKey = strip_tags($_GET['searchKey']);
    $searchKey = htmlspecialchars($searchKey);
    $searchKey = mysqli_real_escape_string($db, $searchKey);
    $searchKey = str_replace ("-", " ", $searchKey);
    $searchKey = trim ($searchKey);

} else {
    $searchKey = "";
}

if (isset($_POST['tradeLicSearchBtn']) && isset($_POST['tradeLicSearchTxt'])) {

    $searchKey = strip_tags($_POST['tradeLicSearchTxt']);
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

?>

<script>
    document.title = 'ট্রেড লাইসেন্স অনুসন্ধান - ইউনিয়ন পরিষদ';
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

    <p class="page-direction"><i class="fa fa-link"></i> ট্রেড লাইসেন্স / তথ্য তালিকা / অনুসন্ধান /</p>

    <label>'ট্রেড লাইসেন্স' অনুসন্ধান করুনঃ</label>
    <form method="POST" enctype="multipart/form-data">
        <div class="search">
            <input type="text" class="searchTerm" name="tradeLicSearchTxt" placeholder="ট্রেড লাইসেন্স নাম্বার দিন" autocomplete="off" required>
            <button onsubmit="LoaderShow()" type="submit" name="tradeLicSearchBtn" class="searchButton"><i class="fa fa-search"></i></button>
        </div>
    </form>

    <div class="dashboard-table-container">
        <p class="dashboard-table-container-heading">ট্রেড লাইসেন্স তথ্য তালিকা</p>

            <table class="responstable">
                <tbody>
                <?php
                require ('config/database-connection.php');
                $sqlr = "SELECT * FROM trade_license_database WHERE idNumber LIKE '%$searchKey%' ORDER BY id ASC";
                $resultr = mysqli_query($db, $sqlr);
                $countr = mysqli_num_rows($resultr);
                if ($countr > 0) {
                ?>
                <tr>
                    <th>ক্রমিক নং</th>
                    <th>ট্রেড লাইসেন্স নং</th>
                    <th>শেষ নবায়নের তারিখ</th>
                    <th>ব্যবসা প্রতিষ্ঠানের নাম</th>
                    <th>প্রোপাইটরের নাম</th>
                    <th>মোবাইল নাম্বার</th>
                    <th>অন্যান্য</th>
                </tr>
                <?php
                while ($rowr = mysqli_fetch_array($resultr, MYSQLI_ASSOC)) {
                ?>
                    <tr>
                        <td><?php echo $rowr['serialNo'] ?></td>
                        <td><?php echo $rowr['tradeLicense'] ?></td>
                        <td>
                            <?php
                            $bDate1=$rowr['lastRenew'];
                            $format_bDate=date("d-m-Y",strtotime($bDate1));
                            echo $format_bDate;
                            ?>
                        </td>
                        <td><?php echo $rowr['businessName'] ?></td>
                        <td><?php echo $rowr['proprietorName'] ?></td>
                        <td><?php echo $rowr['mobile'] ?></td>
                        <td>
                            <button class="view-window" data-formid="<?php echo $rowr['formID'] ?>" style="cursor: pointer; color: #007CC7; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;">দেখুন</button> |
                            <form method="post" action="admin/update-trade-license" style="display: inline-block;">
                                <input type="hidden" name="formID" value="<?php echo $rowr['formID'] ?>">
                            <button onclick="LoaderShow()" type="submit" class="edit-window" data-formid="<?php echo $rowr['formID'] ?>" style="cursor: pointer; color: #23b14d; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;">সংশোধন করুন</button>
                            </form>
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
        <a class="modal-title" style="padding: 5px"><p style="margin-top: 5px; padding: 0 5px; display: inline-block; color: #5b86e5; font-weight: 600;font-size: 16px; font-family: 'Bangla';">ট্রেড লাইসেন্স তথ্য</p>
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
            url: "script/trade-lic-single-data-show",
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


