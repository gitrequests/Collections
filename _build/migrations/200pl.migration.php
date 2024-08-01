<?php

use MODX\Revolution\modSystemSetting;

return new class() {
    // migration runs if self::VERSION > currently installed version
    const VERSION = '2.0.0-pl';

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

        $date = $this->modx->getObject(modSystemSetting::class, ['key' => 'collections.mgr_date_format']);
        if (!$date) {
            $date = $this->modx->newObject(modSystemSetting::class);
            $date->set('key', 'collections.mgr_date_format');
            $date->set('namespace', 'collections');
            $date->set('xtype', 'textfield');
        }

        $date->set('value', 'M d');
        $date->save();

        $time = $this->modx->getObject(modSystemSetting::class, ['key' => 'collections.mgr_time_format']);
        if (!$time) {
            $time = $this->modx->newObject(modSystemSetting::class);
            $time->set('key', 'collections.mgr_time_format');
            $time->set('namespace', 'collections');
            $time->set('xtype', 'textfield');
        }

        $time->set('value', 'g:i a');
        $time->save();
    }
};
