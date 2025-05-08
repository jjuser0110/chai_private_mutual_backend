@extends('layouts.app')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Booking</h2>
    </header>

    @include('layouts.flash-message')

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12 mb-3">
            <section class="card">
                <!-- <div class="card-header" style="text-align: right;">
                    <a class="btn btn-xs btn-square btn-primary" href="{{route('bank.create')}}">Create</a>
                </div> -->
                <div class="card-body">
                    <table class="table table-bordered table-striped mb-0" id="datatable-default">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Project</th>
                                <th>Booking Amount</th>
                                <th>Number</th>
                                <th>Final Payment</th>
                                <th>Count Down To</th>
                                <th>Total Payment</th>
                                <th>Dividend Payment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($booking as $row=> $s)
                                <tr>
                                    <td>{{$row+1}}</td>
                                    <td>{{$s->user->username??''}}</td>
                                    <td>{{$s->product->product_name??''}}</td>
                                    <td>{{$s->booking_amount??''}}</td>
                                    <td>{{$s->number??''}}</td>
                                    <td>{{$s->final_payment??''}}</td>
                                    <td>{{$s->countdown??''}}</td>
                                    <td>{{$s->total_payment??''}}</td>
                                    <td>{{$s->dividend_amount??''}}</td>
                                    <td>{{$s->status??''}}</td>
                                    <td>
                                        @if($s->status == "Running")
                                        <a  title="Edit" onclick="openExtraModal({{$s}})" style="cursor:pointer" class="btn btn-primary btn-sm">Extra</a>
                                        @endif
                                        @if($s->status == "Pending Final Payment")
                                        <a  title="Edit" onclick="openAddTimeModal({{$s}})" style="cursor:pointer" class="btn btn-primary btn-sm">Add Time</a>
                                        @endif
                                        @if($s->status == "Running" || $s->status == "Complete Final Payment")
                                        <a  title="Edit" onclick="opendividendMOdal({{$s}})" style="cursor:pointer" class="btn btn-primary btn-sm">Divided</a>
                                        @endif

                                        @if($s->status != "Cancelled" && $s->status != "Finished")
                                        <a onclick="if(confirm('Are you sure you want to cancel and refund?')){window.location.href='{{ route('booking.destroy',$s) }}'}" title = "Delete" style="cursor:pointer" class="btn btn-warning btn-sm">CANCEL</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>


<div class="modal" id="extraModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="post" action="{{ route('booking.extra') }}" onsubmit="return onSubmitForm()">
                <div class="modal-header">
                    <h5 class="modal-title"><b style="color:green">Number of Times</b></h5>
                    <a class="btn-close" onclick="closeExtraModal()" aria-label="Close"></a>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="text" name="booking_id" id="booking_id" hidden>
                    <div class="mb-3">
                        <label class="col-form-label"><b style="color:green">Number of Times</b></label>
                        <input class="form-control" type="number" min="0" step="0.01" name="no_of_time" placeholder="0.00" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                    <a class="btn btn-default" onclick="closeExtraModal()">Close</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="dividendMOdal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="post" action="{{ route('booking.status') }}" onsubmit="return onSubmitForm()">
                <div class="modal-header">
                    <h5 class="modal-title"><b style="color:green">Dividend</b></h5>
                    <a class="btn-close" onclick="closedividendMOdal()" aria-label="Close"></a>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="text" name="booking_id_2" id="booking_id_2" hidden>
                    <div class="mb-3">
                        <label class="col-form-label"><b style="color:green">Dividend</b> Amount</label>
                        <input class="form-control" type="number" min="0" step="0.01" name="dividend_amount" placeholder="0.00" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                    <a class="btn btn-default" onclick="closedividendMOdal()">Close</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="addTimeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="post" action="{{ route('booking.add_countdown') }}" onsubmit="return onSubmitForm()">
                <div class="modal-header">
                    <h5 class="modal-title"><b style="color:green">Change Time of Countdown</b></h5>
                    <a class="btn-close" onclick="closeAddTimeModal()" aria-label="Close"></a>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="text" name="booking_id_3" id="booking_id_3" hidden>
                    <div class="mb-3">
                        <label class="col-form-label"><b style="color:green">Count Down</b> To</label>
                        <input class="form-control" type="datetime-local"  name="countdown_datetime" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                    <a class="btn btn-default" onclick="closeAddTimeModal()">Close</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openExtraModal(data){
        console.log(data);
        $("#extraModal").show();
        $("#booking_id").val(data.id);
    }

    function closeExtraModal(){
        $("#extraModal").hide();
    }

    function opendividendMOdal(data){
        console.log(data);
        $("#dividendMOdal").show();
        $("#booking_id_2").val(data.id);
    }

    function closedividendMOdal(){
        $("#dividendMOdal").hide();
    }

    function openAddTimeModal(data){
        console.log(data);
        $("#addTimeModal").show();
        $("#booking_id_3").val(data.id);
    }

    function closeAddTimeModal(){
        $("#addTimeModal").hide();
    }
</script>
@endsection

@section('page-js')
    <script src="{{ asset('porto-assets/vendor/select2/js/select2.js') }}"></script>
    <script src="{{ asset('porto-assets/vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('porto-assets/vendor/datatables/media/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('porto-assets/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('porto-assets/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('porto-assets/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('porto-assets/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('porto-assets/vendor/datatables/extras/TableTools/JSZip-2.5.0/jszip.min.js') }}"></script>
    <script src="{{ asset('porto-assets/vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js') }}"></script>
    <script src="{{ asset('porto-assets/vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js') }}"></script>
@endsection
@section('scripts')
    <script src="{{ asset('porto-assets/js/examples/examples.datatables.default.js') }}"></script>
    <script src="{{ asset('porto-assets/js/examples/examples.datatables.row.with.details.js') }}"></script>
    <script src="{{ asset('porto-assets/js/examples/examples.datatables.tabletools.js') }}"></script>
@endsection
