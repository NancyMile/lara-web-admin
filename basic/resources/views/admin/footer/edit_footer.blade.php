@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card ">
                    <div class="card-body">
                        <h4 class="card-title">Footer</h4>
                        <form method="POST" action="{{ route('update.footer') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $footer->id }}">
                            <div class="row mb-3">
                                <label for="title" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Phone" id="phone" name="phone" value="{{ $footer->phone }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="shortTitle" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Description" id="description" name="description" value="{{ $footer->description }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="title" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Address" id="address" name="address" value="{{ $footer->address }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="title" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="email" placeholder="Email" id="email" name="email" value="{{ $footer->email }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="title" class="col-sm-2 col-form-label">Facebook</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Facebook" id="facebook" name="facebook" value="{{ $footer->facebook }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="title" class="col-sm-2 col-form-label">Twitter</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Twitter" id="twitter" name="twitter" value="{{ $footer->twitter }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="title" class="col-sm-2 col-form-label">Copy Right</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="copy_right" id="copy_right" name="copy_right" value="{{ $footer->copy_right }}">
                                </div>
                            </div>
                            <input type="submit" value="Update Footer" class="btn btn-info waves-effect waves-light">
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
