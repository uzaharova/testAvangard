<?php

namespace App\Http\Controllers;

use App\Constants\OrderStatuses;
use App\Http\Requests\OrderEditRequest;
use App\Http\Requests\OrdersRequest;
use App\Services\OrdersServices;
use Illuminate\Contracts\Container\Container;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    protected const DEFAULT_PAGE = 1;

    /** @var OrdersServices */
    private $ordersServices;

    /**
     * OrdersController constructor.
     * @param Request $request
     * @param Container $container
     */
    public function __construct(Request $request, Container $container)
    {
        parent::__construct($request, $container);
        $this->ordersServices = $container->make(OrdersServices::class);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getOrders(OrdersRequest $request)
    {
        $page = $request->get('page') ?? self::DEFAULT_PAGE;
        $orders = $this->ordersServices->getOrders($request->url(), $page);

        return view('orders', ['orders' => $orders, 'statuses' => OrderStatuses::ALL_STATUSES]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orderEdit(int $id)
    {
        $order = $this->ordersServices->getOrderById($id);
        return view('order', ['order' => $order, 'statuses' => OrderStatuses::ALL_STATUSES]);
    }

    public function orderSave(OrderEditRequest $request)
    {
        $this->ordersServices->updateOrder($request->get('id'), $request->all());
        return redirect()->route('orders');
    }
}