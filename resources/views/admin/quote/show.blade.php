@extends('layouts.admin')
@section('content')
    <div class="container">


        <form action="{{ route('admin.sendquote') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $order->id }}" />
            <textarea class="form-control" rows="4" name="description"></textarea>
            <input class="form-control" type="number" placeholder="Enter Amount" required name="amount" />
            <button type="submit" class="btn btn-primary">Send Quote</button>

        </form>

        <h4>Quote Details</h4>


        Client Name:{{ $order->user->name }}
        <br>
        Client Email:{{ $order->user->email }}

        <br>
        Total Order By Client : {{ $totalorders }}
        <br>
        Balance in DP: {{ $order->user->balance }} $
        <br>
        Order:id{{ $order->id }}
        <br>
        Client Budget: {{ $order->budget }}
        <br>
        Description: {{ $order->description }}
        <br>
        Service: {{ $order->service->name }}
        <br>
        Source Files:
        <div class="row">
            @foreach ($order->ordersourcefiles as $file)
                @if (str_contains($file->filename, '.gif') || str_contains($file->filename, '.png') || str_contains($file->filename, '.jpg') || str_contains($file->filename, '.jpeg'))
                    <div class="col-md-2">
                        <img title="{{ $file->filename }}" class="card-img-top" width="100" height="120"
                            src="{{ Storage::url($file->filepath) }}" />

                        <div class="card-body">
                            <a class="btn btn-warning btn-block" style="margin:auto;"
                                href="{{ route('filedownload', ['quoteid' => $order->id, 'filename' => $file->filename]) }}">
                                Download
                                <i class="fa fa-download" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <img class="card-img-top" width="100" height="120" src="{{ asset('assets/download.png') }}" />
                        <div class="card-body">
                            <a class="btn btn-warning btn-block"
                                style=" margin:
                                                                                                                                                                                                                                                auto;"
                                href="{{ route('filesdownload', ['quoteid' => $order->id, 'chatid' => $chat->id, 'filename' => $file->filename]) }}">
                                Download
                                <i class="fa fa-download" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach



        </div>
        <div class="row">
            @foreach ($order->orderconversations as $chat)
                <div class="row">
                    <p>Message send By {{ $order->user->name }} On {{ $chat->created_at }} : </p>
                    <b>
                        {{ $chat->message }}
                    </b>
                    <br />
                    @foreach ($chat->ordersourcefiles as $chatfile)
                        @if (str_contains($chatfile->filename, '.gif') || str_contains($chatfile->filename, '.png') || str_contains($chatfile->filename, '.jpg') || str_contains($chatfile->filename, '.jpeg'))
                            <div class="col-md-2">
                                <img title="{{ $chatfile->filename }}" class="card-img-top" width="100" height="120"
                                    src="{{ Storage::url($chatfile->filepath) }}" />

                                <div class="card-body">
                                    <a class="btn btn-warning btn-block" style="margin:auto;"
                                        href="{{ route('filedownload', ['quoteid' => $order->id, 'filename' => $chatfile->filename]) }}">
                                        Download
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="card">
                                <img class="card-img-top" width="100" height="120"
                                    src="{{ asset('assets/download.png') }}" />
                                <div class="card-body">
                                    <a class="btn btn-warning btn-block"
                                        style=" margin:
                                                                                                                                                                                                                                                auto;"
                                        href="{{ route('filesdownload', ['quoteid' => $order->id,'chatid' => $chatfile->id,'filename' => $chatfile->filename]) }}">
                                        Download
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        @endif
                        <hr>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection
