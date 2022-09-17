@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">About Page</h4>
                    <form method="POST" action="{{ route('update.about') }}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $aboutpage->id }}">

                    <div class="row mb-2">
                        <label for="title-input" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title"class="form-control"
                             value="{{ $aboutpage->title }}"id="title-input">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="short_title-input" class="col-sm-2 col-form-label">Short Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="short_title"class="form-control"
                             value="{{ $aboutpage->short_title }}"id="short_title-input">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="short_desc-input" class="col-sm-2 col-form-label">Short Description</label>
                        <div class="col-sm-10">
                            <textarea required="" name="short_description" class="form-control" rows="5">{{ $aboutpage->short_description }}</textarea>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="long_desc-input" class="col-sm-2 col-form-label">Long Description</label>
                        <div class="col-sm-10">
                            <textarea id="elm1" name="long_description">{{ $aboutpage->long_description}}</textarea>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="about_image" class="col-sm-2 col-form-label">About Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="about_image"class="form-control" id="about_image">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="showImage" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <img id="showImage" class="rounded avatar-lg" src="{{ (!empty($about->about_image))? url($about->about_image):url('upload/no_image.jpg') }}" alt="Card image cap">
                        </div>
                    </div>
                        <input type="submit" class="btn btn-success waves-effect waves-light" value="Update Profile">
                    </form><!-- end row -->
                </div>
            </div>
        </div> <!-- end col -->
    </div>


</div>
</div>

<script type="text/javascript">

    $(document).ready(function(){
        $('#about_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>

@endsection
