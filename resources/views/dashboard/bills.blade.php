@extends('dashboard.layouts.master')
@section('content')

  <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <li class="list-group-item border-0 pt-0 text-sm"><strong class="text-dark">Mã hóa đơn:</strong> &nbsp; #1112</li>
                                <li class="list-group-item border-0 pt-0 text-sm"><strong class="text-dark">Loại:</strong> &nbsp;Food</li>
                                <li class="list-group-item border-0 pt-0 text-sm"><strong class="text-dark">Tổng tiền:</strong> &nbsp; 44.000đ</li>
                                <li class="list-group-item border-0 pt-0 text-sm"><strong class="text-dark">Ngày thanh toán:</strong> &nbsp;19/02/2021</li>
                                <li class="list-group-item border-0 pt-0 text-sm"><strong class="text-dark">Cửa hàng:</strong> &nbsp; Hi Coffee</li>
                                <li class="list-group-item border-0 pt-0 text-sm"><strong class="text-dark">Địa chỉ:</strong> &nbsp; Abc, Dong Da, Ha Noi</li>
                                <li class="list-group-item border-0 pt-0 text-sm"><strong class="text-dark">Ghi chú:</strong> &nbsp; </li>
                                <li class="list-group-item border-0 pt-0 text-sm"><strong class="text-dark">Thời gian upload:</strong> &nbsp; 19/02/2021</li>
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
                            <a class="btn bg-gradient-light mb-0" style="margin-right: 10px" href="{{route('bill.add')}}">
                                <i class="fas fa-plus" aria-hidden="true"></i>
                            </a>
                            <input type="text" name="dates" class="form-control ml-2"/>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="30%">Hóa đơn</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="15%">Loại</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" width="15%">Tổng tiền</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="20%">Thời gian</th>
                                <th class="text-secondary opacity-7" width="20%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                <div class="d-flex px-2 py-1">
                                    <div>
                                    <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">John Michael</h6>
                                    <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                                    </div>
                                </div>
                                </td>
                                <td>
                                <p class="text-xs font-weight-bold mb-0">Food</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bold">23.000đ</span>
                                </td>
                                <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">23/04/2021</span>
                                </td>
                                <td class="align-middle">
                                <div class="ms-auto">
                                    <a class="btn btn-link text-dark px-2 mb-0" data-bs-toggle="modal" data-bs-target="#detailModal">
                                        <i class="far fa-eye me-2"></i>View
                                    </a>
                                    <a class="btn btn-link text-dark px-2 mb-0" href="{{route('bill.edit', 1)}}">
                                        <i class="fas fa-pencil-alt text-dark me-2"></i>Edit
                                    </a>
                                </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <div class="d-flex px-2 py-1">
                                    <div>
                                    <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">John Michael</h6>
                                    <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                                    </div>
                                </div>
                                </td>
                                <td>
                                <p class="text-xs font-weight-bold mb-0">Food</p>
                                <!-- <p class="text-xs text-secondary mb-0">Organization</p> -->
                                </td>
                                <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bold">23.000đ</span>
                                </td>
                                <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">23/04/2021</span>
                                </td>
                                <td class="align-middle">
                                <div class="ms-auto">
                                    <a class="btn btn-link text-dark px-2 mb-0" href="javascript:;">
                                        <i class="far fa-eye me-2"></i>View
                                    </a>
                                    <a class="btn btn-link text-dark px-2 mb-0" href="javascript:;">
                                        <i class="fas fa-pencil-alt text-dark me-2"></i>Edit
                                    </a>
                                </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <div class="d-flex px-2 py-1">
                                    <div>
                                    <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">John Michael</h6>
                                    <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                                    </div>
                                </div>
                                </td>
                                <td>
                                <p class="text-xs font-weight-bold mb-0">Food</p>
                                <!-- <p class="text-xs text-secondary mb-0">Organization</p> -->
                                </td>
                                <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bold">23.000đ</span>
                                </td>
                                <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">23/04/2021</span>
                                </td>
                                <td class="align-middle">
                                <div class="ms-auto">
                                    <a class="btn btn-link text-dark px-2 mb-0" href="javascript:;">
                                        <i class="far fa-eye me-2"></i>View
                                    </a>
                                    <a class="btn btn-link text-dark px-2 mb-0" href="javascript:;">
                                        <i class="fas fa-pencil-alt text-dark me-2"></i>Edit
                                    </a>
                                </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <div class="d-flex px-2 py-1">
                                    <div>
                                    <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">John Michael</h6>
                                    <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                                    </div>
                                </div>
                                </td>
                                <td>
                                <p class="text-xs font-weight-bold mb-0">Food</p>
                                <!-- <p class="text-xs text-secondary mb-0">Organization</p> -->
                                </td>
                                <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bold">23.000đ</span>
                                </td>
                                <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">23/04/2021</span>
                                </td>
                                <td class="align-middle">
                                <div class="ms-auto">
                                    <a class="btn btn-link text-dark px-2 mb-0" href="javascript:;">
                                        <i class="far fa-eye me-2"></i>View
                                    </a>
                                    <a class="btn btn-link text-dark px-2 mb-0" href="javascript:;">
                                        <i class="fas fa-pencil-alt text-dark me-2"></i>Edit
                                    </a>
                                </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <div class="d-flex px-2 py-1">
                                    <div>
                                    <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">John Michael</h6>
                                    <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                                    </div>
                                </div>
                                </td>
                                <td>
                                <p class="text-xs font-weight-bold mb-0">Food</p>
                                <!-- <p class="text-xs text-secondary mb-0">Organization</p> -->
                                </td>
                                <td class="align-middle text-center text-sm">
                                <span class="text-secondary text-xs font-weight-bold">23.000đ</span>
                                </td>
                                <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">23/04/2021</span>
                                </td>
                                <td class="align-middle">
                                <div class="ms-auto">
                                    <a class="btn btn-link text-dark px-2 mb-0" href="javascript:;">
                                        <i class="far fa-eye me-2"></i>View
                                    </a>
                                    <a class="btn btn-link text-dark px-2 mb-0" href="javascript:;">
                                        <i class="fas fa-pencil-alt text-dark me-2"></i>Edit
                                    </a>
                                </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('input[name="dates"]').daterangepicker();
    </script>
@endsection