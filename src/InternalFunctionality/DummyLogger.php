<?php

namespace leocata\M1\InternalFunctionality;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * Special class that will act as backup in case no logger is given
 *
 * As the name implies, this class won't do anything except declare the methods so we can still call them in this API.
 */
class DummyLogger implements LoggerInterface
{
    public function emergency($message, array $context = []): bool
    {
        return $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     * @SuppressWarnings("unused")
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return bool
     */
    public function log($level, $message, array $context = []): bool
    {
        return false;
    }

    public function alert($message, array $context = []): bool
    {
        return $this->log(LogLevel::ALERT, $message, $context);
    }

    public function critical($message, array $context = []): bool
    {
        return $this->log(LogLevel::CRITICAL, $message, $context);
    }

    public function error($message, array $context = []): bool
    {
        return $this->log(LogLevel::ERROR, $message, $context);
    }

    public function warning($message, array $context = []): bool
    {
        return $this->log(LogLevel::WARNING, $message, $context);
    }

    public function notice($message, array $context = []): bool
    {
        return $this->log(LogLevel::NOTICE, $message, $context);
    }

    public function info($message, array $context = []): bool
    {
        return $this->log(LogLevel::INFO, $message, $context);
    }

    public function debug($message, array $context = []): bool
    {
        return $this->log(LogLevel::DEBUG, $message, $context);
    }
}