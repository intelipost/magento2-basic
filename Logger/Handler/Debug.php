<?php

namespace Intelipost\Basic\Logger\Handler;

use Magento\Framework\Logger\Handler\Base;
use Monolog\Logger;

class Debug extends Base
{
    protected $fileName = '/var/log/intelipost/debug.log';
    protected $loggerType = Logger::DEBUG;
}
