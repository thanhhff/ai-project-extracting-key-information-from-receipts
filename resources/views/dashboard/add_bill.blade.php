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
                        <label>Hóa đơn</label>
                        <input id="image-input" type="file" class="form-control" name="image">
                        <label>Loại chi phí</label>
                        <select name="cars" class="form-control custom-select">
                            <option value="volvo">Food</option>
                            <option value="saab">Drink</option>
                            <option value="mercedes">ABC</option>
                            <option value="audi">Other</option>
                        </select>
                        <label>Ghi chú</label>
                        <textarea class="form-control" rows="4"></textarea>
                        <hr>
                        <div class="text-body text-sm font-weight-bold text-center">
                            <a type="button" class="btn bg-gradient-dark mb-0" id="upload-image">Thêm</a>
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
        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader()

                reader.onload = function (e) {
                    $('#image-preview').attr('src', e.target.result)
                }
                reader.readAsDataURL(input.files[0])
            }
        }

        $("#image-input").change(function(){readURL(this)})

        $("#upload-image").on("click", function(e){
            e.preventDefault()
            toastr.success('Thêm hóa đơn thành công! Quá trình xử lý có thể mất vài phút. ');
        });
    </script>
@endsection