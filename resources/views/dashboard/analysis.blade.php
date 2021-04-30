@extends('dashboard.layouts.master')
@section('content')
    <div class="row mt-4 mb-4">
        <div class="col-lg-6 mb-lg-0 mb-2">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">Upload receipt to analysis</h6>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="" enctype="multipart/form-data" method="POST">
                                <img src="{{asset('./assets/img/thumbnail.svg')}}" id="image-preview" width="100%" /><br>
                                <input id="image-input" type="file" class="form-control" name="image">
                                <hr>
                                <div class="text-body text-sm font-weight-bold text-center icon-move-right">
                                    <a type="button" class="btn bg-gradient-dark mb-0" id="upload-image">Process</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
        <div class="card">
            <div class="card-header pb-0 px-3">
              <h6 class="mb-0">Billing Information</h6>
            </div>
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column" id="result">
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-hidden="true" data-toggle="modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-body">
                <div class="row justify-content-center text-center">
                <div class="loadingspinner m-3"></div>
                <p class="mt-4">Processing may take a few minutes. Please wait!</p>
                </div>
            </div>
            </div>
        </div>
    </div>

    <script>
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

        $(document).ajaxStart(function(){
            $('#loadingModal').modal({backdrop: 'static', show: true})
        }).ajaxStop(function(){
            setTimeout(() => {
                $('#loadingModal').modal('hide')
            }, 1000);
        });

        $("#upload-image").on("click", function(e){
            e.preventDefault()

            let fd = new FormData()
            let files = $('#image-input')[0].files;

            if(files.length > 0 ){
                fd.append('image',files[0])
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
                });
                $.ajax({
                url: '{{ URL::route('upload') }}',
                type: 'post',
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response){
                    if(response.status === 'success'){
                    $('#image-input').val("");
                    showJsonData(JSON.parse(response.data))
                    }else{
                    alert('Fail');
                    }
                },
                });
            }
        });

        function showJsonData(data) {
            let result = '';
            for (const [key, value] of Object.entries(data)) {  
                result += `<span class="mb-2 text-xs">${key}: <span class="text-dark font-weight-bold ms-2">${value}</span></span>`;
            }
            $('#result').text('').append(result);
        }

    </script>
@endsection