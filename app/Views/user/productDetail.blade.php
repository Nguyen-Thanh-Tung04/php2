@extends('user.commom.layout')
@section('content')
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row breadcrumb_box  align-items-center">
                    <div class="col-lg-6 col-md-6 col-sm-12 text-center text-md-start">
                        <h2 class="breadcrumb-title">Chi tiết sản phẩm</h2>
                    </div>
                    <div class="col-lg-6  col-md-6 col-sm-12">
                        <!-- breadcrumb-list start -->
                        <ul class="breadcrumb-list text-center text-md-end">
                            <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                            <li class="breadcrumb-item active">chi tiết sản phẩm</li>
                        </ul>
                        <!-- breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container my-5">
    <?php
    extract($productDetail);
    ?>
    <div class="row gx-4">
        <div class="col-6">
            <img src="<?= BASE_URL . "upload/" . $p_featured_photo ?>" class="img-detail" style="width: 100%;" alt="">
        </div>
        <div class="col-6">
            <h3><?php echo $p_name ?></h3>
            <div class="py-2">
                <i class="fa-solid fa-star text-warning"></i>
                <i class="fa-solid fa-star text-warning"></i>
                <i class="fa-solid fa-star text-warning"></i>
                <i class="fa-solid fa-star text-warning"></i>
                <i class="fa-solid fa-star text-warning"></i>
            </div>
            <h4><?php echo $p_current_price ?></h4>
            <p class="product-detail-info"><?php echo $p_short_description ?></p>


            <div class="my-4">
                <button type="button" id="addToCart" class="bnt-add-cart btn btn-lg btn-success">Thêm vào giỏ
                    hàng</button>
                <button type="button" class="btn-buy btn btn-lg btn-success"><a class="text-decoration-none text-white"
                        href="<?= route("/cart/list") ?>">Mua ngay</a></button>
            </div>


            <input type="hidden" id="productId" value="<?php echo $p_id ?>">
        </div>
    </div>

    <div class="my-4">
        <h3 class="text-center">Thông tin chi tiết</h3>
    </div>
    <div>
        <p>
            <?php echo nl2br($p_short_description); ?>
        </p>
        <img src="./image/product1-d-desc.jpg" class="img-fluid" alt="">
    </div>


    <div class="my-4">
        <h3 class="text-center">Sản phẩm liên quan</h3>
    </div>

    <div class="row g-4 my-4">
        <?php
        foreach ($productSameCate as $row) {
        ?>
        <div class="col-3 align-self-start">
            <div class="card">
                <a href="<?= route("product/" . $row['p_id']) ?>" class="text-decoration-none">
                    <img src="<?= BASE_URL . "upload/" . $row['p_featured_photo'] ?>"
                        alt="<?php echo $row['p_name']; ?>" class="card-img-top" alt="..." />
                    <div class="card-body">
                        <h5 class="product-title card-title text-dark text-center"><?php echo $row['p_name'] ?></h5>
                        <p class="card-text text-dark text-center">
                            <?php echo $row['p_current_price'] ?>đ
                        </p>
                    </div>
                </a>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>

<script>
const productId = $("#productId").val();

$("#addToCart").on("click", () => {
    const urlBase = "<?= route("cart/add") ?>";
    $.ajax({
        url: urlBase + "/" + productId,
        type: 'GET',
        success: function(response) {
            console.log("hello", response)
            if (response == 0) {
                Swal.fire({
                    title: 'Thông báo',
                    text: 'Đã thêm vào giỏ hàng',
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    showCloseButton: true,
                });
            } else if (response == -1) {
                Swal.fire({
                    title: 'Thông báo',
                    text: 'Thêm thất bại',
                    icon: 'error',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    showCloseButton: true,
                });
            } else {

                window.location.replace("http://localhost:81/assignment_php/login");
            }

        }
    });
})
</script>


@endsection