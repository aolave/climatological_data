<?php
/**
 * Copyright © Adrian Robledo All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AR\Weather\Model;

use AR\Weather\Api\WeatherAPIInterface;
use AR\Weather\Helper\Config;
use Magento\Framework\HTTP\Client\Curl;

class WeatherAPI implements WeatherAPIInterface
{

    /**
     * @var Curl
     */
    private Curl $curl;

    /**
     * @var Config
     */
    private Config $config;

    /**
     * YourService constructor.
     *
     * @param Curl $curl
     * @param Config $config
     */
    public function __construct(
        Curl $curl,
        Config $config
    ) {
        $this->curl = $curl;
        $this->config = $config;
    }

    /**
     * @return string
     */
    public function getTime(): string
    {
        $apiKey = $this->config->getApiKey();
        $ipRemote = $this->config->getRemoteAddress();
        $parameter = $this->config->getApiParameter();
        $ip = $parameter ?? $ipRemote;

        $url = sprintf(self::ENDPOINT_TIME, $apiKey,$ip);
        $this->curl->get($url);

        return $this->curl->getBody();
    }

}
