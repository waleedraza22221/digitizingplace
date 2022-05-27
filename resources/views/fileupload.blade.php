@extends('layouts.app')

@section('content')
    <h1>File Upload</h1>
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Drop Files</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">

                <div class="dropzone-container svelte-12uhhij svelte-12uhhij">
                    <form action="{{ url('user/upload') }}" class="dropzone" style="    border-radius: 2.5rem;
                        border: 3px solid white;
                        background: white;
                        width: 21.875rem;
                        height: 15.875rem;
                        width: 100%;
                        max-width: 21.875rem;
                        margin: auto;
                        box-shadow: 0 .625rem 1.25rem #0000001a;" id="my-awesome-dropzone"></form>
                </div>
            </div>
        </div>
    </div>
@endsection
