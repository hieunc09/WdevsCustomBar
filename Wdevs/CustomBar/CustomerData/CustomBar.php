<?php

namespace Wdevs\CustomBar\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Wdevs\CustomBar\Helper\Data as HelperData;
use Magento\Customer\Helper\Session\CurrentCustomer;
use Magento\Customer\Api\GroupRepositoryInterface;

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
     * @var GroupRepositoryInterface
     */
    private $groupRepository;

    /**
     * @param HelperData $helperData
     * @param CurrentCustomer $currentCustomer
     * @param GroupRepositoryInterface $groupRepository
     */
    public function __construct(
        HelperData               $helperData,
        CurrentCustomer          $currentCustomer,
        GroupRepositoryInterface $groupRepository
    ) {
        $this->helperData = $helperData;
        $this->currentCustomer = $currentCustomer;
        $this->groupRepository = $groupRepository;
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getSectionData()
    {
        $result['content'] = null;

        try {
            if ($this->helperData->isEnabled() && $this->currentCustomer->getCustomer()->getId()) {
                $customerGroup = $this->groupRepository->getById($this->currentCustomer->getCustomer()->getGroupId());
                $result['content'] = $customerGroup->getCode();
            }
        } catch (NoSuchEntityException $noSuchEntityException) {
        }

        return $result;
    }
}
