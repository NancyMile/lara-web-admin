@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Blog</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Blog Data</h4>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Tags</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach ( $blog as $item  )
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item->category->category }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->tags }}</td>
                                        <td> <img src="{{ asset( $item->image ) }}" style="width:60px; height:50px;"> </td>
                                        <td><a href="" class="btn btn-info sm" title="Edit"> <i class="fas fa-edit"></i></a>
                                            <a href="" class="btn btn-danger sm" id="delete" title="Delete"> <i class="fas fa-trash"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div> <!-- container-fluid -->
</div>
@endsection
