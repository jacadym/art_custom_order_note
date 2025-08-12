<?php

namespace Art\CustomOrderNote\Plugin;

use Art\CustomOrderNote\Api\CustomOrderRepositoryInterface;
use Magento\Sales\Api\Data\OrderExtensionFactory;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\Data\OrderSearchResultInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Psr\Log\LoggerInterface;

class OrderRepositoryPlugin
{
    public function __construct(
        private OrderExtensionFactory $extensionFactory,
        private CustomOrderRepositoryInterface $customOrderRepository,
        private LoggerInterface $logger
    ) {
    }

    public function afterGetList(
        OrderRepositoryInterface $subject,
        OrderSearchResultInterface $result
    ): void {
        $orders = $result->getItems();
        foreach ($orders as &$order) {
            $order = $this->afterGet($subject, $order);
        }
    }

    public function afterGet(
        OrderRepositoryInterface $subject,
        OrderInterface $result
    ) {
        $customOrderModel = $this->customOrderRepository->getByOrderId((int) $result->getEntityId());

        $extensionAttributes = $result->getExtensionAttributes() ?: $this->extensionFactory->create();
        $extensionAttributes->setCustomOrderNote($customOrderModel->getCustomOrderNote());
        $result->setExtensionAttributes($extensionAttributes);

        return $result;
    }

    public function afterSave(
        OrderRepositoryInterface $subject,
        OrderInterface $result,
        OrderInterface $entity
    ) {
        try {
            // TODO: getting data from billingAddress.customAttributes
            $extensionAttributes = $entity->getExtensionAttributes() ?: $this->extensionFactory->create();
            $customOrderNote = $extensionAttributes->getCustomOrderNote();

            $this->customOrderRepository->save([
                'order_id' => $result->getEntityId(),
                'custom_order_note' => $customOrderNote,
            ]);

            $resultAttributes = $result->getExtensionAttributes() ?: $this->extensionFactory->create();
            $resultAttributes->setCustomOrderNote($customOrderNote);
            $result->setExtensionAttributes($resultAttributes);
        } catch (\Exception $e) {
            $this->logger->error(__METHOD__, ['error' => $e->getMessage()]);
        }

        return $result;
    }
}
