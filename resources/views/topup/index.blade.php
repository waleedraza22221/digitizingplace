@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Balance History</h1>

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
                                    <th>Amount $</th>
                                    <th>Added On</th>
                                    <th>Ref No</th>

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
            ajax: '{{ route('topup.index') }}',
            columns: [{
                    data: 'amount',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'created_at',
                    orderable: false,
                    searchable: false,
                    type: 'date',
                    render: function(data, type, row) {
                        return data ? moment(data).format('DD/MM/YYYY') : '';
                    }
                },
                {
                    data: 'refid',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    </script>
@endsection
