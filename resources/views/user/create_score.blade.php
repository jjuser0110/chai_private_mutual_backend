@extends('layouts.app')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>User Score Create/Edit</h2>
    </header>

    @include('layouts.flash-message')

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-6 mb-3">
            <section class="card">
                <form class="theme-form mega-form" enctype="multipart/form-data" method="post" action="{{ route('user.store_score',$user) }}">
                    @csrf
                    <div class="card-body">
                        <h6>Bank Information</h6>
                        <p>80-100: <span style="color:#4CAF50">Good</span></p>
                        <p>60-79: <span style="color:#FFC107">Fair</span></p>
                        <p>40-59: <span style="color:#FF9800">Poor</span></p>
                        <p>20-39: <span style="color:#FF5722">Very Poor</span></p>
                        <p>0-19: <span style="color:#D32F2F">Extremely Poor</span></p>
                        <div class="mb-3">
                            <label class="col-form-label">Score<span style="color:red">*</span></label>
                            <input class="form-control" type="number" min="0" step="1" name="score" placeholder="score.." value="" required>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{route('user.edit',$user)}}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <!-- <button class="btn btn-secondary">Cancel</button> -->
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</section>
@endsection
