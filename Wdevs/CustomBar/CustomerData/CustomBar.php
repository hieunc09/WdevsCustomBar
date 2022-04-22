<?php

namespace Wdevs\CustomBar\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;
use Wdevs\CustomBar\Helper\Data as HelperData;
use Magento\Customer\Helper\Session\CurrentCustomer;
use Magento\Customer\Model\GroupFactory;

class CustomBar implements SectionSourceInterface
{
    /**
     * @var HelperData
     */
    private $helperData;

    /**
     * @var CurrentCustomer
     */
    private $currentCustomer;

    /**
     * @var GroupFactory
     */
    private $groupFactory;

    /**
     * @param HelperData $helperData
     * @param CurrentCustomer $currentCustomer
     * @param GroupFactory $groupFactory
     */
    public function __construct(
        HelperData      $helperData,
        CurrentCustomer $currentCustomer,
        GroupFactory    $groupFactory
    ) {
        $this->helperData = $helperData;
        $this->currentCustomer = $currentCustomer;
        $this->groupFactory = $groupFactory;
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getSectionData()
    {
        $result['content'] = null;
        if ($this->helperData->isEnabled() && $this->currentCustomer->getCustomerId()) {
            $customerGroup = $this->groupFactory->create()->load($this->currentCustomer->getCustomer()->getGroupId());
            $result['content'] = $customerGroup->getCustomBarContent();
        }

        return $result;
    }
}
