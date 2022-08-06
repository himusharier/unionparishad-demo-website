
<script>
    document.title = 'বিশ্ববিদ্যালয় শিক্ষার্থীদের তথ্য তালিকা - ইউনিয়ন পরিষদ';
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

    <p class="page-direction"><i class="fa fa-link"></i> ড্যাশবোর্ড / বিশ্ববিদ্যালয় শিক্ষার্থীদের তথ্য তালিকা /</p>

    <div class="dashboard-table-container">
        <?php
        require ('config/database-connection.php');
        $sqlr = "SELECT * FROM house_holding_database_family WHERE isVarsity='হ্যাঁ' ORDER BY id ASC";
        $resultr = mysqli_query($db, $sqlr);
        $countr = mysqli_num_rows($resultr);
        ?>
        <p class="dashboard-table-container-heading">বিশ্ববিদ্যালয় শিক্ষার্থীদের তথ্য তালিকা (<?php echo $countr; ?> জন)</p>

            <table class="responstable">
                <tbody>
                <?php
                if ($countr > 0) {
                ?>
                <tr>
                    <th>নাম</th>
                    <th>পরিচয় পত্র নাম্বার</th>
                    <th>মোবাইল নাম্বার</th>
                    <th>বিশ্ববিদ্যালয়ের নাম</th>
                    <th>অন্যান্য</th>
                </tr>
                <?php
                while ($rowr = mysqli_fetch_array($resultr, MYSQLI_ASSOC)) {
                ?>
                    <tr>
                        <td><?php echo $rowr['personName'] ?></td>
                        <td><?php echo $rowr['idNumber'] ?></td>
                        <td><?php echo $rowr['mobileNumber'] ?></td>
                        <td><?php echo $rowr['varsityName'] ?></td>
                        <td>
                            <button class="view-window" data-formid="<?php echo $rowr['linkedForm'] ?>" style="cursor: pointer; color: #007CC7; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;">দেখুন</button> |
                            <form method="post" action="admin/update-house-holding" style="display: inline-block;">
                                <input type="hidden" name="formID" value="<?php echo $rowr['linkedForm'] ?>">
                            <button onclick="LoaderShow()" type="submit" class="edit-window" data-formid="<?php echo $rowr['linkedForm'] ?>" style="cursor: pointer; color: #23b14d; background: none; height: 0; border: 0; margin: 0; width: auto; font-weight: bold;">সংশোধন করুন</button>
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


