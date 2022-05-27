@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Get Free Quote</h1>

    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="card shadow col-12">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"></h6>
                <a href="{{ route('quote.index') }}" class="btn btn-primary float-right">Pending Quotes</a>
            </div>
            <div class="card-body">

                <div class="dropzone-container svelte-12uhhij svelte-12uhhij">

                    <form method="POST" action="{{ route('postquote') }}" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <input class="form-control form-control-lg" name="sourcefiles[]" required multiple type="file">
                        </div>
                        <div class="row my-5">
                            <label for="budget"
                                class="col-md-4 col-form-label text-md-end">{{ __('Your Budget $') }}</label>

                            <div class="col-md-3">
                                <input id="budget" type="number" class="form-control @error('budget') is-invalid @enderror"
                                    name="budget" value="{{ old('budget') }}" required autocomplete="budget" autofocus>

                                @error('budget')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-5">
                            <label for="service_id"
                                class="col-md-4 col-form-label text-md-end">{{ __('Select Service') }}</label>

                            <div class="col-md-3">
                                <select required class="custom-select my-1 mr-sm-2" name="service_id" id="service_id">
                                    <option selected>Choose...</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                                @error('service_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-5">

                                <textarea required class="form-control" name="description" placeholder="Add Description"
                                    id="description" cols="40" rows="10"></textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col-md-12">
                                <div class="float-right mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Quote') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('footerscript')
@endsection
