@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All sent Quotes</h1>

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
                                    <th>Send On</th>
                                    <th>Estimate Budget $</th>
                                    <th>Service</th>
                                    <th>View</th>
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
@endsection


@section('footerscript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script>
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('quote.index') }}',
            columns: [{
                    data: 'created_at',
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

                    data: 'service.name',

                    orderable: false,
                    searchable: false
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return '<a href="\/quote\/' + data +
                            '"class="btn btn-primary btn-lg" ><i class="fa fa-search" aria-hidden="true"></i></a>';
                    },
                    orderable: false,
                    searchable: false
                }
            ],
            "order": [
                [0, "desc"]
            ]
        });
    </script>
@endsection
