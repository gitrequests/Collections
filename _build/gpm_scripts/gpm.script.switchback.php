<?php
/**
 *
 * THIS SCRIPT IS AUTOMATICALLY GENERATED, NO CHANGES WILL APPLY
 *
 * @package collections
 * @subpackage build
 *
 * @var \xPDO\Transport\xPDOTransport $transport
 * @var array $object
 * @var array $options
 */

use MODX\Revolution\modX;
use xPDO\Transport\xPDOTransport;
use MODX\Revolution\modResource;
use Collections\Model\CollectionContainer;
use Collections\Model\SelectionContainer;
use MODX\Revolution\modDocument;

return (function () {
    
return new class() {
    /**
     * @var modX
     */
    private $modx;

    /**
     * @var int
     */
    private $action;

    /**
    * @param modX $modx
    * @param int $action
    * @return bool
    */
    public function __invoke(&$modx, $action)
    {
        $this->modx =& $modx;
        $this->action = $action;

        if ($this->action !== xPDOTransport::ACTION_UNINSTALL) {
            return true;
        }

        $c = $this->modx->newQuery(modResource::class);
        $c->where(['class_key' => CollectionContainer::class]);

        /** @var modResource $collections[] */
        $collections = $this->modx->getCollection(modResource::class, $c);
        foreach ($collections as $collection) {
            $children = $collection->Children;
            foreach ($children as $child) {
                $child->set('show_in_tree', 1);
                $child->save();
            }

            $collection->set('class_key', modDocument::class);
            $collection->save();
        }

        $c = $this->modx->newQuery(modResource::class);
        $c->where(['class_key' => SelectionContainer::class]);

        /** @var modResource[] $selections */
        $selections = $this->modx->getCollection(modResource::class, $c);
        foreach ($selections as $selection) {
            $selection->set('hide_children_in_tree', 0);
            $selection->set('class_key', modDocument::class);
            $selection->save();
        }

        return true;
    }

};
})()($transport->xpdo, $options[xPDOTransport::PACKAGE_ACTION]);