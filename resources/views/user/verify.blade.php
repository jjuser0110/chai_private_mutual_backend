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
                <div class="card-body">
                    <h6>Verification Information</h6>
                    @if(isset($user))
                    <p>
                        Name : {{$user->name??''}}<br>
                        IC : {{$user->nric_no??''}}<br>
                        Contact No : {{$user->contact_no??''}}<br>
                        Email : {{$user->email??''}}<br>
                        Username : {{$user->username??''}}<br>
                    </p>
                    @endif
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
                </div>
                <div class="card-footer text-end">
                    <a href="javascript:history.back()" class="btn btn-secondary">Back</a>
                    <a href="{{route('user.reject_user',$user)}}" class="btn btn-warning">Reject</a>
                    <a href="{{route('user.verify_user',$user)}}" class="btn btn-success">Verify</a>
                </div>
            </section>
        </div>
    </div>
</div>
</section>
@endsection
