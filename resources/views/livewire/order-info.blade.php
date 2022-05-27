<div>

    <div wire:init="mountComponent()">
        <div class="container">
            <div class="row justify-content-center">
                <div class="card border-primary mb-5" style="width: 100%; box-shadow:0px 7px 8px -6px #8080809e;">
                    <div class="card-header">
                        Active Orders: {{ $totalorder->where('status', '=', 'New')->count() }} (
                        {{ $orderaddons }} $ )


                        <div class="col-md-3  float-right">
                            <select class="form-control form-select-lg" wire:click="changeEvent($event.target.value)"
                                wire:model="status">
                                <option selected value="Quote">Quoted</option>
                                <option value="New">New</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div>
        </div>
        <div class="container">
            <div class="row justify-content-center">

                @if (isset($orders))
                    @foreach ($orders as $order)
                        <div class="card" style="width: 100%;">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Order Id</h5>
                                        <span>{{ $order->id }}</span>
                                    </div>
                                    <div class="col-md-3">
                                        <h5>Due Date:</h5>
                                        <span>{{ $order->duedate }}</span>
                                    </div>
                                    <div class="col-md-3">
                                        <h5>Amount $</h5>
                                        <span>{{ $order->ordertransactions->sum('amount') }}</span>
                                    </div>

                                    <div class="col-md-3"><a
                                            href="{{ route('manageorder', ['id' => $order->id]) }}"
                                            class="btn btn-lg btn-outline-primary">
                                            View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>

    </div>
</div>
