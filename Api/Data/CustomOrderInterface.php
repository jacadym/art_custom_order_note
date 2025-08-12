<?php

namespace Art\CustomOrderNote\Api\Data;

interface CustomOrderInterface
{
    public const string ORDER_ID = 'order_id';
    public const string NOTE = 'custom_order_note';
    public const string CREATED_AT = 'created_at';

    public function getOrderId(): int;

    public function setOrderId(int $orderId): void;

    public function getCustomOrderNote(): ?string;

    public function setCustomOrderNote(?string $customOrderNote): void;

    public function getCreatedAt(): string;

    public function setCreatedAt(string $createdAt): void;
}
