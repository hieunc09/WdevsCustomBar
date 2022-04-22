<?php

namespace Wdevs\CustomBar\Plugin\Block\Adminhtml\Group\Edit;

use Magento\Customer\Controller\RegistryConstants;
use Magento\Framework\Registry;
use Magento\Customer\Model\GroupFactory;

class Form
{
    /**
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * @var GroupFactory
     */
    protected $groupFactory;

    /**
     * @param Registry $_coreRegistry
     * @param GroupFactory $groupFactory
     */
    public function __construct(
        Registry $_coreRegistry,
        GroupFactory $groupFactory
    ) {
        $this->_coreRegistry = $_coreRegistry;
        $this->groupFactory = $groupFactory;
    }

    /**
     * @param \Magento\Customer\Block\Adminhtml\Group\Edit\Form $subject
     * @param \Magento\Framework\Data\Form $form
     * @return \Magento\Framework\Data\Form[]
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforeSetForm(
        \Magento\Customer\Block\Adminhtml\Group\Edit\Form $subject,
        \Magento\Framework\Data\Form                      $form
    ) {
        $groupId = $this->_coreRegistry->registry(RegistryConstants::CURRENT_GROUP_ID);
        if ($groupId) {
            $fieldset = $form->getElement('base_fieldset');
            $group = $this->groupFactory->create()->load($groupId);
            $fieldset->addField(
                'custom_bar_content',
                'text',
                [
                    'name' => 'custom_bar_content',
                    'label' => __('Custom Bar Content'),
                    'title' => __('Custom Bar Content'),
                    'required' => false,
                    'value' => $group->getCustomBarContent()
                ]
            );
        }

        return [$form];
    }
}
