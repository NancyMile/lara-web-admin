@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card ">
                    <div class="card-body">
                        <h4 class="card-title">Change Password</h4>
                        @if (count($errors))
                            @foreach ($errors->all() as $error )
                                <p class="alert alert-danger alert-dismissible fade show text-center">{{$error}}</p>
                            @endforeach
                        @endif
                        <form method="POST" action="{{ route('update.password') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="oldPassword" class="col-sm-2 col-form-label">Old Password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="password" placeholder="Old Password" id="oldPassword" name="oldPassword">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="newPassword" class="col-sm-2 col-form-label">New Password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="password" placeholder="New Password" id="newPassword" name="newPassword">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="confirmPassword" class="col-sm-2 col-form-label">Confirm Password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="password" placeholder="Confirm Password" id="confirmPassword" name="confirmPassword">
                                </div>
                            </div>
                            <input type="submit" value="Change Password" class="btn btn-info waves-effect waves-light">
                        </form>
                        <!-- end row -->
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#profile_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#display_image').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection
