<?php

namespace xRayLaravel;

use xRayLog\xRayLogger;

class xRayHandler
{
    private xRayLogger $logger;
    private mixed $payload;

    public function __construct(xRayLogger $logger)
    {
        $this->logger = $logger;
    }

    public function setPayload(mixed $payload): self
    {
        $this->payload = $payload;
        return $this->info($payload);
    }

    public function info(mixed $payload = null): self
    {
        $this->logger->info($payload ?? $this->payload);
        return $this;
    }

    public function error(mixed $payload = null): self
    {
        $this->logger->error($payload ?? $this->payload);
        return $this;
    }

    public function warning(mixed $payload = null): self
    {
        $this->logger->warning($payload ?? $this->payload);
        return $this;
    }

    public function debug(mixed $payload = null): self
    {
        $this->logger->debug($payload ?? $this->payload);
        return $this;
    }

    public function exit(): void
    {
        exit(1);
    }
}
