@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mx-auto">
            <div class="col-md-10">


                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#activity">Activity</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#deliveredfiles">Delivered Files</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#payment">Payment Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#requirements">Requirements</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">

                    <div id="activity" class="tab-pane active"><br>
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

                                                        {{-- <button class="btn btn-danger btn-lg mr-1 px-3">
                                                    <i class="fa fa-trash"></i>
                                                </button> --}}
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="chat" class="position-relative">
                                                <div class="chat-messages p-4">


                                                    <div class="chat-message-left pb-4">
                                                        <div>
                                                            <img src="{{ asset('assets/undraw_profile_pic_ic-5-t.svg') }}"
                                                                class="rounded-circle mr-1" alt="" width="20" height="20">
                                                            <div title="" class="text-muted small text-nowrap mt-2">
                                                                Customer
                                                            </div>
                                                        </div>
                                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                                            <div class="font-weight-bold mb-1">
                                                                I need a Logo Digitizing
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="pb-4">
                                                        <div class="col-md-3">
                                                            <img title="" class="card-img-top" width="100" height="120"
                                                                src="{{ asset('assets/undraw_login_re_4vu2.svg') }}" />

                                                            <div class="card-body">
                                                                <a class="btn btn-warning btn-block" style="margin:auto;"
                                                                    href="">
                                                                    Download
                                                                    <i class="fa fa-download" aria-hidden="true"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="chat-message-right pb-4">
                                                        <div>
                                                            <img src="{{ asset('assets/undraw_profile_pic_ic-5-t.svg') }}"
                                                                class="rounded-circle mr-1" alt="" width="40" height="40">
                                                            <div title="" class="text-muted small text-nowrap mt-2">
                                                                Waleed Raza
                                                            </div>
                                                        </div>
                                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                                            <div class="font-weight-bold mb-1">
                                                                Hello WHat do you want?
                                                            </div>



                                                        </div>

                                                    </div>




                                                </div>
                                            </div>
                                            <div class="container">
                                                <div id='preview'></div>
                                            </div>
                                            <div class="flex-grow-0 py-3 px-4 sticky-top border-top">
                                                <form method="POST" enctype="multipart/form-data" action="">
                                                    @csrf
                                                    <div class="input-group">
                                                        <input type="hidden" value="" name="id" />
                                                        <textarea style="line-height: 120%" class="form-control pt-2" name="message" required
                                                            placeholder="Type your message"></textarea>

                                                        <button class="btn btn-primary">Send</button>
                                                    </div>
                                                    <div class="input-group" id="fileload">
                                                        <div class="custom-file">
                                                            <input type="file" name="sfiles[]" onchange="readURL(this);"
                                                                class="form-control" multiple />
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </main>
                    </div>

                    <div id="deliveredfiles" class="container tab-pane fade"><br>
                        <h3>Tab-2</h3>
                        <table class="table table-bordered table-responsive table-hover dataTable display" id="dataTable"
                            width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">

                            <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                        colspan="1" aria-label="Start date: activate to sort column ascending"
                                        style="width: 100px;">Date
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                        colspan="1" aria-label="Age: activate to sort column ascending"
                                        style="width: 50px;">Name</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1">Date</th>
                                    <th rowspan="1" colspan="1">Name</th>
                                </tr>
                            </tfoot>

                            <tbody>
                                <tr>
                                    <td>19-12-2000</td>
                                    <td>Chris</td>
                                </tr>
                                <tr>
                                    <td>03-06-2014</td>
                                    <td>John</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="payment" class="container tab-pane fade"><br>
                        <h3>Invoice No: DP{{ $order->id }}</h3>

                        @foreach ($order->ordertransactions as $ordertransaction)
                        @endforeach
                        <table class="table table-sm table-dark">
                            <thead>
                                <tr>

                                    <th scope="col">Service</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Amount $</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderaddons as $addon)
                                    <tr>
                                        <td> {{ $order->service->name }}</td>
                                        <td>{{ $addon->description }}</td>
                                        <td> {{ $addon->amount }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2">
                                        <p class="float-right">Total</p>
                                    </td>
                                    <td> {{ $order->orderaddons->sum('amount') }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-sm table-dark">
                            <thead>
                                <tr>

                                    <th scope="col">Paid By</th>
                                    <th scope="col">Paid On</th>
                                    <th scope="col">Amount $</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->ordertransactions as $transaction)
                                    <tr>
                                        <td> {{ $transaction->paidby }}</td>
                                        <td>{{ $transaction->created_at }}</td>
                                        <td> {{ $transaction->amount }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2">
                                        <p class="float-right">Total</p>
                                    </td>
                                    <td> {{ $order->ordertransactions->sum('amount') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <!-- Requirements Tab -->
                    <div id="requirements" class="container tab-pane fade"><br>
                        <div class="card shadow h-100 p-5">

                            <h3>Description:</h3>
                            <p>{{ $order->description }}</p>
                            <h3>Date:</h3>
                            <p>{{ $order->created_at }}</p>
                            <h3>Service:</h3>
                            <p>{{ $order->service->name }}</p>

                            @if (isset($order->budget))
                                <h3>Budget:</h3>
                                <p>{{ $order->budget }}$</p>
                            @endif

                            <h3>Files:</h3>
                            <div class="row">

                                @foreach ($order->ordersourcefiles as $file)
                                    @if (isPhoto($file->filepath))
                                        <div class="col-md-1">
                                            <img class="img-fluid rounded" loading="lazy"
                                                src="{{ Storage::url($file->filepath) }}"
                                                style="width: 50px; height:50px;">
                                            <a class="btn btn-outline-primary btn-block"
                                                href="{{ route('filedownload', ['quoteid' => $order->id, 'filename' => $file->filename]) }}"><i
                                                    class="fa fa-download"></i></a>
                                        </div>
                                    @else
                                        <div class="col-md-1">
                                            <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                viewBox="0 0 64 64" style=" fill:#000000;">
                                                <path
                                                    d="M50.971,18.586L42.109,8.043C41.021,6.748,39.416,6,37.724,6H11v52h42V24.154C53,22.117,52.281,20.145,50.971,18.586z M15,54V10c0,0,15.696,0,21.696,0C39.986,10,41,11.366,41,12.581C41,14.366,39,17,39,17c9.761,4.62,9.816,4.618,9.816,8.185	C48.816,30.185,49,54,49,54H15z">
                                                </path>
                                            </svg>
                                            <a class="btn btn-outline-primary btn-block"
                                                href="{{ route('filedownload', ['quoteid' => $order->id, 'filename' => $file->filename]) }}"><i
                                                    class="fa fa-download"></i></a>
                                        </div>
                                    @endif
                                @endforeach







                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-2">
                <h2>Hello</h2>
            </div>
        </div>
    </div>
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




        <style>
.container {
  position: relative;
  width: 100%;
  max-width: 400px;
}

.image {
  display: block;
  width: 100%;
  height: auto;
}

.overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  width: 100%;
  opacity: 0;
  transition: .3s ease;
  background-color: red;
}

#preview:hover .overlay {
  opacity: 1;
}

.icon {
  color: white;
  font-size: 100px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.fa-user:hover {
  color: #eee;
}
</style>
    </style>
    <script>
        var files = [];

        function readURL(input) {
            // alert(input.files);
            if (input.files) {
                files = input.files;
                //preview

                for (var i = 0; i < files.length; i++) {

                    var reader = new FileReader();
                    reader.onload = function(e) {
                        const node = document.createElement("img");
                        if(e.target.result.includes('jpg') || e.target.result.includes('png') || e.target.result
                            .includes('svg')) {
                            node.setAttribute('src', e.target.result);
                        } else {
                            node.setAttribute('src', e.target.result);
                        }
                        // node.setAttribute('src', e.target.result);
                        node.setAttribute('width', 100);
                        node.setAttribute('height', 100);
                        document.getElementById("preview").appendChild(node);
                        const ndiv=document.createElement('div');
                        ndiv.setAttribute('class', 'overlay');
                        


                    };
                    reader.readAsDataURL(input.files[i]);
                }

            }
        }


        function addImagePreview(value, index, array) {

            alert('File Added');
        }
    </script>
@endsection
