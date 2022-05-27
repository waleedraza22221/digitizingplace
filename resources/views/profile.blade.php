@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Profile') }}</div>
                    <form>
                        <div class="card-body">

                            @if (session('message'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('message') }}
                                </div>
                                <script>
                                    window.setTimeout(function() {
                                        $(".alert").fadeTo(500, 0).slideUp(500, function() {
                                            $(this).remove();
                                        });
                                    }, 4000);
                                </script>
                            @endif
                            <p>My name: {{ Auth::user()->name }}</p>
                            <p>My Email: {{ Auth::user()->email }}</p>
                            <img width="100" height="100" alt="{{ Auth::user()->name }}"
                                src="{{ Auth::user()->image ? Auth::user()->image : asset('assets/undraw_profile_pic_ic-5-t.svg') }}" />
                            {{ __('You are logged in!') }}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
