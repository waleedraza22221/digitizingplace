@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Awaiting Payments</h1>

    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"></h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">


                        <table id="data-table" class="table table-striped dataTable" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Send Quote On</th>
                                    <th>Recieved On</th>
                                    <th>Estimate Budget Was</th>
                                    <th>Quote Amount</th>
                                    <th>Service</th>
                                    <th>Payment Now</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>




    <div class="modal fade" id="paymodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Make <b id="amount"></b> $ Payment
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">DP Balance: <b>{{ Auth::user()->balance }}</b>
                            <hr />
                            <form method="POST" action="{{ route('paybydp') }}">
                                @csrf
                                <input type="hidden" name="id" id="oid" />
                                <input type="hidden" name="amount" id="amt" />
                                <button type="submit" id="dpbtn" class="btn btn-warning">Pay Now</button>
                            </form>

                        </div>

                        <div class="col-md-6">PayPal Or Cards
                            <hr />
                            <a href="#" class="btn btn-success" id="pp">Pay Now</a>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">

                </div>
                </form>
            </div>



        </div>
    </div>
@endsection


@section('footerscript')
    <script>
        $('.paynow').on('click', function(e) {
            alert('asd');
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script>
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('quote.awaitingpayments') }}',
            columns: [{
                    data: 'created_at',
                    type: 'date',
                    render: function(data, type, row) {
                        return data ? moment(data).utc().format("LL") : '';
                    }
                },
                {
                    data: 'orderaddons[0].created_at',
                    type: 'date',
                    render: function(data, type, row) {
                        return data ? moment(data).utc().format("LL") : '';
                    }
                },
                {
                    data: 'budget',
                    orderable: false,
                    searchable: false,

                },
                {
                    data: 'orderaddons[0].amount',
                    orderable: false,
                    searchable: false,
                },
                {

                    data: 'service.name',

                    orderable: false,
                    searchable: false
                },
                {
                    data: 'edit',
                    orderable: false,
                    searchable: false
                }
            ],
            "order": [
                [1, "desc"]
            ]
        });


        var dpbalance = {{ Auth::user()->balance }};
        var amount = 0;
        var id = 0;

        $('#paymodel').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            amount = button.data('amount')
            id = button.data('id') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            //dpbtn
            modal.find('#amount').html(amount)
            // alert(amount);
            //oid,amt
            modal.find('#oid').val(id);
            modal.find('#amt').val(amount);

            if (amount > dpbalance) {
                $('#dpbtn').addClass('d-none');

            }
        })


        $('#paymodel').on('hidden.bs.modal', function(e) {
            $('#dpbtn').removeClass('d-none');
        });


        $('#pp').on('click', function(e) {

            TwoCoInlineCart.setup.setMode('DYNAMIC');
            TwoCoInlineCart.cart.setCurrency('USD');
            TwoCoInlineCart.products.add({
                name: 'Digitizing Place Service',
                quantity: 1,
                price: amount
            });
            TwoCoInlineCart.cart.setReturnMethod({
                type: 'redirect',
                url: 'http:\/\/localhost:8000\/processing'
            });
            TwoCoInlineCart.cart.setTest(true);
            TwoCoInlineCart.cart.setOrderExternalRef(id);
            TwoCoInlineCart.cart.checkout();
        });
    </script>
@endsection
