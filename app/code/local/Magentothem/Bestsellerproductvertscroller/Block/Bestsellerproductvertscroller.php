<?php
class Magentothem_Bestsellerproductvertscroller_Block_Bestsellerproductvertscroller extends Mage_Catalog_Block_Product_Abstract
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }

    protected function useFlatCatalogProduct()
    {
        return Mage::getStoreConfig('catalog/frontend/flat_catalog_product');
    }
    
     public function getBestsellerproductvertscroller()     
     { 
        if (!$this->hasData('bestsellerproductvertscroller')) {
            $this->setData('bestsellerproductvertscroller', Mage::registry('bestsellerproductvertscroller'));
        }
        return $this->getData('bestsellerproductvertscroller');
        
    }
	public function getProducts()
    {
		$_rootcatID = Mage::app()->getStore()->getRootCategoryId();
        $collection = Mage::getResourceModel('bestsellerproductvertscroller/product_bestseller');
             
        $collection = $this->_addProductAttributesAndPrices($collection)
                    ->addOrderedQty()
                    ->addMinimalPrice()
                    ->setOrder('ordered_qty', 'desc')
					->joinField('category_id','catalog/category_product','category_id','product_id=entity_id',null,'left')
  ->addAttributeToFilter('category_id', array('in' => $_rootcatID));

        // getNumProduct
        $collection->setPageSize($this->getConfig('qty'));

        if($this->useFlatCatalogProduct())
        {
            // fix error mat image vs name while Enable useFlatCatalogProduct
            foreach ($collection as $product) 
            {
                $productId = $product->_data['entity_id'];
                $_product = Mage::getModel('catalog/product')->load($productId); //Product ID
                $product->_data['name']        = $_product->getName();
                $product->_data['thumbnail']   = $_product->getThumbnail();
                $product->_data['small_image'] = $_product->getSmallImage();
            }            
        }  

        $this->setProductCollection($collection);
    }
	public function getConfig($att) 
	{
		$config = Mage::getStoreConfig('bestsellerproductvertscroller');
		if (isset($config['bestsellerproductvertscroller_config']) ) {
			$value = $config['bestsellerproductvertscroller_config'][$att];
			return $value;
		} else {
			throw new Exception($att.' value not set');
		}
	}
}