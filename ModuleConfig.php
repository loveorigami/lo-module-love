<?php

namespace lo\modules\love;

use Zelenin\Zend\Expressive\Config\Provider\ModuleConfigProvider;
use Zelenin\Zend\Expressive\Config\Provider\PhpProvider;

final class ModuleConfig extends ModuleConfigProvider
{
    /**
     * @return array
     */
    public function getConfig()
    {
        return (new PhpProvider(__DIR__ . '/config/*.php'))->getConfig();
    }
}