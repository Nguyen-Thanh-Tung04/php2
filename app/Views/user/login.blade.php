@extends('user.commom.layout')
@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row breadcrumb_box  align-items-center">
                    <div class="col-lg-6 col-md-6 col-sm-12 text-center text-md-start">
                        <h2 class="breadcrumb-title">Đăng nhập</h2>
                    </div>
                    <div class="col-lg-6  col-md-6 col-sm-12">
                        <!-- breadcrumb-list start -->
                        <ul class="breadcrumb-list text-center text-md-end">
                            <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Đăng nhập</li>
                        </ul>
                        <!-- breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->
<!-- login area start -->
<div class="login-register-area pt-100px pb-100px">
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" href="?act=login">
                            <h4>Đăng nhập</h4>
                        </a>
                        <a href="<?= route("register") ?>">
                            <h4>Đăng ký</h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="<?= route("login") ?>" method="post">
                                        <input type="email" name="email" placeholder="Nhập email" required />
                                        <input type="password" name="password" placeholder="Mật khẩu" required />
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <input type="checkbox" />
                                                <a class="flote-none" href="javascript:void(0)">ghi nhớ</a>
                                                <a href="<?= route("forgot-password") ?>">Quên mật khẩu ?</a>
                                            </div>
                                            <div class="dangky col-lg-3 my-3">
                                                <input type="submit" value="Đăng Nhập" name="dangnhap">
                                            </div>
                                        </div>
                                    </form>
                                    <?php
                                    if ($error_message != '') {
                                        echo "<p class='thongbao alert alert-primary'>$error_message</p>";
                                    } else {
                                        echo "";
                                    }
                                    ?>


                                </div>
                            </div>


                        </div>
                        <div id="lg2" class="tab-pane">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="index.php?act=login" method="post">
                                        <input name="user-email" placeholder="Địa chỉ email" type="email" required />
                                        <input type="text" name="user-name" placeholder="Tên tài khoản" required />
                                        <input type="password" name="user-password" placeholder="Mật khẩu" required />
                                        <div class="dangky col-lg-3 my-3">
                                            <input type="submit" value="Đăng ký" name="dangky">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- login area end -->
@endsection