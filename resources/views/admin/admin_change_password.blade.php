@extends('admin.admin_master')
@section('admin')

<div class="page-content">
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Change Password Page</h4>
                    <br>

                    @if (count($errors))
                        @foreach ($errors->all() as $error)
                            <p class="alert alert-danger alert-dismissible fade show"> 
                                {{$error}} </p>
                        @endforeach
                        
                    @endif
                    <form method="POST" action="{{ route('update.password') }}" enctype="multipart/form-data">
                        @csrf

                    <div class="row mb-2">
                        <label for="old-password" class="col-sm-2 col-form-label">Current Password</label>
                        <div class="col-sm-10">
                            <input type="password"name="old_password"class="form-control"id="old-password">
                        </div>
                    </div>
                    
                    <div class="row mb-2">
                        <label for="new-password" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                            <input type="password"name="new_password"class="form-control"id="new-password">
                        </div>
                    </div>
                    
                    <div class="row mb-2">
                        <label for="confirm-password"class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                            <input type="password"name="confirm_password"class="form-control"id="confirm-password">
                        </div>
                    </div>

                    <input type="submit" class="btn btn-success waves-effect waves-light" value="Change Password">
                    </form><!-- end row -->
                </div>
            </div>
        </div> <!-- end col -->
    </div>

    
</div>
</div>
@endsection