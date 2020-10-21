@extends('layout.default')

@section('content')
    <div class="container card-content ml-2">
        <div>
            <form action="{{ route('order-save') }}"
                  method="post"
                  class="form-horizontal"
                  id="form-edit">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $order->id }}">
                <div>
                    <label>{{ trans('layout.client-email') }}: </label>
                    <div>
                        <input required name="client_email" type="email" value="{{ $order->client_email }}">
                    </div>
                </div>
                <div>
                    <label>{{ trans('layout.partner') }}: </label>
                    <div>
                        <input required name="partner" value="{{ $order->partner_id }}">
                    </div>
                </div>
                <div>
                    <label>{{ trans('layout.products') }}: </label>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>
                                {{ trans('layout.product-name') }}
                            </th>
                            <th>
                                {{ trans('layout.product-count') }}
                            </th>
                        </tr>
                        </thead>
                        @foreach($order->items as $product)
                            <tr>
                                <td>{{ $product->product->name }}</td>
                                <td>{{ $product->quantity }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div>
                    <label>{{ trans('layout.status') }}</label>
                    <select class="form-control" name="status">
                        @foreach($statuses as $key => $status)
                        <option value="{{ $key }}" @if($order->status == $key)selected="selected"@endif>
                            {{ $status }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>{{ trans('layout.total') }}: {{ $order->total }}</label>
                </div>
                <div>
                    <div class="input-group-append">
                        <button id="order-save" type="submit" class="btn btn-primary">
                            {{ trans('layout.save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
