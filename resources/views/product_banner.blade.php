@extends('layouts.app')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Product Banner</h2>
    </header>

    @include('layouts.flash-message')

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12 mb-3">
            <section class="card">
                <form class="theme-form mega-form" enctype="multipart/form-data"  method="post" action="{{ route('product_banner_store') }}">
                    @csrf
                    <div class="card-body">
                        <h6>Banners</h6>
                        <div class="mb-3">
                            <label class="col-form-label">Image</label>
                            <input class="form-control" type="file" name="file_attachment" accept="image/*" @if(isset($view)) disabled @endif>
                        </div>
                        <div class="row">
                            @foreach($product_banners as $banner)
                            <div class="col-lg-4">
                                <img style="width:300px; height:auto" src="{{asset('storage/'.$banner->file_path)}}??''">
                                <a class="btn btn-danger"  href="{{ route('image_destroy',$banner) }}">Delete</a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
    <!-- end: page -->
</section>
@endsection
