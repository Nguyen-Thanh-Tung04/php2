@extends('Admin.commom.layout')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Thêm danh mục</h1>
      </div>
      <div class="col-sm-6">
        <div class="float-sm-right">
          <a href="<?= route("admin/category") ?>" class="btn btn-primary btn-md">Danh sách danh mục</a>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container-fluid">
    <?php if ($message) { ?>
      <div class="callout callout-danger bg-danger">

        <p>
          <?php echo $message; ?>
        </p>
      </div>
    <?php } ?>
    <div class="card card-cus">
      <form action="<?= route("admin/category/add") ?>" method="post">
        <div class="card-body">
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Danh mục <span>*</span></label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="tendm" placeholder="nhập tên danh mục">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-6">
              <input class="btn btn-success pull-left" type="submit" name="themmoi" value="THÊM MỚI">
            </div>
          </div>

        </div>
      </form>
    </div>
  </div>
</section>
@endsection