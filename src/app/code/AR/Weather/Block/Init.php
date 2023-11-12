<?php

declare(strict_types=1);

namespace AR\Weather\Block;

use AR\Weather\Helper\Config;
use AR\Weather\Model\WeatherAPI;

class Init extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Config
     */
    private $config;
    /**
     * @var api
     */
    private $api;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param Config $config
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        Config $config,
        WeatherAPI $api,
        array $data = []
    ) {
        $this->config = $config;
        $this->api = $api;
        parent::__construct($context, $data);
    }

    /**
     * @return mixed
     */
    public function isEnabled()
    {
        return $this->config->isEnabled();
    }

    /**
     * @return mixed
     */
    public function getApiTime()
    {
        $getTime = json_decode($this->api->getTime(), false);
        $mane = $getTime->location->name;
        $region = $getTime->location->region;
        $tempC = $getTime->current->temp_c;
        $tempF = $getTime->current->temp_f;

        return $mane . " | " .  $region  . " | " .  ($tempC  . "°C / "  .  $tempF  . "°F") . " | " ;
    }

}
