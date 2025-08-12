<?php

namespace Art\CustomOrderNote\Model;

use Art\CustomOrderNote\Api\Data\CustomOrderInterface;
use Art\CustomOrderNote\Model\ResourceModel\CustomOrder as CustomOrderResourceModel;
use Magento\Framework\Model\AbstractModel;

class CustomOrder extends AbstractModel implements CustomOrderInterface
{
    protected function _construct(): void
    {
        $this->_init(CustomOrderResourceModel::class);
    }

    public function getOrderId(): int
    {
        return (int) $this->getData(self::ORDER_ID);
    }

    public function setOrderId(int $orderId): void
    {
        $this->setData(self::ORDER_ID, $orderId);
    }

    public function getCustomOrderNote(): ?string
    {
        return $this->getData(self::NOTE);
    }

    public function setCustomOrderNote(?string $customOrderNote): void
    {
        $this->setData(self::NOTE, $customOrderNote);
    }

    public function getCreatedAt(): string
    {
        return $this->getData(self::CREATED_AT);
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->setData(self::CREATED_AT, $createdAt);
    }
}
