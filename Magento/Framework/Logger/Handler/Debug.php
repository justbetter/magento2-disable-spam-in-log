<?php

namespace JustBetter\DisableSpamInLog\Magento\Framework\Logger\Handler;

use Magento\Framework\Filesystem\DriverInterface;
use JustBetter\DisableSpamInLog\Helper\Data;
use Monolog\Logger;

class Debug extends \Magento\Framework\Logger\Handler\Debug
{
    protected $helper;

    public function __construct(DriverInterface $filesystem, Data\Proxy $helper, $filePath = null, $fileName = null)
    {
        $this->helper = $helper;
        parent::__construct($filesystem, $filePath, $fileName);
    }

    public function write(array $record)
    {
        if ($this->helper->canLog($record['level'])) {
            parent::write($record);
        }

        return;
    }
}
