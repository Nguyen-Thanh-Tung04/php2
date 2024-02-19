@extends('user.commom.layout')
@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row breadcrumb_box  align-items-center">
                    <div class="col-lg-6 col-md-6 col-sm-12 text-center text-md-start">
                        <h2 class="breadcrumb-title">Quên mật khẩu</h2>
                    </div>
                    <div class="col-lg-6  col-md-6 col-sm-12">
                        <!-- breadcrumb-list start -->
                        <ul class="breadcrumb-list text-center text-md-end">
                            <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Quên mật khẩu</li>
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
                        <h4>Lấy lại mật khẩu </h4>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="index.php?act=quenmk" method="post">
                                        <input type="text" name="email" placeholder="Email" />
                                        <div class="button-box d-flex justify-content-lg-between">
                                            <div class="dangky col-lg-3 my-3">
                                                <input type="submit" value="Gửi" name="guiemail">
                                            </div>
                                            <a href="index.php?act=login">Quay lại</a>
                                        </div>
                                    </form>
                                    <p class="thongbao" style="color: red;">
                                        <?php
                                        if (isset($sendMailMess) && $sendMailMess != '') {
                                            echo $sendMailMess;
                                        }
                                        ?>
                                    </p>
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