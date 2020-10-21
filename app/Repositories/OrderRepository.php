<?php

namespace App\Repositories;

use App\Order;
use Illuminate\Database\Query\Expression;

class OrderRepository
{
    /**
     * @param int $page
     * @param int $limit
     *
     * @return array
     */
    public function getOrders(int $page, int $limit): array
    {
        $query = Order::select([
                'orders.id',
                'orders.partner_id',
                'orders.status',
                new Expression('ARRAY_TO_STRING(ARRAY_AGG(products.name), \', \') as items'),
                new Expression('SUM(order_products.quantity * order_products.price) as total')
            ]);
        $total = $query->count();

        $query->join('order_products', 'orders.id', '=', 'order_products.order_id')
            ->join('products', 'products.id', '=', 'order_products.product_id')
            ->groupBy('orders.id', 'orders.partner_id', 'orders.status');

        $query->orderBy('id')
            ->offset(($page - 1) * $limit)
            ->limit($limit);

        return [$query->get()->all(), $total];
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getOrderById(int $id)
    {
        return Order::where('id', $id)->first();
    }

    /**
     * @param int $id
     * @param array $order
     */
    public function updateOrder(int $id, array $order)
    {
        Order::where('id', $id)->update($order);
    }
}