@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Portfolio Page</h4>
                    <form method="POST" action="{{ route('store.portfolio') }}" enctype="multipart/form-data">
                        @csrf


                    <div class="row mb-2">
                        <label for="portfolio_name-input" class="col-sm-2 col-form-label">Portfolio Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="portfolio_name"class="form-control"id="portfolio_name-input">
                            @error('portfolio_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="portfolio_title-input" class="col-sm-2 col-form-label">Portfolio Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="portfolio_title"class="form-control"id="portfolio_title-input">
                            @error('portfolio_title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="elm1" class="col-sm-2 col-form-label">Portfolio Description</label>
                        <div class="col-sm-10">
                            <textarea id="elm1" name="portfolio_description"></textarea>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="portfolio_image" class="col-sm-2 col-form-label">Portfolio Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="portfolio_image"class="form-control" id="portfolio_image">
                            @error('portfolio_image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="showImage" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <img id="showImage" class="rounded avatar-lg" src="{{ url('upload/no_image.jpg') }}" alt="Card image cap">
                        </div>
                    </div>
                        <input type="submit" class="btn btn-success waves-effect waves-light" value="Insert Portfolio Data">
                    </form><!-- end row -->
                </div>
            </div>
        </div> <!-- end col -->
    </div>


</div>
</div>

<script type="text/javascript">

    $(document).ready(function(){
        $('#portfolio_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>

@endsection
