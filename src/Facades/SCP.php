<?php

namespace Knownhost\SCP\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Knownhost\SCP\SCP
 */
class SCP extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Knownhost\SCP\SCP::class;
    }
}
