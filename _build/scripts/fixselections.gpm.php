<?php
use MODX\Revolution\modX;
use xPDO\Transport\xPDOTransport;
use MODX\Revolution\modResource;
use Collections\Model\SelectionContainer;

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
