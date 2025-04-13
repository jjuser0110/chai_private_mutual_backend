@extends('layouts.app')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Staff Create/Edit</h2>
    </header>

    @include('layouts.flash-message')

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12 mb-3">
            <section class="card">
                <form class="theme-form mega-form" enctype="multipart/form-data" @if (isset($staff)) method="post" action="{{ route('staff.update',$staff) }}" @else method="post" action="{{ route('staff.store') }}" @endif>
                    @csrf
                    <div class="card-body">
                        <h6>Staff Information</h6>
                        <div class="mb-3">
                            <label class="col-form-label">Name <span style="color:red">*</span></label>
                            <input class="form-control" type="text" name="name" placeholder="name..." value="{{$staff->name??''}}" required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Username <span style="color:red">*</span></label>
                            <input class="form-control" type="text" name="username" placeholder="username.." value="{{$staff->username??''}}">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Email</label>
                            <input class="form-control" type="text" name="email" placeholder="email.." value="{{$staff->email??''}}">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Contact No <span style="color:red">*</span></label>
                            <input class="form-control" type="text" name="contact_no" placeholder="contact no.." value="{{$staff->contact_no??''}}">
                        </div>
                        @if(isset($staff))
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
                        <a href="{{route('staff.index')}}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary" onclick="showLoading()">Submit</button>
                        <!-- <button class="btn btn-secondary">Cancel</button> -->
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
    <!-- end: page -->
</section>
@endsection
