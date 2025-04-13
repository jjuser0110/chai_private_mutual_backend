@extends('layouts.app')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>User</h2>
    </header>

    @include('layouts.flash-message')

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12 mb-3">
            <section class="card">
                <div class="card-header" style="text-align: right;">
                    <a class="btn btn-xs btn-square btn-primary" href="{{route('user.create')}}">Create</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped mb-0" id="datatable-default">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>User Username</th>
                                <th>User Email</th>
                                <th>User Contact No</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $s)
                                <tr>
                                    <td>{{$s->name??''}}</td>
                                    <td>{{$s->username??''}}</td>
                                    <td>{{$s->email??''}}</td>
                                    <td>{{$s->contact_no??''}}</td>
                                    <td><?php echo $s->is_active == 1?"<span style='color:#1bb500'>Active</span>":"<span style='color:red'>Inactive</span>" ?></td>
                                    <td>
                                        <a href="{{ route('user.edit',$s) }}" title="Edit"><i class="bx bx-edit-alt"></i></a>
                                        <a onclick="if(confirm('Are you sure you want to delete?')){window.location.href='{{ route('user.destroy',$s) }}'}" title = "Delete" style="cursor:pointer"><i class="bx bx-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>
@endsection

@section('page-js')
    <script src="{{ asset('porto-assets/vendor/select2/js/select2.js') }}"></script>
    <script src="{{ asset('porto-assets/vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('porto-assets/vendor/datatables/media/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('porto-assets/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('porto-assets/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('porto-assets/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('porto-assets/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('porto-assets/vendor/datatables/extras/TableTools/JSZip-2.5.0/jszip.min.js') }}"></script>
    <script src="{{ asset('porto-assets/vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js') }}"></script>
    <script src="{{ asset('porto-assets/vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js') }}"></script>
@endsection
@section('scripts')
    <script src="{{ asset('porto-assets/js/examples/examples.datatables.default.js') }}"></script>
    <script src="{{ asset('porto-assets/js/examples/examples.datatables.row.with.details.js') }}"></script>
    <script src="{{ asset('porto-assets/js/examples/examples.datatables.tabletools.js') }}"></script>
@endsection
