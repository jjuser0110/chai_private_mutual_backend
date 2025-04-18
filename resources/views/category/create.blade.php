@extends('layouts.app')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Category Create/Edit</h2>
    </header>

    @include('layouts.flash-message')

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12 mb-3">
            <section class="card">
                <form class="theme-form mega-form" enctype="multipart/form-data" @if (isset($category)) method="post" action="{{ route('category.update',$category) }}" @else method="post" action="{{ route('category.store') }}" @endif>
                    @csrf
                    <div class="card-body">
                        <h6>Account Information</h6>
                        <div class="mb-3">
                            <label class="col-form-label">Category Name</label>
                            <input class="form-control" type="text" name="category_name" placeholder="category name" value="{{$category->category_name??''}}">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Password</label>
                            <input class="form-control" type="text" name="password" placeholder="password" value="{{$category->password??''}}">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Icon</label>
                            <input class="form-control" type="file" name="file_attachment" accept="image/*">
                        </div>
                        @if(isset($shop_item))
                        <div class="mb-3">
                            <label class="col-form-label">Status <span style="color:red">*</span></label>
                            <select class="form-control" name="is_active">
                                <option value=1 <?php echo $category->is_active == 1?'selected':'' ?>>Active</option>
                                <option value=0 <?php echo $category->is_active == 0?'selected':'' ?>>Inactive</option>
                            </select>
                        </div>
                        @endif
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{route('category.index')}}" class="btn btn-secondary">Back</a>
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
