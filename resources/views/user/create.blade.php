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
                            Available Fund : {{$user->available_fund??''}}<br>
                            Invitation Code : {{$user->invitation_code??''}}<br>
                            Upline : {{$user->upline_detail->username??''}}
                        </p>
                        @endif
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Name <span style="color:red">*</span></label>
                                    <input class="form-control" type="text" name="name" placeholder="name..." value="{{$user->name??''}}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Email</label>
                                    <input class="form-control" type="email" name="email" placeholder="email.." value="{{$user->email??''}}">
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">ID Card <span style="color:red">*</span></label>
                                    <input class="form-control" type="text" name="id_card" placeholder="id_card.." value="{{$user->id_card??''}}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Contact No <span style="color:red">*</span></label>
                                    <input class="form-control" type="text" name="contact_no" placeholder="contact no.." value="{{$user->contact_no??''}}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Username <span style="color:red">*</span></label>
                                    <input class="form-control" type="text" name="username" placeholder="username.." value="{{$user->username??''}}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Password</label>
                                    <input class="form-control" type="text" name="password" placeholder="password.." @if(!isset($user)) required @endif>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="mb-3">
                                    <label class="col-form-label">User Level</label>
                                    <select class="form-control" name="medal">
                                        <option value='Ordinary' <?php echo isset($product)&&$product->medal == 'Ordinary'?'selected':'' ?>>Ordinary</option>
                                        <option value='Silver' <?php echo isset($product)&&$product->medal == 'Silver'?'selected':'' ?>>Silver</option>
                                        <option value='Gold' <?php echo isset($product)&&$product->medal == 'Gold'?'selected':'' ?>>Gold</option>
                                        <option value='Diamond' <?php echo isset($product)&&$product->medal == 'Diamond'?'selected':'' ?>>Diamond</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Income</label>
                                    <input class="form-control" type="number" min="0" step="0.01" name="income" placeholder="income.." value="{{$user->income??''}}" >
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Fund Password (6 digit)</label>
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
                    <table class="table table-bordered table-striped mb-0" id="datatable-default">
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
                    <table class="table table-bordered table-striped mb-0" id="datatable-default">
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
                    <table class="table table-bordered table-striped mb-0" id="datatable-default">
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
                        <input class="form-control" type="number" min="0" step="0.01" name="deposit_amount" placeholder="0.00" required>
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

</section>

<script>
    function openDepoModal(){
        $("#DepoModal").show();
    }

    function closeDepoModal(){
        $("#DepoModal").hide();
    }
</script>
@endsection
