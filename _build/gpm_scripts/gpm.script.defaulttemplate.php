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

use Collections\Model\CollectionTemplate;
use Collections\Model\CollectionTemplateColumn;
use MODX\Revolution\modDocument;
use MODX\Revolution\modX;
use xPDO\Transport\xPDOTransport;

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

        if ($this->action === xPDOTransport::ACTION_UNINSTALL) {
            return true;
        }

        $templates = $modx->getCount(CollectionTemplate::class);
        if ($templates > 0) {
            return true;
        }

        $template = $this->createTemplate();
        $columns = $this->createColumns();
        $template->addMany($columns, 'Columns');

        $template->save();

        return true;
    }

    /**
     * @return CollectionTemplate
     */
    private function createTemplate()
    {
        /** @var CollectionTemplate $template */
        $template = $this->modx->newObject(CollectionTemplate::class);
        $template->set('name', 'Blog');
        $template->set('description', 'A default view that works well for blogs.');
        $template->set('global_template', true);
        $template->set('bulk_actions', true);
        $template->set('allow_dd', true);
        $template->set('page_size', 10);
        $template->set('sort_field', 'publishedon');
        $template->set('sort_dir', 'desc');
        $template->set('child_template', null);
        $template->set('child_resource_type', modDocument::class);
        $template->set('resource_type_selection', true);

        return $template;
    }

    /**
     * @return array
     */
    private function createColumns()
    {
        $columns = [];
        $columns[0] = $this->modx->newObject(CollectionTemplateColumn::class);
        $columns[0]->fromArray([
            'label' => 'id',
            'name' => 'id',
            'hidden' => true,
            'sortable' => true,
            'width' => 40,
            'editor' => '',
            'renderer' => '',
            'position' => 0,
        ]);

        $columns[1] = $this->modx->newObject(CollectionTemplateColumn::class);
        $columns[1]->fromArray([
            'label' => 'publishedon',
            'name' => 'publishedon',
            'hidden' => false,
            'sortable' => true,
            'width' => 40,
            'editor' => '',
            'renderer' => 'Collections.renderer.datetimeTwoLines',
            'position' => 1,
        ]);

        $columns[2] = $this->modx->newObject(CollectionTemplateColumn::class);
        $columns[2]->fromArray([
            'label' => 'pagetitle',
            'name' => 'pagetitle',
            'hidden' => false,
            'sortable' => true,
            'width' => 170,
            'editor' => '',
            'renderer' => 'Collections.renderer.pagetitleWithButtons',
            'position' => 2,
        ]);

        $columns[3] = $this->modx->newObject(CollectionTemplateColumn::class);
        $columns[3]->fromArray([
            'label' => 'alias',
            'name' => 'alias',
            'hidden' => false,
            'sortable' => true,
            'width' => 100,
            'editor' => '',
            'renderer' => '',
            'position' => 3,
        ]);

        $columns[4] = $this->modx->newObject(CollectionTemplateColumn::class);
        $columns[4]->fromArray([
            'label' => 'resource_menuindex',
            'name' => 'menuindex',
            'hidden' => false,
            'sortable' => true,
            'width' => 50,
            'editor' => '{"xtype":"numberfield","allowNegative":false,"allowDecimal":false}',
            'renderer' => '',
            'position' => 4,
        ]);

        return $columns;
    }
};
})()($transport->xpdo, $options[xPDOTransport::PACKAGE_ACTION]);