@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card ">
                    <div class="card-body">
                        <h4 class="card-title">About Multi Images</h4>
                        <form method="POST" action="{{ route('store.multi.image') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="multiImage" class="col-sm-2 col-form-label">Multi Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" id="multitImage" name="multiImage[]" multiple="" accept=".png,.jpg">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="display_image" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg mt-3" id="display_image" src=" {{ url('upload/no_image.jpg') }}" alt="Card image cap">
                                </div>
                            </div>
                            <input type="submit" value="Add Multi Images" class="btn btn-info waves-effect waves-light">
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
