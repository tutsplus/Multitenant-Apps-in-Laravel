<?php
namespace CanI;

class Facade extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor() { return 'canI'; }
}
