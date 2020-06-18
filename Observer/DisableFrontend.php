<?php

namespace FocusriteNovation\DisableFrontend\Observer;

use FocusriteNovation\DisableFrontend\Helper\Data as DisableFrontendHelper;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\ActionFlag;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Backend\Helper\Data;

class DisableFrontend implements ObserverInterface {

    /**
     * @var Magento\Framework\App\ActionFlag;
     */
    protected $_actionFlag;

    /**
     * @var Magento\Framework\App\Response\RedirectInterface
     */
    protected $redirect;

    /**
     * @var Magento\Backend\Helper\Data
     */
    private $helperBackend;

    /**
     * @var FocusriteNovation\DisableFrontend\Helper\Data
     */
    private $disableFrontendHelper;

    /**
     * DisableFrontend constructor.
     *
     * @author Abel Bolanos Martinez <abelbmartinez@gmail.com>
     * @param ActionFlag $actionFlag
     * @param RedirectInterface $redirect
     * @param Data $helperBackend
     * @param DisableFrontendHelper $disableFrontendHelper
     */
    public function __construct(
        ActionFlag $actionFlag,
        RedirectInterface $redirect,
        Data $helperBackend,
        DisableFrontendHelper $disableFrontendHelper
    ) {
        $this->_actionFlag = $actionFlag;
        $this->redirect = $redirect;
        $this->helperBackend = $helperBackend;
        $this->disableFrontendHelper = $disableFrontendHelper;
    }

    /**
     * Show an empty page (default) or redirect to a given page.
     *
     * Config is set in Stores > Configuration > Advanced > Admin > Disable
     * Frontend.
     *
     * @author Abel Bolanos Martinez <abelbmartinez@gmail.com>
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        // Shows a blank page if all else fails.
        $this->_actionFlag->set('', Action::FLAG_NO_DISPATCH, true);

        $configValue = $this->disableFrontendHelper->getConfigValue();

        if ($configValue['show_frontend_as'] === 'admin_login') {
            // Redirect to admin.
            $controller = $observer->getControllerAction();
            $this->redirect->redirect($controller->getResponse(), $this->helperBackend->getHomePageUrl());
        }
        elseif ($configValue['show_frontend_as'] === 'redirect_to') {
            if (empty($configValue['redirect_to'])) {
                // If there is no redirect destination, then throw an exception.
                throw new \LogicException('No redirect destination was found.');
            }

            // The URL is valid. If it isn't, then the config form can't save.
            $this->redirect->redirect($controller->getResponse(), $configValue['redirect_to']);
        }
    }
}
