@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<style type="text/css">
    .bootstrap-tagsinput .tag{
        margin-right: 2px;
        color: black;
        background-color: rgb(135, 221, 185);
        font-weight: 700px;
    }
</style>

<div class="page-content">
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Add Blog Page</h4><br>
                    <form method="POST" action="{{ route('store.blog') }}" enctype="multipart/form-data">
                        @csrf


                    <div class="row mb-2">
                        <label for="blog_category-input" class="col-sm-2 col-form-label">Blog Category</label>
                        <div class="col-sm-10">
                            <select name="blog_category_id"class="form-select" aria-label="Default select example">
                                <option selected="">Select Category</option>
                                @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->blog_category }}</option>
                                @endforeach

                                </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="blog_title-input" class="col-sm-2 col-form-label">Blog Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="blog_title"class="form-control"id="blog_title-input">
                            @error('blog_title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Blog Tags </label>
                        <div class="col-sm-10">
                            <input name="blog_tags" value="home,tech" class="form-control" type="text" data-role="tagsinput">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="elm1" class="col-sm-2 col-form-label">Blog Description</label>
                        <div class="col-sm-10">
                            <textarea id="elm1" name="blog_description"></textarea>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="blog_image" class="col-sm-2 col-form-label">Blog Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="blog_image"class="form-control" id="blog_image">
                            @error('blog_image')
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
                        <input type="submit" class="btn btn-success waves-effect waves-light" value="Insert Blog Data">
                    </form><!-- end row -->
                </div>
            </div>
        </div> <!-- end col -->
    </div>


</div>
</div>

<script type="text/javascript">

    $(document).ready(function(){
        $('#blog_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>

@endsection
