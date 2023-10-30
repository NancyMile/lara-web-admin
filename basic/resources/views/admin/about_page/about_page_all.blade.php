@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card ">
                    <div class="card-body">
                        <h4 class="card-title">About Page</h4>
                        <form method="POST" action="{{ route('update.about') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $aboutPage->id }}">
                            <div class="row mb-3">
                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Title" id="title" name="title" value="{{ $aboutPage->title }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="shortTitle" class="col-sm-2 col-form-label">Short Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Short Title" id="shortTitle" name="shortTitle" value="{{ $aboutPage->short_title }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="shortDescription" class="col-sm-2 col-form-label">Short Description</label>
                                <div class="col-sm-10">
                                    <textarea required="" name="shortDescription" class="form-control" rows="5">
                                        {{ $aboutPage->short_description }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="longDescription" class="col-sm-2 col-form-label">Long Description</label>
                                <div class="col-sm-10">
                                    <textarea id="elm1" name="longDescription">
                                        {{ $aboutPage->long_description }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="aboutImage" class="col-sm-2 col-form-label">About Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" placeholder="About Image" id="aboutImage" name="aboutImage" value="{{ $aboutPage->about_image }}" accept=".png,.jpg">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="display_image" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg mt-3" id="display_image" src=" {{ !empty($aboutPage->about_image) ? url($aboutPage->about_image) : url('upload/no_image.jpg') }}" alt="Card image cap">
                                </div>
                            </div>
                            <input type="submit" value="Update Slide" class="btn btn-info waves-effect waves-light">
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
