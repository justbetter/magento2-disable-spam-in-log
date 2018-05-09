<?php

namespace JustBetter\DisableSpamInLog\Magento\Framework\Logger\Handler;

use JustBetter\DisableSpamInLog\Helper\Data;
use Magento\Framework\Filesystem\DriverInterface;
use Magento\Framework\Logger\Handler\Exception;

class System extends \Magento\Framework\Logger\Handler\System
{
    /**
     * @var Data
     */
    protected $helper;

    /**
     * System constructor.
     *
     * @param DriverInterface $filesystem
     * @param Exception       $exceptionHandler
     * @param Data            $helper
     * @param null            $filePath
     */
    public function __construct(DriverInterface $filesystem, Exception $exceptionHandler, Data\Proxy $helper, $filePath = null)
    {
        $this->helper = $helper;
        parent::__construct($filesystem, $exceptionHandler, $filePath);
    }

    /**
     * Writes formatted record through the handler.
     *
     * @param $record array The record metadata
     * @return void
     */
    public function write(array $record)
    {
        // catch all exceptions anyway
        if (isset($record['context']['exception'])) {
            $this->exceptionHandler->handle($record);

            return;
        }

        if ($this->helper->canLog($record['level'])) {
            $record['formatted'] = $this->getFormatter()->format($record);

            parent::write($record);
        }

        return;
    }
}
