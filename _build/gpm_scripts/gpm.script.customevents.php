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


return (function () {
    return new class() {
    /**
     * @var \MODX\Revolution\modX
     */
    private $modx;

    /**
     * @var int
     */
    private $action;

    /**
    * @param \MODX\Revolution\modX $modx
    * @param int $action
    * @return bool
    */
    public function __invoke(&$modx, $action)
    {
        $this->modx =& $modx;
        $this->action = $action;

        $events = [
            'CollectionsOnResourceSort',
        ];

        switch ($this->action) {
            case \xPDO\Transport\xPDOTransport::ACTION_INSTALL:
            case \xPDO\Transport\xPDOTransport::ACTION_UPGRADE:
                foreach ($events as $eventName) {
                    $event = $this->modx->getObject(\MODX\Revolution\modEvent::class, ['name' => $eventName]);
                    if (!$event) {
                        $event = $this->modx->newObject(\MODX\Revolution\modEvent::class);
                        $event->set('name', $eventName);
                        $event->set('service', 6);
                        $event->set('groupname', 'Collections');
                        $event->save();
                    }
                }

                break;
            case \xPDO\Transport\xPDOTransport::ACTION_UNINSTALL:
                foreach ($events as $eventName) {
                    $event = $this->modx->getObject(\MODX\Revolution\modEvent::class, ['name' => $eventName]);
                    if ($event) {
                        $event->remove();
                    }
                }

                break;
        }

        return true;
    }
};
})()($transport->xpdo, $options[xPDOTransport::PACKAGE_ACTION]);