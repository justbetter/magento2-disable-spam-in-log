<?php

namespace JustBetter\DisableSpamInLog\Magento\Framework\Cache;

class InvalidateLogger extends \Magento\Framework\Cache\InvalidateLogger
{
    /**
     * Logger invalidate cache
     * @param mixed $invalidateInfo
     * @return void
     */
    public function execute($invalidateInfo)
    {
        // Stop spamming in my log
    }
}
