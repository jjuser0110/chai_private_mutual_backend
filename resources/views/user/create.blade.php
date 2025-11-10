@extends('layouts.app')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>User Create/Edit</h2>
    </header>

    @include('layouts.flash-message')

    <!-- start: page -->
    @if(isset($user))
    <div class="row">
        <div class="col-lg-12">
            <a class="btn btn-secondary" style="float:right" onclick="openDepoModal()">Deposit</a>
            <a class="btn btn-primary" style="float:right;margin-right:10px" onclick="openPointModal()">Shop Point</a>
        </div>
    </div>
    @endif
    <div class="row" style="padding-top:10px">
        <div class="col-lg-6 mb-3">
            <section class="card">
                <form class="theme-form mega-form" enctype="multipart/form-data" @if (isset($user)) method="post" action="{{ route('user.update',$user) }}" @else method="post" action="{{ route('user.store') }}" @endif>
                    @csrf
                    <div class="card-body">
                        <h6>User Information</h6>
                        @if(isset($user))
                        <p>
                            Total Money : {{$user->total_money??''}}<br>
                            Available Fund : {{$user->available_fund??''}}<br>
                            Unavailable Fund : {{$user->unavailable_fund??''}}<br>
                            Income : {{$user->income??''}}<br>
                            Shop Point : {{$user->shop_point??''}}<br>
                        </p>
                        @endif
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Name <span style="color:red">*</span></label>
                                    <input class="form-control" type="text" name="name" placeholder="name..." value="{{$user->name??''}}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Username <span style="color:red">*</span></label>
                                    <input class="form-control" type="text" name="username" placeholder="username.." value="{{$user->username??''}}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Email</label>
                                    <input class="form-control" type="email" name="email" placeholder="email.." value="{{$user->email??''}}">
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">ID Card <span style="color:red">*</span></label>
                                    <input class="form-control" type="text" name="nric_no" placeholder="nric no.." value="{{$user->nric_no??''}}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Contact No <span style="color:red">*</span></label>
                                    <input class="form-control" type="text" name="contact_no" placeholder="contact no.." value="{{$user->contact_no??''}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="mb-3">
                                    <label class="col-form-label">User Level</label>
                                    <select class="form-control" name="medal">
                                        <option value='Ordinary' <?php echo isset($user)&&$user->medal == 'Ordinary'?'selected':'' ?>>Ordinary</option>
                                        <option value='Silver' <?php echo isset($user)&&$user->medal == 'Silver'?'selected':'' ?>>Silver</option>
                                        <option value='Gold' <?php echo isset($user)&&$user->medal == 'Gold'?'selected':'' ?>>Gold</option>
                                        <option value='Diamond' <?php echo isset($user)&&$user->medal == 'Diamond'?'selected':'' ?>>Diamond</option>
                                        <option value='Platinum' <?php echo isset($user)&&$user->medal == 'Platinum'?'selected':'' ?>>Platinum</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Password</label>
                                    <input class="form-control" type="text" name="password" placeholder="password.." @if(!isset($user)) required @endif>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Fund Password (8 digit)</label>
                                    <input class="form-control" type="text" name="fund_password" placeholder="fund_password.." value="{{$user->fund_password??''}}" >
                                </div>
                                @if(isset($user))
                                <div class="mb-3">
                                    <label class="col-form-label">Status <span style="color:red">*</span></label>
                                    <select class="form-control" name="is_active">
                                        <option value=1 <?php echo $user->is_active == 1?'selected':'' ?>>Active</option>
                                        <option value=0 <?php echo $user->is_active == 0?'selected':'' ?>>Inactive</option>
                                    </select>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{route('user.index')}}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <!-- <button class="btn btn-secondary">Cancel</button> -->
                    </div>
                </form>
            </section>
        </div>
        @if(isset($user))
        <div class="col-lg-6 mb-3">
            <section class="card">
                <div class="card-header" >
                    <h4>User Bank</h4>
                    <a class="btn btn-xs btn-square btn-primary" style="float: right;" href="{{route('user.create_bank',$user)}}">Create</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped mb-0" id="table-nopage">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Bank</th>
                                <th>Account No</th>
                                <th>Account Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->user_banks as $index=>$s)
                                <tr>
                                    <td>{{$index+1??''}}</td>
                                    <td>{{$s->bank->bank_name??''}}</td>
                                    <td>{{$s->account_no??''}}</td>
                                    <td>{{$s->full_name??''}}</td>
                                    <td><?php echo $s->is_active == 1?"<span style='color:#1bb500'>Active</span>":"<span style='color:red'>Inactive</span>" ?></td>
                                    <td>
                                        <a href="{{ route('user.edit_bank',$s) }}" title="Edit"><i class="bx bx-edit-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
            <section class="card">
                <div class="card-header" >
                    <h4>User Address</h4>
                    <a class="btn btn-xs btn-square btn-primary" style="float: right;" href="{{route('user.create_address',$user)}}">Create</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped mb-0" id="table-nopage">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Contact Name</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->user_addresses as $row=>$address)
                                <tr>
                                    <td>{{$row+1??''}}</td>
                                    <td>{{$address->contact_name??''}}</td>
                                    <td>{{$address->phone_number??''}}</td>
                                    <td>{{$address->address??''}}</td>
                                    <td><?php echo $address->is_active == 1?"<span style='color:#1bb500'>Active</span>":"<span style='color:red'>Inactive</span>" ?></td>
                                    <td>
                                        <a href="{{ route('user.edit_address',$address) }}" title="Edit"><i class="bx bx-edit-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
            <section class="card">
                <div class="card-header" >
                    <h4>User Score</h4>
                    <a class="btn btn-xs btn-square btn-primary" style="float: right;" href="{{route('user.create_score',$user)}}">Create</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped mb-0" id="table-nopage">
                        <thead>
                            <tr>
                                <th>Created At</th>
                                <th>Score</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->user_scores as $row=>$score)
                                <tr>
                                    <td>{{$score->created_at??''}}</td>
                                    <td>{{$score->score??''}}</td>
                                    <td>{{$score->value??''}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        
        <div class="row">
            <div class="col-lg-6">
            @isset($user->nric_front)
                <img src="{{ env('FRONT_URL') . '/storage/nric/' . $user->id .'/'. $user->nric_front }}" style="width:300px; height:auto" />
            @endisset
            </div>
            <div class="col-lg-6">
            @isset($user->nric_back)
                <img src="{{ env('FRONT_URL') . '/storage/nric/' . $user->id .'/'.  $user->nric_back }}" style="width:300px; height:auto" />
            @endisset
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <section class="card">
                    <div class="card-header" >
                        <h4>Money Record</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped mb-0" id="datatable-default">
                            <thead>
                                <tr>
                                    <th>Created At</th>
                                    <th>Type</th>
                                    <th>Before</th>
                                    <th>Amount</th>
                                    <th>After</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->money_records as $record)
                                    <tr>
                                        <td>{{$record->created_at??''}}</td>
                                        <td>{{$record->type??''}}</td>
                                        <td>{{$record->before_amount??''}}</td>
                                        <td>{{$record->amount??''}}</td>
                                        <td>{{$record->after_amount??''}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
            <hr>
            <div class="col-lg-12">
                <section class="card">
                    <div class="card-header" >
                        <h4>Shop Point History</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped mb-0" id="datatable-shoppoint">
                            <thead>
                                <tr>
                                    <th>Created At</th>
                                    <th>Type</th>
                                    <th>Before</th>
                                    <th>Amount</th>
                                    <th>After</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->shop_points as $rec)
                                    <tr>
                                        <td>{{$rec->created_at??''}}</td>
                                        <td>{{$rec->type??''}}</td>
                                        <td>{{$rec->prev_amount??''}}</td>
                                        <td>{{$rec->amount??''}}</td>
                                        <td>{{$rec->final_amount??''}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </div><hr>
            <div class="col-lg-12">
                <section class="card">
                    <div class="card-header" >
                        <h4>withdraw Record</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped mb-0" id="datatable-withdraw">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Amount</th>
                                    <th>Bank</th>
                                    <th>Account</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->withdraws as $s)
                                    <tr>
                                        <td>{{$s->user->username??''}}</td>
                                        <td>{{$s->amount??''}}</td>
                                        <td>{{$s->user_bank->bank->bank_name??''}}</td>
                                        <td>{{$s->user_bank->account_no??''}}</td>
                                        <td>{{$s->user_bank->full_name??''}}</td>
                                        <td>{{$s->created_at??''}}</td>
                                        <td>{{$s->status??''}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
        @endif
    </div>
</div>

<div class="modal" id="DepoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="post" action="{{ route('user.deposit') }}" onsubmit="return onSubmitForm()">
                <div class="modal-header">
                    <h5 class="modal-title"><b style="color:green">Deposit</b></h5>
                    <a class="btn-close" onclick="closeDepoModal()" aria-label="Close"></a>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="text" name="user_id" value="{{$user->id??''}}" hidden>
                    <div class="mb-3">
                        <label class="col-form-label"><b style="color:green">Deposit</b> Amount</label>
                        <input class="form-control" type="number" step="0.01" name="deposit_amount" placeholder="0.00" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                    <a class="btn btn-default" onclick="closeDepoModal()">Close</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="PointModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="post" action="{{ route('user.point') }}" onsubmit="return onSubmitForm()">
                <div class="modal-header">
                    <h5 class="modal-title"><b style="color:green">Shop Point</b></h5>
                    <a class="btn-close" onclick="closePointModal()" aria-label="Close"></a>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="text" name="user_id" value="{{$user->id??''}}" hidden>
                    <div class="mb-3">
                        <label class="col-form-label"><b style="color:green">Shop Point</b></label>
                        <input class="form-control" type="number" name="shop_point" placeholder="-/+ 5" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                    <a class="btn btn-default" onclick="closePointModal()">Close</a>
                </div>
            </form>
        </div>
    </div>
</div>

</section>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function openDepoModal(){
        $("#DepoModal").show();
    }

    function closeDepoModal(){
        $("#DepoModal").hide();
    }

    function openPointModal(){
        $("#PointModal").show();
    }

    function closePointModal(){
        $("#PointModal").hide();
    }
    $(document).ready(function() {
        $('#datatable-shoppoint').DataTable({
            dom: '<"row mb-3"<"col-lg-6"l><"col-lg-6"f>>' +
                '<"table-responsive"tr>' +
                '<"row mt-3"<"col-lg-12"p>>'
        });
        
        $('#datatable-withdraw').DataTable({
            dom: '<"row mb-3"<"col-lg-6"l><"col-lg-6"f>>' +
                '<"table-responsive"tr>' +
                '<"row mt-3"<"col-lg-12"p>>'
        });
    });

</script>
@endsection
