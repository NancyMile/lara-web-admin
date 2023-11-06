@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
{{-- tags style --}}
<style type="text/css">
    .bootstrap-tagsinput .tag{
        margin-right: 2px;
        color: #b70000;
        font-weight: 700px;
    }
</style>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card ">
                    <div class="card-body">
                        <h4 class="card-title">Edit Blog</h4>
                        <form method="POST" action="{{ route('update.blog', $blog->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Blog category</label>
                                <div class="col-sm-10">
                                    <select name="blog_category_id" class="form-select" aria-label="Default select example">
                                        <option selected="">-- Select category --</option>
                                        @foreach ( $categories  as $item )
                                            <option value="{{ $item->id }}" {{ $item->id == $blog->blog_category_id ? 'selected' : '' }}>{{ $item->category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Title" id="title" name="title" value="{{ $blog->title }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="title" class="col-sm-2 col-form-label">Blog Tag</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" placeholder="Tags" data-role="tagsinput" name="tags" value="{{ $blog->tags }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea id="elm1" name="description">
                                        {{ $blog->description }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="image" class="col-sm-2 col-form-label">Blog Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" placeholder="Blog Image" id="image" name="image" accept=".png,.jpg">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="display_image" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg mt-3" id="display_image" src="{{ asset($blog->image) }}" alt="Card image cap">
                                </div>
                            </div>
                            <input type="submit" value="Update Blog" class="btn btn-info waves-effect waves-light">
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
