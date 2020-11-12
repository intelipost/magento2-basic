<?php

namespace Intelipost\Basic\Logger\Handler;

use Magento\Framework\Logger\Handler\Base;
use Monolog\Logger;

class Error extends Base
{
    protected $fileName = '/var/log/intelipost/error.log';
    protected $loggerType = Logger::ERROR;
}
