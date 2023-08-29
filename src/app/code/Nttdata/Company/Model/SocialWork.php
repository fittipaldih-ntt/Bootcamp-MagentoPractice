<?php
namespace Nttdata\Company\Model;

use Magento\Framework\Model\AbstractModel;

class SocialWork extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Nttdata\Company\Model\ResourceModel\SocialWork::class);
    }
}
