@extends('layouts.app')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Withdraw Create/Edit</h2>
    </header>

    @include('layouts.flash-message')

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12 mb-3">
            <section class="card">
                <form class="theme-form mega-form" enctype="multipart/form-data" @if (isset($withdraw)) method="post" action="{{ route('withdraw.update',$withdraw) }}" @else method="post" action="{{ route('withdraw.store') }}" @endif>
                    @csrf
                    <div class="card-body">
                        <h6>Account Information</h6>
                        <p>User : {{$withdraw->user->username ??''}}</p>
                        <p>Bank : {{$withdraw->user_bank->bank->bank_name ??''}}</p>
                        <p>Account : {{$withdraw->user_bank->account_no ??''}}</p>
                        <p>Name : {{$withdraw->user_bank->full_name ??''}}</p>
                        <p>Created At : {{$withdraw->created_at ??''}}</p>
                        <div class="mb-3">
                            <label class="col-form-label">Status <span style="color:red">*</span></label>
                            <select class="form-control" name="status" @if($withdraw->status != "Pending") disabled @endif>
                                <option value="Pending" <?php echo $withdraw->status == "Pending"?'selected':'' ?>>Pending</option>
                                <option value="Rejected" <?php echo $withdraw->status == "Rejected"?'selected':'' ?>>Rejected</option>
                                <option value="Approved" <?php echo $withdraw->status == "Approved"?'selected':'' ?>>Approved</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{route('withdraw.index')}}" class="btn btn-secondary">Back</a>
                        @if($withdraw->status == "Pending")  
                        <button type="submit" class="btn btn-primary">Submit</button>
                        @endif
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
    <!-- end: page -->
</section>
@endsection
