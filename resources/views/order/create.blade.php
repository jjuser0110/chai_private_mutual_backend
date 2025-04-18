@extends('layouts.app')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Order Create/Edit</h2>
    </header>

    @include('layouts.flash-message')

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12 mb-3">
            <section class="card">
                <form class="theme-form mega-form" enctype="multipart/form-data" @if (isset($order)) method="post" action="{{ route('order.update',$order) }}" @else method="post" action="{{ route('order.store') }}" @endif>
                    @csrf
                    <div class="card-body">
                        <h6>Account Information</h6>
                        <p>Order No : {{$order->order_no ??''}}</p>
                        <p>User : {{$order->user->name ??''}}</p>
                        <p>Item : {{$order->shop_item->item_name ??''}}</p>
                        <p>Item Point : {{$order->shop_item->item_point ??''}}</p>
                        <b>Delivery Details</b>
                        <p>Contact Name : {{$order->user_address->contact_name ??''}}</p>
                        <p>Contact No : {{$order->user_address->phone_number ??''}}</p>
                        <p>Address : {{$order->user_address->address ??''}}</p>
                        <div class="mb-3">
                            <label class="col-form-label">Status <span style="color:red">*</span></label>
                            <select class="form-control" name="status">
                                <option value="Not Shipped" <?php echo $order->status == "Not Shipped"?'selected':'' ?>>Not Shipped</option>
                                <option value="Shipped" <?php echo $order->status == "Shipped"?'selected':'' ?>>Shipped</option>
                                <option value="Completed" <?php echo $order->status == "Completed"?'selected':'' ?>>Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{route('order.index')}}" class="btn btn-secondary">Back</a>
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
