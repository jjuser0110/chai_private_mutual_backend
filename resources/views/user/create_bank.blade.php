@extends('layouts.app')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>User Bank Create/Edit</h2>
    </header>

    @include('layouts.flash-message')

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-6 mb-3">
            <section class="card">
                <form class="theme-form mega-form" enctype="multipart/form-data" @if (isset($user_bank)) method="post" action="{{ route('user.update_bank',$user_bank) }}" @else method="post" action="{{ route('user.store_bank',$user) }}" @endif>
                    @csrf
                    <div class="card-body">
                        <h6>Bank Information</h6>
                        <div class="mb-3">
                            <label class="col-form-label">Bank <span style="color:red">*</span></label>
                            <select class="form-control" name="bank_id">
                                @foreach($bank as $b)
                                <option value = "{{$b->id??''}}" <?php echo isset($user_bank)&& $user_bank->bank_id==$b->id?'selected':'' ?>>{{$b->bank_name??''}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Account No <span style="color:red">*</span></label>
                            <input class="form-control" type="text" name="account_no" placeholder="account_no.." value="{{$user_bank->account_no??''}}" required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Full Name <span style="color:red">*</span></label>
                            <input class="form-control" type="text" name="full_name" placeholder="full_name.." value="{{$user_bank->full_name??$user->name}}" required>
                        </div>
                        @if(isset($user_bank))
                        <div class="mb-3">
                            <label class="col-form-label">Status <span style="color:red">*</span></label>
                            <select class="form-control" name="is_active">
                                <option value=1 <?php echo $user_bank->is_active==1?'selected':'' ?>>Active</option>
                                <option value=0 <?php echo $user_bank->is_active==0?'selected':'' ?>>Inactive</option>
                            </select>
                        </div>
                        @endif
                    </div>
                    <div class="card-footer text-end">
                        <a @if (isset($user_bank)) href="{{route('user.edit',$user_bank->user_id)}}" @else href="{{route('user.edit',$user)}}" @endif class="btn btn-secondary">Back</a>
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
