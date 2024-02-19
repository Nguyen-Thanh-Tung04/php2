@extends('user.commom.layout')
@section('content')

<div class="section ">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active d-flex justify-content-center align-items-center" style="height: 400px;">
                <img src="<?= BASE_URL . "../user/commom/assets/images/banner/bn2.png" ?>" class="img-fluid" alt="">
            </div>
            <div class="carousel-item" style="height: 400px;">
                <img src="<?= BASE_URL . "../user/commom/assets/images/banner/bn2.png" ?>" class="d-block w-100"
                    style="max-width: 90%; height: auto;" alt="...">
            </div>
            <div class="carousel-item" style="height: 400px;">
                <img src="<?= BASE_URL . "../user/commom/assets/images/banner/bn2.png" ?>" class="d-block w-100"
                    style="max-width: 90%; height: auto;" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<div class="container my-4">

    <div>
        <h3 class="text-center">Sản phẩm của chúng tôi</h3>
    </div>

    <div class="row g-4 my-4">
        <?php
        foreach ($topNew as $row) {
        ?> <div class=" col-3 align-self-start">
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
@endsection