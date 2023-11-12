<?php
/**
 * Copyright © Adrian Robledo All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AR\Weather\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;

class Config extends AbstractHelper
{
    const XML_PATH_WEATHER_SETTINGS_ENABLED = 'weather/general/enabled';
    const XML_PATH_WEATHER_SETTINGS_KEY = 'weather/settings/key';
    const XML_PATH_WEATHER_SETTINGS_PARAMETER = 'weather/settings/parameter';

    /**
     * @var RemoteAddress
     */
    private RemoteAddress $remoteAddress;

    /**
     * @param Context $context
     * @param RemoteAddress $remoteAddress
     */
    public function __construct(
        Context $context,
        RemoteAddress $remoteAddress
    ) {
        parent::__construct($context);
        $this->remoteAddress = $remoteAddress;
    }


    /**
     * @param $fullPath
     * @return mixed
     */
    public function isEnabled($store = null): string
    {
        return (string)$this->scopeConfig->getValue(
            self::XML_PATH_WEATHER_SETTINGS_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    /**
     * @param null $store
     * @return string
     */
    public function getApiKey($store = null): string
    {
        return (string)$this->scopeConfig->getValue(
            self::XML_PATH_WEATHER_SETTINGS_KEY,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    /**
     * @param null $store
     * @return string
     */
    public function getApiParameter($store = null): string
    {
        return (string)$this->scopeConfig->getValue(
            self::XML_PATH_WEATHER_SETTINGS_PARAMETER,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    /**
     * @return bool|string
     */
    public function getRemoteAddress(): bool|string
    {
        return $this->remoteAddress->getRemoteAddress();
    }
}
