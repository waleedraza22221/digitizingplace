@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quotes</h1>

    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"></h6>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">


                    <table id="data-table" class="table table-striped dataTable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Budget</th>
                                <th>Status</th>
                                <th>Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footerscript')
    <script>
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.quote') }}',
            columns: [{
                    data: 'id'
                },
                {
                    data: 'user.name'
                },
                {
                    data: 'user.email'
                }, {
                    data: 'budget'
                },
                {
                    data: 'status'
                },
                {
                    data: 'view'
                }
            ],
            "order": [
                [0, "desc"]
            ]

        });
    </script>
@endsection
