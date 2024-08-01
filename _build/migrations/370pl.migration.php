<?php

use Collections\Model\CollectionTemplate;

return new class() {
    // migration runs if self::VERSION > currently installed version
    const VERSION = '3.7.0-pl';

    /**
    * @var \MODX\Revolution\modX
    */
    private $modx;

    /**
     * @param \MODX\Revolution\modX $modx
     * @return void
     */
    public function __invoke(&$modx)
    {
        $this->modx =& $modx;

        /** @var CollectionTemplate[] $views */
        $views = $this->modx->getIterator(CollectionTemplate::class);
        foreach ($views as $view) {
            $buttons = $view->get('buttons');
            if (strpos($buttons, 'changeparent') === false) {
                $buttons = $buttons . ',changeparent';
                $view->set('buttons', $buttons);
                $view->save();
            }
        }
    }
};
