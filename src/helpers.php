<?php

if (!function_exists('xRay')) {
    function xRay(mixed $payload = null)
    {
        /** @var \xRayLaravel\xRayHandler $xRay */
        $xRay = app('xRay');
        return $payload === null ? $xRay : $xRay->setPayload($payload);
    }
}
