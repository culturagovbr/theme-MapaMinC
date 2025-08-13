<?php

namespace MapaMinC;

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
        $app = App::i();

        $this->enqueueStyle('app-v2', 'main', 'css/theme-MapaMinC.css');

        // Implementação de ícones personalizados
        $app->hook('component(mc-icon).iconset', function(&$iconset) {
            $iconset['cultura-viva-1'] = 'bi:person-arms-up';
            $iconset['cultura-viva-3'] = 'ph:person-arms-spread-fill';
        });

    }
}
