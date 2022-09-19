@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Edit Blog Category Page</h4><br>
                    <form method="POST" action="{{ route('update.blog.category', $blogcategory->id) }}">
                        @csrf

                    <div class="row mb-2">
                        <label for="blog_category-input" class="col-sm-2 col-form-label">Blog Category Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="blog_category"class="form-control"id="blog_category-input"
                            value="{{ $blogcategory->blog_category }}">
                            @error('blog_category')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                        <input type="submit" class="btn btn-success waves-effect waves-light" value="Edit Blog Category">
                    </form><!-- end row -->
                </div>
            </div>
        </div> <!-- end col -->
    </div>


</div>
</div>


@endsection
