<?php
/**
 * Copyright © Adrian Robledo All rights reserved.
 * See COPYING.txt for license details.
 */

namespace AR\Weather\Api;

interface WeatherAPIInterface
{
    const ENDPOINT_TIME = 'http://api.weatherapi.com/v1/current.json?key=%s&q=%s';

    /**
     * @return string
     */
    public function getTime(): string;
}
