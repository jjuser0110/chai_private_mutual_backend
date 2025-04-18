@extends('layouts.app')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Shop Item Create/Edit</h2>
    </header>

    @include('layouts.flash-message')

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12 mb-3">
            <section class="card">
                <form class="theme-form mega-form" enctype="multipart/form-data" @if (isset($shop_item)) method="post" action="{{ route('shop_item.update',$shop_item) }}" @else method="post" action="{{ route('shop_item.store') }}" @endif>
                    @csrf
                    <div class="card-body">
                        <h6>Account Information</h6>
                        <div class="mb-3">
                            <label class="col-form-label">Item Name</label>
                            <input class="form-control" type="text" name="item_name" placeholder="item name" value="{{$shop_item->item_name??''}}">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Item Point</label>
                            <input class="form-control" type="text" name="item_point" placeholder="point" value="{{$shop_item->item_point??''}}">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Item Description</label>
                            <textarea class="form-control" name="item_details" rows="5">{{$shop_item->item_details??''}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Image</label>
                            <input class="form-control" type="file" name="file_attachment" accept="image/*" @if(isset($view)) disabled @endif>
                        </div>
                        @if(isset($shop_item))
                        <div class="mb-3">
                            <label class="col-form-label">Status <span style="color:red">*</span></label>
                            <select class="form-control" name="is_active">
                                <option value=1 <?php echo $shop_item->is_active == 1?'selected':'' ?>>Active</option>
                                <option value=0 <?php echo $shop_item->is_active == 0?'selected':'' ?>>Inactive</option>
                            </select>
                        </div>
                        <div class="row">
                            @foreach($shop_item->file_attachments as $banner)
                            <div class="col-lg-4">
                                <img style="width:300px; height:auto" src="{{asset('storage/'.$banner->file_path)}}??''">
                                <a class="btn btn-danger"  href="{{ route('image_destroy',$banner) }}">Delete</a>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{route('shop_item.index')}}" class="btn btn-secondary">Back</a>
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
