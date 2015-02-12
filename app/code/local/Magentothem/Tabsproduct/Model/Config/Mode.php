<?php
/*------------------------------------------------------------------------
# Websites: http://www.plazathemes.com/
-------------------------------------------------------------------------*/ 
class Magentothem_Tabsproduct_Model_Config_Mode
{

    public function toOptionArray()
    {
        return array(
            array('value'=>'latest', 'label'=>Mage::helper('adminhtml')->__('Latest Products')),
            array('value'=>'onsale', 'label'=>Mage::helper('adminhtml')->__('Onsale Products')),
            array('value'=>'bestseller', 'label'=>Mage::helper('adminhtml')->__('Bestseller Products')),
            array('value'=>'mostviewed', 'label'=>Mage::helper('adminhtml')->__('Mostviewed Products')),
            array('value'=>'featured', 'label'=>Mage::helper('adminhtml')->__('Featured Products')),
            array('value'=>'new', 'label'=>Mage::helper('adminhtml')->__('New Products'))
        );
    }

}
