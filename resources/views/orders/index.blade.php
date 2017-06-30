@extends('layouts.app')

@section('content')

<div class="container">
    <div class="panel panel-default line-height22">
        <div class="panel-heading">
            <h2>Dashboard</h2>
        </div>
        <div class="panel-body">
            <h3>Statics</h3>
            <div class="row top-space">
                <div class="col-xs-4 col-md-3 col-lg-2 sale-data">
                    <span>{{ $totalMonth }}USD</span>
                    Month Income
                </div>
                <div class="col-xs-4 col-md-3 col-lg-2 sale-data">
                    <span>{{ $totalMonthCount }}</span>
                    Number of Sales
                </div>
            </div>
            <h3>Sales</h3>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <td>ID Sale</td>
                        <td>Buyer</td>
                        <td>Address</td>
                        <td>Guide Number</td>
                        <td>Status</td>
                        <td>Sale Date</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->recipient_name }}</td>
                            <td>{{ $order->address() }}</td>
                            <td>
                                <a href="#" 
                                data-type="text"
                                data-pk="{{ $order->id }}"
                                data-url="{{ url('/orders/'.$order->id) }}"
                                data-title="Guide Number"
                                data-value="{{ $order->guide_number }}"
                                class="set-guide-number"
                                data-name="guide_number"></a>
                            </td>
                            <td>
                                <a href="#" 
                                data-type="select"
                                data-pk="{{ $order->id }}"
                                data-url="{{ url('/orders/'.$order->id) }}"
                                data-title="Status"
                                data-value="{{ $order->status }}"
                                class="select-status"
                                data-name="status"></a>
                            </td>
                            <td>{{ $order->created_at }}</td>
                            <td>Actions</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection