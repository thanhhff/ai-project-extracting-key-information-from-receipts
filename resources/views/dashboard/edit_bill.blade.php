@extends('dashboard.layouts.master')
@section('content')
  <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ __('index.confirm') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>{{ __('index.delete_alert') }}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('index.close') }}</button>
          <form method="POST" action="{{route('bill.delete', $bill->id)}}">
            @csrf
            <button type="submit" class="btn bg-gradient-danger">{{ __('index.reciept_delete') }}</button>
          </form>
          
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-lg-12 mb-lg-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-lg-4">
              <div class="border-radius-lg h-100">
                <img src="{{$bill->image->link}}" class="border-radius-lg" width="100%"/>
              </div>
            </div>
            <div class="col-lg-8">
                <form action="{{route('bill.update', $bill->id)}}" method="POST">
                    @csrf
                    <label>{{ __('index.rpt_reciept_no') }}</label>
                    <input type="text" class="form-control" value="{{'#' . $bill->id}}" disabled>
                    <label>{{ __('index.rpt_type') }}</label>
                    <select name="category_id" class="form-control custom-select">
                      @foreach($categories as $category)
                      <option value="{{$category->id}}" @if($category->id == $bill->category_id) selected @endif>{{$category->name}}</option>
                      @endforeach
                    </select>
                    <label>{{ __('index.rpt_total') }}</label>
                    <input type="text" class="form-control" name="total" value="{{$bill->total}}">
                    <label>{{ __('index.rpt_payment_date') }}</label>
                    <input type="date" class="form-control" name="payment_date" value="{{$bill->payment_date}}">
                    <label>{{ __('index.rpt_seller') }}</label> 
                    <input type="text" class="form-control" name="seller" value="{{$bill->seller}}">
                    <label>{{ __('index.rpt_address') }}</label>
                    <textarea name="address" class="form-control" rows="4">{{$bill->address}}</textarea>
                    <label>{{ __('index.rpt_note') }}</label>
                    <textarea name="note" class="form-control" rows="4">{{$bill->note}}</textarea>
                    <hr>
                    <div class="text-body text-sm font-weight-bold text-center">
                        <a class="btn bg-gradient-danger mb-0" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">{{ __('index.reciept_delete') }}</a>
                        <button type="submit" class="btn bg-gradient-dark mb-0">{{ __('index.reciept_update') }}</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection