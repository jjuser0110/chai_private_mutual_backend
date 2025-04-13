@extends('layouts.app')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>User Create/Edit</h2>
    </header>

    @include('layouts.flash-message')

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-6 mb-3">
            <section class="card">
                <form class="theme-form mega-form" enctype="multipart/form-data" @if (isset($user)) method="post" action="{{ route('user.update',$user) }}" @else method="post" action="{{ route('user.store') }}" @endif>
                    @csrf
                    <div class="card-body">
                        <h6>User Information</h6>
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
                            <input class="form-control" type="text" name="password" placeholder="password.." value="{{$user->password??''}}" required>
                        </div>
                        @if(isset($user))
                        <div class="mb-3">
                            <label class="col-form-label">Status <span style="color:red">*</span></label>
                            <select class="form-control" name="is_active">
                                <option value=1>Active</option>
                                <option value=0>Inactive</option>
                            </select>
                        </div>
                        @endif
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{route('user.index')}}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary" onclick="showLoading()">Submit</button>
                        <!-- <button class="btn btn-secondary">Cancel</button> -->
                    </div>
                </form>
            </section>
        </div>
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
        </div>
    </div>
</div>
    <!-- end: page -->
</section>
@endsection
