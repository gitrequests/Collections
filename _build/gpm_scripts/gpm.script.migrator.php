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

use MODX\Revolution\Transport\modTransportPackage;
use Collections\Model\CollectionContainer;
use Collections\Model\CollectionTemplate;
use MODX\Revolution\modResource;
use MODX\Revolution\modSystemSetting;

class Migrator
{
    private $modx;
    private $name = 'collections';
    private $latestVersion = '';
    public function __construct(&$modx)
    {
        $this->modx =& $modx;
        $this->getLatestVersion();
    }

    private function getMigrationsMap()
    {
        $migrations = [
            (function () {
                
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
            })(),
            (function () {
                

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
            })(),
            (function () {
                

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
            })(),
        ];

        $migrationsMap = [];

        foreach ($migrations as $migration) {
            $migrationsMap[$migration::VERSION] = $migration;
        }

        uksort($migrationsMap, 'version_compare');

        return $migrationsMap;
    }

    public function migrate()
    {
        if (empty($this->latestVersion)) return;

        $migrationsMap = $this->getMigrationsMap();

        foreach ($migrationsMap as $version => $migration) {
            if (version_compare($version, $this->latestVersion, '>')) {
                $this->modx->log(\MODX\Revolution\modX::LOG_LEVEL_INFO, 'Running migration: ' . $version);
                $migration($this->modx);
            }
        }

    }

    private function getLatestVersion()
    {
        $c = $this->modx->newQuery(modTransportPackage::class);
        $c->where([
            'workspace' => 1,
            "(SELECT
                    `signature`
                  FROM {$this->modx->getTableName(modTransportPackage::class)} AS `latestPackage`
                  WHERE `latestPackage`.`package_name` = `modTransportPackage`.`package_name`
                  ORDER BY
                     `latestPackage`.`version_major` DESC,
                     `latestPackage`.`version_minor` DESC,
                     `latestPackage`.`version_patch` DESC,
                     IF(`release` = '' OR `release` = 'ga' OR `release` = 'pl','z',`release`) DESC,
                     `latestPackage`.`release_index` DESC
                  LIMIT 1,1) = `modTransportPackage`.`signature`",
        ]);
        $c->where([
            'modTransportPackage.package_name' => $this->name,
            'installed:IS NOT' => null
        ]);

        /** @var modTransportPackage $oldPackage */
        $oldPackage = $this->modx->getObject(modTransportPackage::class, $c);
        if ($oldPackage) {
            $this->latestVersion = $oldPackage->getComparableVersion();
        }
    }
}

(new Migrator($transport->xpdo))->migrate();
