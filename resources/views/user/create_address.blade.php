@extends('layouts.app')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>User Address Create/Edit</h2>
    </header>

    @include('layouts.flash-message')

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-6 mb-3">
            <section class="card">
                <form class="theme-form mega-form" enctype="multipart/form-data" @if (isset($user_address)) method="post" action="{{ route('user.update_address',$user_address) }}" @else method="post" action="{{ route('user.store_address',$user) }}" @endif>
                    @csrf
                    <div class="card-body">
                        <h6>Address Information</h6>
                        <div class="mb-3">
                            <label class="col-form-label">Contact Name<span style="color:red">*</span></label>
                            <input class="form-control" type="text" name="contact_name" placeholder="contact_name.." value="{{$user_address->contact_name??$user->name}}" required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Phone Number <span style="color:red">*</span></label>
                            <input class="form-control" type="text" name="phone_number" placeholder="phone_number.." value="{{$user_address->phone_number??$user->contact_no}}" required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Address <span style="color:red">*</span></label>
                            <textarea class="form-control" name="address" rows="5">{!! $user_address->address ?? '' !!}</textarea>
                        </div>
                        @if(isset($user_address))
                        <div class="mb-3">
                            <label class="col-form-label">Status <span style="color:red">*</span></label>
                            <select class="form-control" name="is_active">
                                <option value=1 <?php echo $user_address->is_active==1?'selected':'' ?>>Active</option>
                                <option value=0 <?php echo $user_address->is_active==0?'selected':'' ?>>Inactive</option>
                            </select>
                        </div>
                        @endif
                    </div>
                    <div class="card-footer text-end">
                        <a @if (isset($user_address)) href="{{route('user.edit',$user_address->user_id)}}" @else href="{{route('user.edit',$user)}}" @endif class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary" onclick="showLoading()">Submit</button>
                        <!-- <button class="btn btn-secondary">Cancel</button> -->
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</section>
@endsection
