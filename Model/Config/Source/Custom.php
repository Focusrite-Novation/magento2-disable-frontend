<?php

namespace FocusriteNovation\DisableFrontend\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Custom implements ArrayInterface {

    /**
     * Options for the admin config
     *
     * @author Abel Bolanos Martinez <abelbmartinez@gmail.com>
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'blank_page', 'label' => __('Blank page')],
            ['value' => 'admin_login', 'label' => __('Admin login')],
            ['value' => 'specific_url', 'label' => __('Specific URL')],
        ];
    }

}
