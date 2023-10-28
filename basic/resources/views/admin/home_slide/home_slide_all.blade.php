@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card ">
                    <div class="card-body">
                        <h4 class="card-title">Home Slide</h4>
                        <form method="POST" action="{{ route('store.profile') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Title" id="title" name="title" value="{{ $homeSlide->title }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="shortTitle" class="col-sm-2 col-form-label">Short Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Short Title" id="shortTitle" name="shortTitle" value="{{ $homeSlide->short_title }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="homeSlide" class="col-sm-2 col-form-label">HomeSlide</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Home Slide" id="homeSlide" name="homeSlide" value="{{ $homeSlide->home_slide }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="videoUrl" class="col-sm-2 col-form-label">Video Url</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="videoUrl" name="videoUrl" value="{{ $homeSlide->video_url }}">
                                </div>
                            </div>
                            <input type="submit" value="Save" class="btn btn-info waves-effect waves-light">
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
