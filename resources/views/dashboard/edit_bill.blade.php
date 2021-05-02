@extends('dashboard.layouts.master')
@section('content')
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-lg-4">
                  <div class="border-radius-lg h-100">
                    <img src="{{asset('./assets/img/reciept_thumbnail.jpg')}}" class="border-radius-lg" id="image-preview" width="100%"/>
                  </div>
                </div>
                <div class="col-lg-8">
                    <form action="" enctype="multipart/form-data" method="POST">
                        <label>Mã hóa đơn</label>
                        <input type="text" class="form-control" name="abc" value="#211212" disabled>
                        <label>Loại chi phí</label>
                        <select name="cars" class="form-control custom-select">
                            <option value="volvo">Food</option>
                            <option value="saab">Drink</option>
                            <option value="mercedes">ABC</option>
                            <option value="audi">Other</option>
                        </select>
                        <label>Tổng tiền</label>
                        <input type="number" class="form-control" name="abc" value="32.000">
                        <label>Ngày thanh toán</label>
                        <input type="date" class="form-control" name="abc" value="20/12/2020">
                        <label>Cửa hàng</label>
                        <input type="text" class="form-control" name="abc" value="Hi Coffee">
                        <label>Địa chỉ</label>
                        <input type="text" class="form-control" name="abc" value="Abc, Dong Da, Ha Noi">
                        <label>Ghi chú</label>
                        <textarea class="form-control" rows="4"></textarea>
                        <hr>
                        <div class="text-body text-sm font-weight-bold text-center">
                            <a type="button" class="btn bg-gradient-dark mb-0" id="upload-image">Cập nhật</a>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $("#upload-image").on("click", function(e){
            e.preventDefault()
            toastr.success('Cập nhật thông tin hóa đơn thành công');
        });
    </script>
@endsection