<?php

namespace Art\CustomOrderNote\Block\Adminhtml\Order\View;

use Magento\Sales\Block\Adminhtml\Order\AbstractOrder;

class DisplayCustomOrderNote extends AbstractOrder
{
    public function getCustomOrderNote(): ?string
    {
        return $this->getOrder()->getExtensionAttributes()->getCustomOrderNote();
    }
}
