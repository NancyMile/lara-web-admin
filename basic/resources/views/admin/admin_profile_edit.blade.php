@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card ">
                    <div class="card-body">
                        <h4 class="card-title">Edit Profile</h4>
                        <form>
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Name" id="name" name="name" value="{{ $editData->name }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="email" placeholder="Email" id="email" name="name" value="{{ $editData->email }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="username" class="col-sm-2 col-form-label">User Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Username" id="username" name="username" value="{{ $editData->username }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="profile_image" class="col-sm-2 col-form-label">Profile Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" id="profile_image" name="profile_image" >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="profile_image" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg mt-3" src=" {{ asset('backend/assets/images/small/img-5.jpg') }}" alt="Card image cap">
                                </div>
                            </div>
                            <input type="submit" value="Update Profile" class="btn btn-info waves-effect waves-light">
                        </form>
                        <!-- end row -->
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>
@endsection
