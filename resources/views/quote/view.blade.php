@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quote</h1>

    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h4 class="font-weight-bold text-primary float-left"> Your Quote Details</h4>
                    <button class="btn btn-primary float-right">Send Remainder</button>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-1">
                            <span class="fa-stack fa-2x">
                                <i class="fas fa-circle fa-stack-2x" style="color: #4e73df;"></i>

                                <i class="fa  fa-calendar fa-stack-1x fa-inverse"
                                    style="font-size: 2rem; color: rgb(255, 255, 255);"></i>
                            </span>

                        </div>
                        <div class="col-md-11 pt-3">
                            <p class="text-lg">
                                <b>{{ $order->created_at->format('F j, Y, g:i a') }} </b>
                            </p>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-md-1">
                            <span class="fa-stack fa-2x">
                                <i class="fas fa-circle fa-stack-2x" style="color: #4e73df;"></i>

                                <i class="fa  fa-laptop fa-stack-1x fa-inverse"
                                    style="font-size: 2rem; color: rgb(255, 255, 255);"></i>
                            </span>

                        </div>
                        <div class="col-md-11 pt-3">
                            <p class="text-lg">
                                <b> {{ $order->service->name }} </b>
                            </p>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-md-1">
                            <span class="fa-stack fa-2x">
                                <i class="fas fa-circle fa-stack-2x" style="color: #4e73df;"></i>

                                <i class="fa fa-usd fa-stack-1x fa-inverse"
                                    style="font-size: 2rem; color: rgb(255, 255, 255);"></i>
                            </span>

                        </div>
                        <div class="col-md-11 pt-3">
                            <p class="text-lg">
                                <b>{{ $order->budget }} </b>
                            </p>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-md-1">
                            <span class="fa-stack fa-2x">
                                <i class="fas fa-circle fa-stack-2x" style="color: #4e73df;"></i>

                                <i class="fa fa-file-text fa-stack-1x fa-inverse"
                                    style="font-size: 2rem; color: rgb(255, 255, 255);"></i>
                            </span>

                        </div>
                        <div class="col-md-11 pt-3">
                            <p class="text-lg">
                                {{ $order->description }}
                            </p>
                        </div>
                    </div>
                    <hr />

                    <div class="row">
                        <div class="col-md-1">
                            <span class="fa-stack fa-2x">
                                <i class="fas fa-circle fa-stack-2x" style="color: #4e73df;"></i>

                                <i class="fa fa-file fa-stack-1x fa-inverse"
                                    style="font-size: 2rem; color: rgb(255, 255, 255);"></i>
                            </span>

                        </div>
                        <div class="col-md-11 pt-3">
                            <ul class="list-group list-group-horizontal">
                                @foreach ($order->ordersourcefiles as $file)
                                    @if (str_contains($file->filename, '.gif') || str_contains($file->filename, '.png') || str_contains($file->filename, '.jpg') || str_contains($file->filename, '.jpeg'))
                                        <li class="list-group-item">
                                            <div class="card">
                                                <img title="{{ $file->filename }}" class="card-img-top" width="100"
                                                    height="120" src="{{ Storage::url($file->filepath) }}" />

                                                <div class="card-body">
                                                    <a class="btn btn-warning btn-block style=" margin: auto;"
                                                        href="{{ route('filedownload', ['quoteid' => $order->id, 'filename' => $file->filename]) }}">
                                                        Download
                                                        <i class="fa fa-download" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    @else
                                        <li class="list-group-item">
                                            <div class="card">
                                                <img class="card-img-top" width="100" height="120"
                                                    src="{{ asset('assets/download.png') }}" />

                                                <div class="card-body">
                                                    <a class="btn btn-warning btn-block style=" margin: auto;"
                                                        href="{{ route('filedownload', ['quoteid' => $order->id, 'filename' => $file->filename]) }}">
                                                        Download
                                                        <i class="fa fa-download" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <!-- Add More Details -->

    <main class="content">
        <div class="p-0">



            <div class="card">
                <div class="row g-0">
                    <div class="col-12 col-lg-12 col-xl-12">
                        <div class="py-2 px-4 border-bottom d-none d-lg-block">
                            <div class="d-flex align-items-center py-1">
                                <div class="position-relative">
                                    {{-- <img src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                        class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40"> --}}
                                </div>
                                <div class="flex-grow-1 pl-3">
                                    {{-- <strong>Sharon Lessman</strong>
                                    <div class="text-muted small"><em>Typing...</em></div> --}}
                                </div>
                                <div>
                                    <h1 class="h3 mt-3">Add More Details</h1>
                                    {{-- <button class="btn btn-danger btn-lg mr-1 px-3">
                                        <i class="fa fa-trash"></i>
                                    </button> --}}
                                </div>
                            </div>
                        </div>

                        <div id="chat" class="position-relative">
                            <div class="chat-messages p-4">

                                @foreach ($orderchat as $chat)
                                    @if ($chat->issentbyclient)
                                        <div class="chat-message-left pb-4">
                                            <div>
                                                <img src="{{ Auth::user()->image }}" class="rounded-circle mr-1"
                                                    alt="{{ Auth::user()->name }}" width="20" height="20">
                                                <div title=" {{ $chat->created_at->format('F j, Y, g:i a') }}"
                                                    class="text-muted small text-nowrap mt-2">
                                                    {{ $chat->created_at->format('g:i a') }}
                                                </div>
                                            </div>
                                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                                <div class="font-weight-bold mb-1">{{ Auth::user()->name }}</div>
                                                {{ $chat->message }}
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <ul class="list-group list-group-horizontal" style="width: 50%;
                                                                                                overflow: scroll;">

                                                @foreach ($chat->ordersourcefiles as $filee)
                                                    @if (str_contains($filee->filename, '.gif') || str_contains($filee->filename, '.png') || str_contains($filee->filename, '.jpg') || str_contains($filee->filename, '.jpeg'))
                                                        <li class="list-group-item">
                                                            <div class="card">
                                                                <img title="{{ $filee->filename }}"
                                                                    class="card-img-top" width="100" height="120"
                                                                    src="{{ Storage::url($filee->filepath) }}" />

                                                                <div class="card-body">
                                                                    <a class="btn btn-warning btn-block"
                                                                        style="margin:auto;"
                                                                        href="{{ route('filesdownload', ['quoteid' => $order->id, 'chatid' => $chat->id, 'filename' => $filee->filename]) }}">
                                                                        Download
                                                                        <i class="fa fa-download" aria-hidden="true"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @else
                                                        <li class="list-group-item">
                                                            <div class="card">
                                                                <img class="card-img-top" width="100" height="120"
                                                                    src="{{ asset('assets/download.png') }}" />
                                                                <div class="card-body">
                                                                    <a class="btn btn-warning btn-block" style=" margin:
                                                                                auto;"
                                                                        href="{{ route('filesdownload', ['quoteid' => $order->id, 'chatid' => $chat->id, 'filename' => $filee->filename]) }}">
                                                                        Download
                                                                        <i class="fa fa-download" aria-hidden="true"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endif
                                                @endforeach

                                            </ul>
                                        </div>
                                        <hr />
                                    @else
                                        <div class="chat-message-right pb-4">
                                            <div>
                                                <img src="{{ Auth::user()->image }}" class="rounded-circle mr-1"
                                                    alt="{{ Auth::user()->name }}" width="40" height="40">
                                                <div title=" {{ $chat->created_at->format('F j, Y, g:i a') }}"
                                                    class="text-muted small text-nowrap mt-2">
                                                    {{ $chat->created_at->format('g:i a') }} </div>
                                            </div>
                                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                                <div class="font-weight-bold mb-1">{{ Auth::user()->name }}</div>
                                                {{ $chat->message }}


                                            </div>
                                            <div class="container">
                                                <ul class="list-group list-group-horizontal" style="width: 50%;
                                                                                                    overflow: scroll;">

                                                    @foreach ($chat->ordersourcefiles as $filee)
                                                        <li class="list-group-item">
                                                            <div class="card">
                                                                <img title="{{ $filee->filename }}"
                                                                    class="card-img-top" width="100" height="120"
                                                                    src="{{ Storage::url($filee->filepath) }}" />

                                                                <div class="card-body">
                                                                    <a class="btn btn-warning btn-block style=" margin:
                                                                        auto;"
                                                                        href="{{ route('filesdownload', ['quoteid' => $order->id, 'chatid' => $chat->id, 'filename' => $filee->filename]) }}">
                                                                        Download
                                                                        <i class="fa fa-download" aria-hidden="true"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach







                            </div>
                        </div>

                        <div class="flex-grow-0 py-3 px-4 sticky-top border-top">
                            <form method="POST" enctype="multipart/form-data" action="{{ route('quote.store') }}">
                                @csrf
                                <div class="input-group">
                                    <input type="hidden" value="{{ $order->id }}" name="id" /> <textarea
                                        style="line-height: 120%" class="form-control pt-2" name="message" required
                                        placeholder="Type your message"></textarea>

                                    <button class="btn btn-primary">Send</button>
                                </div>
                                <div class="input-group" id="fileload">
                                    <div class="custom-file">
                                        <input type="file" name="sfiles[]" class="form-control" multiple />
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
    </main>
@endsection


@section('footerscript')
    <style>
        .chat-online {
            color: #34ce57
        }

        .chat-offline {
            color: #e4606d
        }

        .chat-messages {
            display: flex;
            flex-direction: column;
            max-height: 800px;
            overflow-y: scroll
        }

        .chat-message-left,
        .chat-message-right {
            display: flex;
            flex-shrink: 0
        }

        .chat-message-left {
            margin-right: auto
        }

        .chat-message-right {
            flex-direction: row-reverse;
            margin-left: auto
        }

        .py-3 {
            padding-top: 1rem !important;
            padding-bottom: 1rem !important;
        }

        .px-4 {
            padding-right: 1.5rem !important;
            padding-left: 1.5rem !important;
        }

        .flex-grow-0 {
            flex-grow: 0 !important;
        }

        .border-top {
            border-top: 1px solid #dee2e6 !important;
        }

    </style>


    <script>
        $(document).ready(function() {
            $('#chat').scrollTop($('#chat')[0].scrollHeight);
        });
    </script>
@endsection
