@extends('dashboard.layouts.master')
@section('content')
  <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title pt-1" id="exampleModalLabel">{{ __('index.rpts_detail') }}</h5>
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
                                    {{ __('index.rpt_reciept_no') }}:</strong> &nbsp;#<span id="id"></span>
                                </li>
                                <li class="list-group-item border-0 pt-0 text-sm"><strong class="text-dark">
                                    {{ __('index.rpt_type') }}:</strong> &nbsp; <span id="category"></span>
                                </li>
                                <li class="list-group-item border-0 pt-0 text-sm"><strong class="text-dark">
                                    {{ __('index.rpt_total') }}:</strong> &nbsp; <span id="total"></span>
                                </li>
                                <li class="list-group-item border-0 pt-0 text-sm"><strong class="text-dark">
                                    {{ __('index.rpt_payment_date') }}:</strong> &nbsp; <span id="payment_date"></span>
                                </li>
                                <li class="list-group-item border-0 pt-0 text-sm"><strong class="text-dark">
                                    {{ __('index.rpt_seller') }}:</strong> &nbsp; <span id="seller"></span>
                                </li>
                                <li class="list-group-item border-0 pt-0 text-sm"><strong class="text-dark">
                                    {{ __('index.rpt_address') }}:</strong> &nbsp; <span id="address"></span>
                                </li>
                                <li class="list-group-item border-0 pt-0 text-sm"><strong class="text-dark">
                                    {{ __('index.rpt_note') }}:</strong> &nbsp; <span id="note"></span>
                                </li>
                                <li class="list-group-item border-0 pt-0 text-sm"><strong class="text-dark">
                                    {{ __('index.rpt_uploaded_at') }}:</strong> &nbsp; <span id="created_at"></span>
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
                        <div class="col-md-9">
                            <h5 class="mb-0 pt-1">{{ __('index.rpts_processing_reciepts') }}</h6>
                        </div>
                        <div class="col-md-3 d-flex justify-content-end align-items-center">
                            <a class="btn bg-gradient-light mb-0" style="margin-right: 10px" href="{{route('bill.new')}}">
                                {{ __('index.nav_reciept_add') }} 
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                    @if(count($processingBills) <= 0)
                    <div class="text-center m-4">
                        <h6 style="color: red">{{ __('index.no_processing') }}</h6>
                    </div>
                    @else 
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center" width="10%">{{ __('index.rpt_reciept_no') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center" width="15%">{{ __('index.rpt_status') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center" width="10%">{{ __('index.rpt_reciept') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center" width="15%">{{ __('index.rpt_type') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center" width="10%">{{ __('index.rpt_total') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center" width="15%">{{ __('index.rpt_payment_date') }}</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($processingBills as $bill)
                            <tr>
                                <td class="align-middle text-center text-sm">
                                    <h6 class="mb-0 text-sm">#{{$bill->id}}</h6>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    @if($bill->status == 1)
                                        <span class="badge badge-sm bg-gradient-warning">{{ __('index.processing') }}</span>
                                    @elseif($bill->status == 2)
                                        <span class="badge badge-sm bg-gradient-success">{{ __('index.success') }}</span>
                                    @elseif($bill->status == 3)
                                        <span class="badge badge-sm bg-gradient-danger">{{ __('index.error') }}</span>
                                    @endif
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <img src="{{$bill->image->link}}" class="avatar-sm me-3">
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
                                            <i class="far fa-eye me-2"></i>{{ __('index.rpt_view') }}
                                        </a>
                                        <a class="btn btn-link text-dark px-2 mb-0" href="{{route('bill.edit', $bill->id)}}">
                                            <i class="fas fa-pencil-alt text-dark me-2"></i>{{ __('index.rpt_edit') }}
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
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 px-3">
                    <div class="row pb-2">
                        <div class="col-md-8">
                            <h5 class="mb-0 pt-2">{{ __('index.rpts_paid_reciepts') }}</h6>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end align-items-center">
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                    @if(count($bills) <= 0)
                    <div class="text-center m-4">
                        <h6 style="color: red">{{ __('index.no_data') }}</h6>
                    </div>
                    @else 
                    <table class="table align-items-center mb-0" id="paid_reciepts" data-page-length='25'>
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center" width="10%">{{ __('index.rpt_reciept_no') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center" width="15%">{{ __('index.rpt_status') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center" width="10%">{{ __('index.rpt_reciept') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center" width="15%">{{ __('index.rpt_type') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center" width="10%">{{ __('index.rpt_total') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center" width="15%">{{ __('index.rpt_payment_date') }}</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let startDate = moment().subtract(120, 'days');
        let endDate = moment();
        let bills = {!! json_encode($bills); !!};

        $(document).ready( function () {
            let paidRecieptsTable = $('#paid_reciepts').DataTable( {
                data: bills,
                searching: true,
                ordering: true,
                order: [[0, 'desc']],
                info:     false,
                lengthChange: true,
                orderMulti: false,
                paging:   true,
                columns: [
                    { data: "id", class: "align-middle text-center text-sm" },
                    { data: "status", class: "align-middle text-center text-sm" },
                    { data: "image", class: "align-middle text-center text-sm" },
                    { data: "category" },
                    { data: "total", class: "align-middle text-center text-sm" },
                    { data: "payment_date", class: "align-middle text-center" },
                    { data: 'id', class: "align-middle" }
                ],
                columnDefs: [
                    {
                        "render": function ( data, type, row ) {
                            return ` <h6 class="mb-0 text-sm">${data}</h6>`;
                         },
                        "targets": 0,
                        "orderable": true
                    },
                    {
                        "render": function ( data, type, row ) {
                            if (data == 1) {
                                return `<span class="badge badge-sm bg-gradient-warning">{{ __('index.processing') }}</span>`;
                            } else if (data == 2) {
                                return `<span class="badge badge-sm bg-gradient-success">{{ __('index.success') }}</span>`;
                            } else if (data == 3) {
                                return `<span class="badge badge-sm bg-gradient-danger">{{ __('index.error') }}</span>`;
                            }
                        },
                        "targets": 1,
                        "orderable": false
                    },
                    {
                        "render": function ( data, type, row ) {
                            return `<img src="${data['link']}" class="avatar-sm me-3">`;
                        },
                        "targets": 2,
                        "orderable": false
                    },
                    {
                        "render": function ( data, type, row ) {
                            return `<p class="text-xs font-weight-bold text-center mb-0">${data['name']}</p>`;
                        },
                        "targets": 3,
                        "orderable": false
                    },
                    {
                        "render": function ( data, type, row ) {
                            return `
                                <span class="text-secondary text-xs font-weight-bold">
                                    ${formatCurrency(data)}
                                </span>`;
                        },
                        "targets": 4
                    },
                    {
                        "render": function ( data, type, row ) {
                            return `<span class="text-secondary text-xs font-weight-bold">${formatDate(data)}</span>`;
                        },
                        "targets": 5
                    },
                    {
                        "render": function ( data, type, row ) {
                            let p =  `
                                <div class="ms-auto">
                                    <button class="btn btn-link text-dark px-2 mb-0" data-bs-toggle="modal" data-bs-target="#detailModal" onclick="showDetail(${data})">
                                        <i class="far fa-eye me-2"></i>{{ __('index.rpt_view') }}
                                    </button>
                                    <a class="btn btn-link text-dark px-2 mb-0" href="{{route('bill.edit', ':id')}}">
                                        <i class="fas fa-pencil-alt text-dark me-2"></i>{{ __('index.rpt_edit') }}
                                    </a>
                                </div>`
                            return p.replaceAll(':id', data);
                        },
                        "targets": 6,
                        "orderable": false
                    },
                ]
            });
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
            let billData = bills.find(item => item.id == id);
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
            if(money == null || money == 0) return "0 VND";
            return money.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
        }
    </script>
@endsection