@extends('layouts.app')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>News Create/Edit</h2>
    </header>

    @include('layouts.flash-message')

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12 mb-3">
            <section class="card">
                <form class="theme-form mega-form" enctype="multipart/form-data" @if (isset($article)) method="post" action="{{ route('article.update',$article) }}" @else method="post" action="{{ route('article.store') }}" @endif>
                    @csrf
                    <div class="card-body">
                        <h6>Information</h6>
                        <div class="mb-3">
                            <label class="col-form-label">Title</label>
                            <input class="form-control" type="text" name="title" placeholder="article title" value="{{$article->title??''}}">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Short Description</label>
                            <input class="form-control" type="text" name="short_description" placeholder="short description" value="{{$article->short_description??''}}">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">News Date</label>
                            <input class="form-control" type="date" name="article_date"  value="{{$article->article_date??''}}">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Arrangement</label>
                            <input class="form-control" type="text" name="arrangement" placeholder="arrangement" value="{{$article->arrangement??''}}">
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
                            <label class="col-form-label">Description</label>
                            <textarea class="form-control" type="text" rows="6" name="description">{{$article->description??''}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Image</label>
                            <input class="form-control" type="file" name="file_attachment" accept="image/*">
                        </div>
                        @if(isset($article))
                        <div class="row">
                            @foreach($article->file_attachments as $banner)
                            <div class="col-lg-4">
                                <img style="width:300px; height:auto" src="{{asset('storage/'.$banner->file_path)}}??''">
                                <a class="btn btn-danger"  href="{{ route('image_destroy',$banner) }}">Delete</a>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{route('article.index')}}" class="btn btn-secondary">Back</a>
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
