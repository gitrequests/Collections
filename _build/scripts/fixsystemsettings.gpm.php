<?php

use MODX\Revolution\modSystemSetting;
use MODX\Revolution\modX;
use xPDO\Transport\xPDOTransport;

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

        /** @var modSystemSetting $ss */
        $ss = $this->modx->getObject(modSystemSetting::class, ['key' => 'renderer_image_path']);
        if ($ss) {
            $ss->remove();
        }

        return true;
    }

};
