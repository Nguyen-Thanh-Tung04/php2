<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>

    <link rel="stylesheet" href="<?php echo BASE_URL ?>app/assets/lib/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>app/assets/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>app/assets/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>app/assets/css/select2-bootstrap4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo BASE_URL ?>app/assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>app/assets/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>app/assets/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="<?php echo BASE_URL ?>app/assets/css/cmxform.css">

    <link rel="stylesheet" href="<?php echo BASE_URL ?>app/assets/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>app/assets/css/style.css">
</head>

<body>
    <div class="wrapper">
        <!--  Header -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= route("") ?>" class="nav-link">Trang chủ</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                        if (isset($_SESSION['user-name'])) {
                            extract($_SESSION['user-name']);
                            if (!empty($img)) {
                                $hinhpath = "../upload/" . $img;
                                if (is_file($hinhpath)) {
                                    $hinh = "<img src='" . $hinhpath . "' style='height: 40px; width: 40px; border-radius: 50%;'>";
                                } else {
                                    $hinh = "No photo";
                                }
                            } else {
                                $hinh = "<img src='app/assets/images/avata/avata_null.jpg' alt='' ' style='height: 40px; width: 40px; border-radius: 50%;'>";
                            }
                        ?>
                        <?php echo $_SESSION['user-name']['user_name'] ?>
                        <?php echo $hinh ?>
                        <?php
                        } else {
                        ?>
                        <i class="icon-user"></i>
                        <?php } ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                        <a class="dropdown-item" href="../index.php?act=account">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="./index.php?act=logout_admin">Đăng xuất</a>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Sidebar Menu -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="index.php?act=dashboard" class="brand-link">
                <span class="brand-text font-weight-light">TRÌNH QUẢN LÝ</span>
            </a>

            <div class="sidebar">

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= route('admin/category') ?>" class="nav-link">
                                <i class="nav-icon fa-solid fa-users"></i>
                                <p>
                                    Quản lý danh mục
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= route('admin/product') ?>" class="nav-link">
                                <i class="nav-icon fa-solid fa-bag-shopping"></i>
                                <p>
                                    Quản lý sản phẩm
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= route('admin/account') ?>" class="nav-link">
                                <i class="nav-icon fa-solid fa-users"></i>
                                <p>
                                    Quản lý tài khoản
                                </p>
                            </a>
                        </li>

                    </ul>
                </nav>

            </div>
        </aside>
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>
    <script src="<?php echo BASE_URL ?>app/assets/js/jquery.min.js"></script>
    <script src="<?php echo BASE_URL ?>app/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASE_URL ?>app/assets/js/jquery.overlayScrollbars.min.js"></script>
    <script src="<?php echo BASE_URL ?>app/assets/js/select2.full.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo BASE_URL ?>app/assets/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo BASE_URL ?>app/assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo BASE_URL ?>app/assets/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo BASE_URL ?>app/assets/js/responsive.bootstrap4.min.js"></script>
    <script src="<?php echo BASE_URL ?>app/assets/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo BASE_URL ?>app/assets/js/buttons.bootstrap4.min.js"></script>

    <script type="text/javascript" src="<?php echo BASE_URL ?>app/assets/js/adminlte.js"></script>

    <script src="<?php echo BASE_URL ?>app/assets/lib/ckeditor/ckeditor.js"></script>
    <script>
    if (document.getElementById('p_description')) {
        CKEDITOR.replace('p_description');
    }

    if (document.getElementById('p_short_description')) {
        CKEDITOR.replace('p_short_description');
    }
    </script>

    <script type="text/javascript">
    (function() {
        $('.select2').select2();

        $("#example1")
            .DataTable({
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                buttons: ["excel"],
            })
            .buttons()
            .container()
            .appendTo("#example1_wrapper .col-md-6:eq(0)");

        $('#example2').DataTable({
            "paging": true,
            "pageLength": 10,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });

        function confirmDelete() {
            return confirm("Bạn có chắc muốn xóa dữ liệu này không?");
        }
    })()
    </script>

    <script type="text/javascript">
    $(document).ready(function() {

        $("#btnAddNew").click(function() {

            var rowNumber = $("#ProductTable tbody tr").length;

            var trNew = "";

            var addLink = "<div class=\"upload-btn" + rowNumber +
                "\"><input type=\"file\" name=\"photo[]\"  style=\"margin-bottom:5px;\"></div>";

            var deleteRow =
            "<a href=\"javascript:void()\" class=\"Delete btn btn-danger btn-xs\">X</a>";

            trNew = trNew + "<tr> ";

            trNew += "<td>" + addLink + "</td>";
            trNew += "<td style=\"width:28px;\">" + deleteRow + "</td>";

            trNew = trNew + " </tr>";

            $("#ProductTable tbody").append(trNew);

        });

        $('#ProductTable').delegate('a.Delete', 'click', function() {
            $(this).parent().parent().fadeOut('slow').remove();
            return false;
        });

    })
    </script>

</body>

</html>