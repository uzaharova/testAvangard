@extends('layout.default')

@section('content')
    <div class="container card-content ml-2">
        <div>
            <table class="table" id="orders-table">
                <thead class="thead-light">
                <tr>
                    <th>{{ trans('layout.order-id') }}</th>
                    <th>{{ trans('layout.partner-name') }}</th>
                    <th>{{ trans('layout.total') }}</th>
                    <th>{{ trans('layout.items') }}</th>
                    <th>{{ trans('layout.status') }}</th>
                </tr>
                </thead>
                <tbody class="pagination-content">
                @forelse($orders->items() as $item)
                    <tr>
                        <td>
                            <a target="_blank"
                               href="{{ route('order.edit.id', ['id' => $item->id]) }}">
                                {{ $item->id }}
                            </a>
                        </td>
                        <td>{{ $item->partner->name }}</td>
                        <td>{{ $item->total }}</td>
                        <td>{{ $item->items }}</td>
                        <td>{{ $statuses[$item->status] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            {{ trans('layout.not-found') }}
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="row">
                <div class="col-12">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
