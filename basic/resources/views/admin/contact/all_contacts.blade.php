@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Contact Messages</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Messages</h4>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Subject</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach ( $contacts as $item  )
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td> {{ $item->name }}</td>
                                        <td> {{ $item->email }}</td>
                                        <td> {{ $item->phone }}</td>
                                        <td> {{ $item->subject }}</td>
                                        <td><a href="{{ route('delete.contact',$item->id) }}" class="btn btn-danger sm" id="delete" title="Delete"> <i class="fas fa-trash"></i></a></td>
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
