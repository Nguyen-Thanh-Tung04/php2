@extends('Admin.commom.layout')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Quản lý sản phẩm</h1>
            </div>
            <div class="col-sm-6">
                <div class="float-sm-right">
                    <a href="<?= route('admin/product/add') ?>" class="btn btn-primary btn-md">Thêm sản phẩm</a>
                </div>
            </div>
        </div>
    </div>
</div>


<section class="content">
    <div class="container-fluid">
        <div class="card card-cus">
            <div class="card-body">
                <table id="example1" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ảnh</th>
                            <th>Tên</th>
                            <th>Giá bán</th>
                            <th>Số lượng</th>
                            <th>Danh mục</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($listProduct as $row) {
                            $i++;
                            $update_product = route("admin/product/edit/" . $row['p_id']);
                            $delete_product = route("admin/product/delete/" . $row['p_id']);
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td style="width:82px;"><img src="<?= BASE_URL . "upload/" . $row['p_featured_photo'] ?>"
                                    alt="<?php echo $row['p_name']; ?>" style="width:80px;"></td>
                            <td><?php echo $row['p_name']; ?></td>
                            <td><?php echo $row['p_current_price']; ?>đ</td>
                            <td><?php echo $row['p_quantity']; ?></td>

                            <td><?php echo $row['cate_name']; ?></td>
                            <td>
                                <a href="<?php echo $update_product; ?>" class="btn btn-primary btn-sm">Sửa</a>
                                <a href="#" class="btn btn-danger btn-sm" data-href="<?php echo $delete_product; ?>"
                                    data-toggle="modal" data-target="#confirm-delete">Xóa</a>
                            </td>
                        </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Xác nhận xóa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc muốn xóa sản phẩm này không?</p>
                <p style="color:red;">Hãy cẩn thận! Các dữ liệu liên quan như color, size, ảnh,... cũng có thể bị xóa.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                <a class="btn btn-danger btn-ok">Xóa</a>
            </div>
        </div>
    </div>
</div>
@endsection