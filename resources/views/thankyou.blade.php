@extends('layouts.app')

@section('content')
    <div class="text-center">
        <div class="error mx-auto"><img src="{{ asset('assets/loading.gif') }}" /></div>
        <p class="lead text-gray-800 mb-5">Please wait While your payment is Processing..</p>
        <p class="text-gray-500 mb-0">You will be Automatically redirected to HomePage</p>

    </div>
@endsection


@section('footerscript')
    <script>
        const url_string = window.location.href;
        url = new URL(url_string)

        setTimeout(
            function() {

                $.ajax({
                    type: 'POST',
                    url: "{{ route('topup.store') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'refid': url.searchParams.get("refno"),
                        'amount': url.searchParams.get("total"),
                        'signature': url.searchParams.get("signature"),
                    },
                    success: function(data) {


                        window.location.replace("{{ route('home') }}")

                    }
                });

            }, 1000);
    </script>
@endsection
