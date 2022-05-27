@extends('layouts.app')

@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @livewire('order-info')
@endsection

@section('footerscript')
@endsection
