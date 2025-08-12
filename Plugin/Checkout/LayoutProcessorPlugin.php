<?php

namespace Art\CustomOrderNote\Plugin\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessor;

class LayoutProcessorPlugin
{
    public function afterProcess(
        LayoutProcessor $subject,
        array $jsLayout
    ): array {
        $jsLayout['components']['checkout']['children']
        ['steps']['children']
        ['shipping-step']['children']
        ['shippingAddress']['children']
        ['shipping-address-fieldset']['children']
        ['custom_order_note'] = [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => 'shippingAddress.custom_attributes',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/input',
                'options' => [],
                'id' => 'custom_order_note',
                'tooltip' => ['description' => 'Note for order information.'],
            ],
            'dataScope' => 'shippingAddress.custom_attributes.custom_order_note',
            'label' => 'Custom Order Note',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => [],
            'sortOrder' => 250,
            'id' => 'custom_order_note',
        ];

        return $jsLayout;
    }
}
