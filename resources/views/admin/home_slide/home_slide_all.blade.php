@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Home Slide Page</h4>
                    <form method="POST" action="{{ route('update.slider') }}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $homeslide->id }}">

                    <div class="row mb-2">
                        <label for="title-input" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title"class="form-control"
                             value="{{ $homeslide->title }}"id="title-input">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="short_title-input" class="col-sm-2 col-form-label">Short Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="short_title"class="form-control"
                             value="{{ $homeslide->short_title }}"id="short_title-input">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="video_url-input" class="col-sm-2 col-form-label">Video URL</label>
                        <div class="col-sm-10">
                            <input type="text" name="video_url"class="form-control"
                             value="{{ $homeslide->video_url }}"id="video_url-input">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="home_slide-input" class="col-sm-2 col-form-label">Slider Image</label>
                        <div class="col-sm-10">
                            <input id="home_slide" type="file" name="home_slide"class="form-control" id="home_slide-input">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="showImage" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <img id="showImage" class="rounded avatar-lg" src="{{ (!empty($homeslide->home_slide))? url($homeslide->home_slide):url('upload/no_image.jpg') }}" alt="Card image cap">
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
        $('#home_slide').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>

@endsection
