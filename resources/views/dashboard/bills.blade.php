@extends('dashboard.layouts.master')
@section('content')

  <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title pt-1" id="exampleModalLabel">Thông tin chi tiết</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times fa-lg"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-5">
                            <img src="{{asset('./assets/img/reciept_thumbnail.jpg')}}" class="border-radius-lg" id="image-preview" width="100%"/>
                        </div>
                        <div class="col-7">
                            <ul class="list-group">
                                <li class="list-group-item border-0 pt-0 text-sm"><strong class="text-dark">
                                    Mã hóa đơn:</strong> &nbsp;#<span id="id"></span>
                                </li>
                                <li class="list-group-item border-0 pt-0 text-sm"><strong class="text-dark">
                                    Loại:</strong> &nbsp; <span id="category"></span>
                                </li>
                                <li class="list-group-item border-0 pt-0 text-sm"><strong class="text-dark">
                                    Tổng tiền:</strong> &nbsp; <span id="total"></span>
                                </li>
                                <li class="list-group-item border-0 pt-0 text-sm"><strong class="text-dark">
                                    Ngày thanh toán:</strong> &nbsp; <span id="payment_date"></span>
                                </li>
                                <li class="list-group-item border-0 pt-0 text-sm"><strong class="text-dark">
                                    Cửa hàng:</strong> &nbsp; <span id="seller"></span>
                                </li>
                                <li class="list-group-item border-0 pt-0 text-sm"><strong class="text-dark">
                                    Địa chỉ:</strong> &nbsp; <span id="address"></span>
                                </li>
                                <li class="list-group-item border-0 pt-0 text-sm"><strong class="text-dark">
                                    Ghi chú:</strong> &nbsp; <span id="note"></span>
                                </li>
                                <li class="list-group-item border-0 pt-0 text-sm"><strong class="text-dark">
                                    Thời gian upload:</strong> &nbsp; <span id="created_at"></span>
                                </li>
                            </ul>  
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 px-3">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="mb-0 pt-1">Các hóa đơn đã thanh toán</h6>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end align-items-center">
                            <a class="btn bg-gradient-light mb-0" style="margin-right: 10px" href="{{route('bill.new')}}">
                                <i class="fas fa-plus" aria-hidden="true"></i>
                            </a>
                            <input type="text" name="dates" class="form-control ml-2" {{ count($bills) <= 0 ? 'disabled' : '' }}/>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                    @if(count($bills) <= 0)
                    <div class="text-center m-4">
                        <h6 style="color: red">Chưa có dữ liệu người dùng</h6>
                    </div>
                    @else 
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center" width="15%">Trạng thái</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center" width="15%">Hóa đơn</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center" width="15%">Loại</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center" width="15%">Tổng tiền</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center" width="20%">Ngày thanh toán</th>
                                <th class="text-secondary opacity-7" width="20%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bills as $bill)
                            <tr>
                                <td class="align-middle text-center text-sm">
                                    @if($bill->status == 1)
                                        <span class="badge badge-sm bg-gradient-warning">Đang xử lý</span>
                                    @elseif($bill->status == 2)
                                        <span class="badge badge-sm bg-gradient-success">Thành công </span>
                                    @elseif($bill->status == 3)
                                        <span class="badge badge-sm bg-gradient-danger">Lỗi</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="{{$bill->image->link}}" class="avatar-sm me-3">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">#{{$bill->id}}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold text-center mb-0">{{$bill->category->name}}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="text-secondary text-xs font-weight-bold">{{\App\Helpers\format_currency($bill->total)}}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{\App\Helpers\format_date($bill->payment_date)}}</span>
                                </td>
                                <td class="align-middle">
                                    <div class="ms-auto">
                                        <a class="btn btn-link text-dark px-2 mb-0" data-bs-toggle="modal" data-bs-target="#detailModal" onclick="showDetail({{$bill->id}})">
                                            <i class="far fa-eye me-2"></i>View
                                        </a>
                                        <a class="btn btn-link text-dark px-2 mb-0" href="{{route('bill.edit', $bill->id)}}">
                                            <i class="fas fa-pencil-alt text-dark me-2"></i>Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let currentDate = new Date();
        let startDate = currentDate.setMonth(currentDate.getMonth() - 1);
        let bills = {!! json_encode($bills); !!};
        
        $('input[name="dates"]').daterangepicker({
            startDate: startDate,
            locale: {
                format: 'DD/MM/YYYY',
            },
            function (start) {
                startdate = start.format('DD/MM/YYYY')
            }
        });

        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            width: 800
        });

        if('{{session('message')}}' != '') {
            if('{{session('type')}}' == 'error') {
                toastr.error('{{session('message')}}');
            } else if ('{{session('type')}}' == 'success') {
                toastr.success('{{session('message')}}');
            }
        }

        function showDetail(id) {
            let billData = bills.data.find(item => item.id == id);
            $('#id').html(id);
            $('#image-preview').attr('src', billData.image.link);
            $('#category').html(billData.category.name);
            $('#total').html(formatCurrency(billData.total));
            $('#payment_date').html(formatDate(billData.payment_date));
            $('#seller').html(billData.seller);
            $('#address').html(billData.address);
            $('#note').html(billData.note);
            $('#created_at').html(formatDate(billData.created_at));
        }

        function formatDate(date) {
            date = new Date(date);
            let dd = date.getDate();
            let mm = date.getMonth() + 1;
    
            let yyyy = date.getFullYear();
            if (dd < 10) {
                dd = '0' + dd;
            }
            if (mm < 10) {
                mm = '0' + mm;
            }
            return today = dd + '/' + mm + '/' + yyyy;
        }

        function formatCurrency(money) {
            return money.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
        }
    </script>
@endsection