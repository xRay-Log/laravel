<?php

namespace xRayLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \xRayLaravel\xRayHandler setPayload(mixed $payload)
 * @method static \xRayLaravel\xRayHandler info(mixed $payload = null)
 * @method static \xRayLaravel\xRayHandler error(mixed $payload = null)
 * @method static \xRayLaravel\xRayHandler warning(mixed $payload = null)
 * @method static \xRayLaravel\xRayHandler debug(mixed $payload = null)
 * @method static void exit()
 */
class xRay extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'xRay';
    }
}
