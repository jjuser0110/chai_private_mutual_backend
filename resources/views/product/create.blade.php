@extends('layouts.app')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Product Create/Edit</h2>
    </header>

    @include('layouts.flash-message')

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12 mb-3">
            <section class="card">
                <form class="theme-form mega-form" enctype="multipart/form-data" @if (isset($product)) method="post" action="{{ route('product.update',$product) }}" @else method="post" action="{{ route('product.store') }}" @endif>
                    @csrf
                    <div class="card-body">
                        <h6>Account Information</h6>
                        <div class="mb-3">
                            <label class="col-form-label">Product Name</label>
                            <input class="form-control" type="text" name="product_name" placeholder="product name" value="{{$product->product_name??''}}">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Product Type</label>
                            <select class="form-control" name="product_type">
                                <option value='normal' <?php echo isset($product)&&$product->product_type == 'normal'?'selected':'' ?>>Normal</option>
                                <option value='booking' <?php echo isset($product)&&$product->product_type == 'booking'?'selected':'' ?>>Booking</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Category <span style="color:red">*</span></label>
                            <select class="form-control" name="product_category_id">
                                @foreach($category as $cat)
                                <option value="{{$cat->id??''}}" <?php echo isset($product)&&$product->product_category_id == $cat->id?'selected':'' ?>>{{$cat->category_name??''}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Product Price</label>
                            <input class="form-control" type="number" min="0" step="0.01" name="product_price" placeholder="product price" value="{{$product->product_price??''}}">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Product Percentage</label>
                            <input class="form-control" type="number" min="0" step="0.01" name="product_percentage" placeholder="product percentage" value="{{$product->product_percentage??''}}">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Product Size</label>
                            <input class="form-control" type="text" name="product_size" placeholder="product size" value="{{$product->product_size??''}}">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Earning Yield (%)</label>
                            <input class="form-control" type="text" name="earning_yield" placeholder="earning yield" value="{{$product->earning_yield??''}}">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Deadline Unit (days/hours)</label>
                            <input class="form-control" type="text" name="project_deadline" placeholder="project deadline" value="{{$product->project_deadline??''}}">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Investment Amount</label>
                            <input class="form-control" type="number" min="0" step="0.01" name="investment_amount" placeholder="investment amount" value="{{$product->investment_amount??''}}">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Investment Amount To</label>
                            <input class="form-control" type="number" min="0" step="0.01" name="investment_amount_to" placeholder="investment amount to" value="{{$product->investment_amount_to??''}}">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Description <span style="color:red">*</span></label>
                            <select class="form-control" name="description">
                                <option value='Ordinary' <?php echo isset($product)&&$product->description == 'Ordinary'?'selected':'' ?>>Ordinary</option>
                                <option value='Silver' <?php echo isset($product)&&$product->description == 'Silver'?'selected':'' ?>>Silver</option>
                                <option value='Gold' <?php echo isset($product)&&$product->description == 'Gold'?'selected':'' ?>>Gold</option>
                                <option value='Diamond' <?php echo isset($product)&&$product->description == 'Diamond'?'selected':'' ?>>Diamond</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">User Level <span style="color:red">*</span></label>
                            <select class="form-control" name="user_level">
                                <option value='Ordinary' <?php echo isset($product)&&$product->user_level == 'Ordinary'?'selected':'' ?>>Ordinary</option>
                                <option value='Silver' <?php echo isset($product)&&$product->user_level == 'Silver'?'selected':'' ?>>Silver</option>
                                <option value='Gold' <?php echo isset($product)&&$product->user_level == 'Gold'?'selected':'' ?>>Gold</option>
                                <option value='Diamond' <?php echo isset($product)&&$product->user_level == 'Diamond'?'selected':'' ?>>Diamond</option>
                            </select>
                        </div>
                        @if(isset($product))
                        <div class="mb-3">
                            <label class="col-form-label">Status <span style="color:red">*</span></label>
                            <select class="form-control" name="is_active">
                                <option value=1 <?php echo $product->is_active == 1?'selected':'' ?>>Active</option>
                                <option value=0 <?php echo $product->is_active == 0?'selected':'' ?>>Inactive</option>
                            </select>
                        </div>
                        @endif
                        <div class="mb-3">
                            <label class="col-form-label">Display</label>
                            <select class="form-control" name="display">
                                <option value=''>--Select--</option>
                                <option value='Home' <?php echo isset($product)&&$product->display == 'Home'?'selected':'' ?>>Home</option>
                                <option value='Join' <?php echo isset($product)&&$product->display == 'Join'?'selected':'' ?>>Join</option>
                                <option value='Home And Join' <?php echo isset($product)&&$product->display == 'Home And Join'?'selected':'' ?>>Home And Join</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Project Rules</label>
                            <textarea class="form-control" name="project_rules" rows="5">{{$product->project_rules??''}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Image</label>
                            <input class="form-control" type="file" name="file_attachment" accept="image/*">
                        </div>
                        @if(isset($product))
                        <div class="row">
                            @foreach($product->file_attachments as $banner)
                            <div class="col-lg-4">
                                <img style="width:300px; height:auto" src="{{asset('storage/'.$banner->file_path)}}??''">
                                <a class="btn btn-danger"  href="{{ route('image_destroy',$banner) }}">Delete</a>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{route('product.index')}}" class="btn btn-secondary">Back</a>
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
