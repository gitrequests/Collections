<?php

use Collections\Model\CollectionContainer;
use Collections\Model\CollectionTemplate;
use MODX\Revolution\modResource;

return new class() {
    // migration runs if self::VERSION > currently installed version
    const VERSION = '3.4.0-pl';

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

        /** @var modResource[] $collections */
        $collections = $this->modx->getIterator(modResource::class, ['class_key' => CollectionContainer::class]);
        foreach ($collections as $collection) {
            $this->modx->updateCollection(modResource::class, ['show_in_tree' => 0], ['parent' => $collection->id, 'class_key:!=' => CollectionContainer::class]);
        }

        /** @var CollectionTemplate[] $views */
        $views = $this->modx->getIterator(CollectionTemplate::class);
        foreach ($views as $view) {
            $buttons = $view->get('buttons');
            if (strpos($buttons, 'open') === false) {
                $buttons = 'open,' . $buttons;
                $view->set('buttons', $buttons);
                $view->save();
            }
        }
    }
};
