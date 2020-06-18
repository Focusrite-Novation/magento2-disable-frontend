<?php

namespace FocusriteNovation\DisableFrontend\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper {

    /**
     * Get value from config
     *
     * @author Abel Bolanos Martinez <abelbmartinez@gmail.com>
     * @return mixed
     */
    public function getConfigValue()
    {
        return [
            'show_frontend_as' => $this->scopeConfig->getValue('admin/disable_frontend/show_frontend_as', ScopeInterface::SCOPE_WEBSITE),
            'redirect_to' => $this->scopeConfig->getValue('admin/disable_frontend/redirect_to', ScopeInterface::SCOPE_WEBSITE),
        ];
    }

}
