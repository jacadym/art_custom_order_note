<?php

namespace Art\CustomOrderNote\Api;

interface CustomOrderRepositoryInterface
{
    public function getByOrderId(int $orderId);

    public function save(array $data);
}
