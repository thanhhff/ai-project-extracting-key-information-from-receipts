@extends('layouts.master')
@section('content')

<main class="bg-light">

<div class="page-hero-section bg-image hero-mini" style="background-image: url(../assets/img/hero_mini.svg);">
  <div class="hero-caption">
    <div class="container fg-white h-100">
      <div class="row justify-content-center align-items-center text-center h-100">
        <div class="col-lg-6">
          <h3 class="mb-4 fw-medium">Information Extraction</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dark justify-content-center bg-transparent">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Information Extraction</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="page-section pt-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="card-page">
          <h5 class="fg-primary">Upload image</h5>
          <hr>
          <p>Upload your image in here!</p>
          <form action="" enctype="multipart/form-data" method="POST">
            <img src="{{asset('./assets/img/thumbnail.svg')}}" id="image-preview" width="100%" /><br>
            <input id="image-input" type="file" class="form-control" name="image">
            <hr>
            <div class="row justify-content-center">
              <a type="button" class="btn btn-outline-primary rounded-pill" id="upload-image">Process</a>
            </div>
          </form>
        </div>
      </div>
      <div class="col-lg-6">
      <div class="card-page">
          <h5 class="fg-primary">Results</h5>
          <hr>

          <div class="row pl-3">
              <div id="result"></div>
          </div>
        </div>
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

</main> <!-- .bg-light -->
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
        const table = document.createElement("table");

        for (const [key, value] of Object.entries(data)) {
            let tr = table.insertRow(-1);
            let tabCell = tr.insertCell(-1);
            tabCell.innerHTML = `<b>${key}</b>`;
            tabCell = tr.insertCell(-1);
            tabCell.innerHTML = `${value}`;
        }
        $('#result').text('').append(table);
    }

</script>
@endsection
