@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Footer Page</h4>
                    <form method="POST" action="{{ route('update.footer') }}">
                        @csrf

                        <input type="hidden" name="id" value="{{ $footerpage->id }}">


                    <div class="row mb-2">
                        <label for="short_desc-input" class="col-sm-2 col-form-label">Short Description</label>
                        <div class="col-sm-10">
                            <textarea required="" name="short_description" class="form-control" rows="5">{{ $footerpage->short_description }}</textarea>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="number-input" class="col-sm-2 col-form-label">Number</label>
                        <div class="col-sm-10">
                            <input type="text" name="number"class="form-control"
                             value="{{ $footerpage->number }}"id="number-input">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="email-input" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" name="email"class="form-control"
                             value="{{ $footerpage->email }}"id="email-input">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="address-input" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" name="address"class="form-control"
                             value="{{ $footerpage->address }}"id="address-input">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="instagram-input" class="col-sm-2 col-form-label">Instagram</label>
                        <div class="col-sm-10">
                            <input type="text" name="instagram"class="form-control"
                             value="{{ $footerpage->instagram }}"id="instagram-input">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="copyright-input" class="col-sm-2 col-form-label">Copyright</label>
                        <div class="col-sm-10">
                            <input type="text" name="copyright"class="form-control"
                             value="{{ $footerpage->copyright }}"id="copyright-input">
                        </div>
                    </div>
                        <input type="submit" class="btn btn-success waves-effect waves-light" value="Update Footer Page">
                    </form><!-- end row -->
                </div>
            </div>
        </div> <!-- end col -->
    </div>


</div>
</div>

@endsection
