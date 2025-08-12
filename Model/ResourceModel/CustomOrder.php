<?php

namespace Art\CustomOrderNote\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CustomOrder extends AbstractDb
{
    private const string TABLE_NAME = 'art_custom_order';
    private const string FIELD_NAME = 'id';

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, self::FIELD_NAME);
    }
}
