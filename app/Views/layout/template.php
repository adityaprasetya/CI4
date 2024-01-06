<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Penjualan</title>
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>/assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/styles.min.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

        <?= $this->include('layout/sidebar'); ?>

        <?= $this->renderSection('page'); ?>

    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../assets/js/dashboard.js"></script>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: "<?= base_url('pages/kode_pj') ?>",
                type: "GET",
                success: function(hasil) {
                    var obj = $.parseJSON(hasil);
                    $('#nm_pjl').val(obj);
                }
            })
        })
    </script>

    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').on('change', function() {
                $("#hrg").val($('.select2 option:selected').attr('hrg'));
            });
        });
    </script>

    <script>
        function findTotal() {
            var hrg = document.getElementById('hrg').value;
            var qty = document.getElementById('qty').value;
            var result = document.getElementById('result');
            var myResult = hrg * qty;

            document.getElementById('ttl').value = myResult;
        }
    </script>

</body>

</html>