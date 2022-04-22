<?php

namespace Wdevs\CustomBar\Plugin\Model\ResourceModel;

use Magento\Framework\App\RequestInterface;

class Group
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @param RequestInterface $request
     */
    public function __construct(
        RequestInterface $request
    ) {
        $this->request = $request;
    }

    /**
     * @param \Magento\Customer\Model\ResourceModel\Group $subject
     * @param $groupModel
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforeSave(
        \Magento\Customer\Model\ResourceModel\Group $subject,
        $groupModel
    ) {
        $groupModel->setCustomBarContent($this->request->getParam('custom_bar_content'));

        return [$groupModel];
    }
}
