@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Update Multi Image</h4><br>
                    <form method="POST" action="{{ route('update.multi.image') }}" enctype="multipart/form-data">
                        @csrf
                    <input type="hidden" name="id" value="{{ $multiImage->id }}">
                    <div class="row mb-2">
                        <label for="multi_image" class="col-sm-2 col-form-label">Update Multi Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="multi_image"class="form-control" id="multi_image">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="showImage" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <img id="showImage" class="rounded avatar-lg" src="{{ asset($multiImage->multi_image) }}" alt="Card image cap">
                        </div>
                    </div>
                        <input type="submit" class="btn btn-success waves-effect waves-light" value="Update Multi Image">
                    </form><!-- end row -->
                </div>
            </div>
        </div> <!-- end col -->
    </div>


</div>
</div>

<script type="text/javascript">

    $(document).ready(function(){
        $('#multi_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>

@endsection
