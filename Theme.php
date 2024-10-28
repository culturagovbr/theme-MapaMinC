<?php

namespace MapasCulturais\Themes\MapaMinC;

use MapasCulturais\i;
use MapasCulturais\App;

/**
 * @method void import(string $components) Importa lista de componentes Vue. * 
 */
class Theme extends \MapasCulturais\Themes\BaseV2\Theme
// class Theme extends \MapasCulturais\Theme
{
    static function getThemeFolder()
    {
        return __DIR__;
    }

    function _init()
    {
        parent::_init();

        $this->enqueueStyle('app-v2', 'main', 'css/theme-MapaMinC.css');
    }
}
