<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

 namespace Nttdata\Company\Controller\Adminhtml\Management;

 use Magento\Backend\App\Action;
 use Magento\Backend\App\Action\Context;

 /**
  * Class AverageAge
  */
 class AverageAge extends Action 
 {
     /**
     * @var EmployeesDataProvider
     */
    protected $employeesDataProvider;
 
     /**
      * AverageAge constructor.
      *
      * @param Context $context
      * @param Registry $registry
      */
     public function __construct(
         Context $context,
     ) {
         parent::__construct($context);
     }
 
     /**
      * @return void
      */
    public function execute()
    {
        $averageAge = (int)$this->_getSession()->getData('averageAge');
        if ($averageAge > 0) {
            $this->messageManager->addSuccessMessage(__('Total employees average age: ' . $averageAge));
            $this->_getSession()->unsetData('averageAge');
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index');
    }
 }
 