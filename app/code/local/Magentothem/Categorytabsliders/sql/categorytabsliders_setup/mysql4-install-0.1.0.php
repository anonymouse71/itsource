<?php
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$setup->startSetup();
$setup->addAttribute('catalog_category', 'cattop_thumb', array(
    'group'                    => 'General Information',
    'label'                    => 'Hover thumbnail',
    'input'                    => 'image',
    'type'                     => 'varchar',
    'backend'                  => 'catalog/category_attribute_backend_image',
    'global'                   => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'visible'                  => true,
    'required'                 => false,
    'user_defined'             => true,
    'order'                    => 20
));
$setup->endSetup();