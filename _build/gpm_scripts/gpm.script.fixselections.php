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
use Collections\Model\SelectionContainer;

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

        if ($this->action !== xPDOTransport::ACTION_UPGRADE) {
            return true;
        }

        $this->modx->updateCollection(modResource::class, ['hide_children_in_tree' => 1], ['class_key' => SelectionContainer::class]);

        return true;
    }

};
})()($transport->xpdo, $options[xPDOTransport::PACKAGE_ACTION]);