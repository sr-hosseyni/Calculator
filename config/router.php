<?php

use Calculator\Controllers\IndexController as IndexCtrl;

/**
 * @todo It may better to create a class for Router and return a collection of them here
 */
return [
    'GET /' => [IndexCtrl::class, 'index'],
    'POST /calculate' => [IndexCtrl::class, 'calculate']
];
