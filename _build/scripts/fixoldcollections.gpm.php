<?php
use MODX\Revolution\modX;
use xPDO\Transport\xPDOTransport;
use MODX\Revolution\modResource;

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

        if ($this->action === xPDOTransport::ACTION_UNINSTALL) {
            return true;
        }

        if (isset($this->modx->packages['collections'])) {
            unset($this->modx->packages['collections']);
        }

        $this->modx->removeExtensionPackage('collections');

        $this->modx->updateCollection(modResource::class, ['class_key' => 'Collections\\Model\\CollectionContainer'], ['class_key' => 'CollectionContainer']);
        $this->modx->updateCollection(modResource::class, ['class_key' => 'Collections\\Model\\SelectionContainer'], ['class_key' => 'SelectionContainer']);

        return true;
    }

};
