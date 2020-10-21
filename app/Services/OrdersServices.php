<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use Illuminate\Contracts\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class OrdersServices
 * @package App\Services
 */
class OrdersServices
{
    protected const DEFAULT_LIMIT = 10;

    /**
     * @var OrderRepository
     */
    private $orderRepository;

    public function __construct(Container $container)
    {
        $this->orderRepository = $container->make(OrderRepository::class);
    }

    /**
     * @param string $url
     * @param int $page
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getOrders(string $url, int $page, int $limit = self::DEFAULT_LIMIT)
    {
        list($orders, $total) = $this->orderRepository->getOrders($page, $limit);

        return new LengthAwarePaginator(
            $orders,
            $total,
            $limit,
            $page,
            ['path' => $url,]
        );
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getOrderById(int $id)
    {
        $total = 0;
        $order = $this->orderRepository->getOrderById($id);
        foreach ($order->items as $product) {
            $total += $product->quantity * $product->price;
        }
        $order->total = $total;

        return $order;
    }

    /**
     * @param int $id
     * @param array $order
     */
    public function updateOrder(int $id, array $order)
    {
        $this->orderRepository->updateOrder($id, [
            'client_email' => $order['client_email'],
            'partner_id' => $order['partner'],
            'status' => $order['status'],
        ]);
    }
}