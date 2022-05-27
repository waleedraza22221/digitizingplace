@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users</h1>

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
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-circle"><i class="fas fa-add"></i></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">


                    <table id="users-table" class="table table-striped dataTable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
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

    <div class="modal fade" id="editmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        <form id="delete" method="POST" action="">
                            @csrf
                            @method(' DELETE') <button class="btn btn-danger btn-circle"><i
                                    class="fas fa-trash"></i></button>
                        </form> Edit User
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input required type="text" name="name" class="form-control" id="name">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="Submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>



        </div>
    </div>
@endsection


@section('footerscript')
    <script>
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('users.index') }}',
            columns: [{
                    data: 'id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'edit',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#editmodel').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var name = button.data('name')
            var id = button.data('id') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)

            modal.find('.modal-body input').val(name)
            $('form').get(0).setAttribute('action', '/admin/users/' + id);
            $('form').get(1).setAttribute('action', '/admin/users/' + id);
        });
    </script>
@endsection
