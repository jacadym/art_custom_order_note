<?php

namespace Art\CustomOrderNote\Model;

use Art\CustomOrderNote\Api\CustomOrderRepositoryInterface;
use Art\CustomOrderNote\Api\Data\CustomOrderInterface;
use Art\CustomOrderNote\Model\CustomOrderFactory;
use Art\CustomOrderNote\Model\ResourceModel\CustomOrder as CustomOrderResource;

class CustomOrderRepository implements CustomOrderRepositoryInterface
{
    /**
     * @var array|CustomOrder[]
     */
    private array $registry = [];

    public function __construct(
        private CustomOrderFactory $customOrderFactory,
        private CustomOrderResource $customOrderResource,
    ) {
    }

    public function getByOrderId(int $orderId): CustomOrder
    {
        if (!isset($this->registry[$orderId])) {
            $model = $this->customOrderFactory->create();
            $this->customOrderResource->load($model, $orderId, CustomOrderInterface::ORDER_ID);
            $this->registry[$orderId] = $model;
        }

        return $this->registry[$orderId];
    }

    public function save(array $data): void
    {
        $model = $this->customOrderFactory->create();
        $model->setOrderId($data['order_id']);
        $model->setCustomOrderNote($data['custom_order_note'] ?? '');
        $this->customOrderResource->save($model);
        $this->registry[$model->getOrderId()] = $model;
        dd($model);
    }
}
