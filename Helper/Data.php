<?php

namespace JustBetter\DisableSpamInLog\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\State;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Data
 *
 * @package JustBetter\Sentry\Helper
 */
class Data extends AbstractHelper
{

    const XML_PATH_SRS = 'disablespaminlog/general/';

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var array
     */
    protected $configKeys = [
        'enabled',
        'log_level'
    ];

    /**
     * @var array
     */
    protected $config = [];

    /**
     * Data constructor.
     *
     * @param Context               $context
     * @param StoreManagerInterface $storeManager
     * @param State                 $appState
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        State $appState
    )
    {
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }

    /**
     * @param      $field
     * @param null $storeId
     * @return mixed
     */
    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field, ScopeInterface::SCOPE_STORE, $storeId
        );
    }

    /**
     * @param      $code
     * @param null $storeId
     * @return mixed
     */
    public function getGeneralConfig($code, $storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_SRS . $code, $storeId);
    }

    public function canLog($logLevel = 200)
    {
        return ( ! $this->getGeneralConfig('enabled') || ($this->getGeneralConfig('enabled') && $logLevel >= $this->getGeneralConfig('log_level')) );
    }

}
