<?php
class Magentothem_Categorytabsliders_Block_Categorytabsliders_Advanced extends Mage_Catalog_Block_Product_Abstract
{
   protected function _construct()
   { 
     if($this->getConfig('enabled') != 1) return false;
	   parent::_construct();
   }
   
    protected function _beforeToHtml(){
        return parent::_beforeToHtml();
    }
    public function getTitle()
    {
        return $this->getData('title');
    }
	
	public function getIdentify() {
	    return $this->getData('identify');
    }
	
    public function getProductsCount()
    {
        return $this->getData('products_count');
    }
	
	public function getProductsOnRow() {
	    return $this->getData('product_on_row');
    }
	public function getConfig($att) {
		$config = Mage::getStoreConfig('categorytabsliders');
		if (isset($config['categorytabsliders_config']) ) {
			$value = $config['categorytabsliders_config'][$att];
			return $value;
		} else {
			throw new Exception($att.' value not set');
		}
	}
	
	function getProductCate($id = NULL) {
        $storeId = Mage::app()->getStore()->getId();
        $_category = Mage::getModel('catalog/category')->load($id);
        $product = Mage::getModel('catalog/product');
        $json_products = array();
        //load the category's products as a collection
        $_productCollection = $product->getCollection()
                ->addAttributeToSelect('*')
                ->addCategoryFilter($_category);
				Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($_productCollection);
				Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($_productCollection);
		$productLimits = $this->getProductsCount();
		if(!$productLimits) $productLimits = 10;
		$_productCollection->setPageSize($productLimits);
        $_productCollection->load();
		return $_productCollection;
		
    }
	
	public function getCatResizedSlider($cat ,$width, $height = null, $quality = 100) {
		if (! $cat->getThumbnail())
			return false;

		$imageUrl = Mage::getBaseDir ( 'media' ) . DS . "catalog" . DS . "category" . DS . $cat->getThumbnail();
		if (! is_file ( $imageUrl ))
			return false;

        $imageResized = Mage::getBaseDir ( 'media' ) . DS . "catalog" . DS . "category" . DS . "cache" . DS . "cat_resized" . DS . $cat->getThumbnail();// Because clean Image cache function works in this folder only
        if (! file_exists ( $imageResized ) && file_exists ( $imageUrl ) || file_exists($imageUrl) && filemtime($imageUrl) > filemtime($imageResized)) :
        	$imageObj = new Varien_Image ( $imageUrl );
        $imageObj->constrainOnly ( true );
        $imageObj->keepAspectRatio ( true );
        $imageObj->keepFrame ( true ); // ep
        $imageObj->quality ( $quality );
        $imageObj->keepTransparency(true);  // png
        $imageObj->backgroundColor(array(255,255,255));
        $imageObj->resize ( $width, $height );
        $imageObj->save ( $imageResized );
        endif;
        
        if(file_exists($imageResized)){
        	return Mage::getBaseUrl ( 'media' ) ."/catalog/category/cache/cat_resized/" . $cat->getThumbnail();
        }else{
        	return $this->getImageUrl();
        }

    }

    public function getCatResizedSliderHover($cat ,$width, $height = null, $quality = 100) {
        if (! $cat->getCattopThumb())
            return false;

        $imageUrl = Mage::getBaseDir ( 'media' ) . DS . "catalog" . DS . "category" . DS . $cat->getCattopThumb();
        if (! is_file ( $imageUrl ))
            return false;

        $imageResized = Mage::getBaseDir ( 'media' ) . DS . "catalog" . DS . "category" . DS . "cache" . DS . "catslider_resized" . DS . $cat->getCattopThumb();// Because clean Image cache function works in this folder only
        if (! file_exists ( $imageResized ) && file_exists ( $imageUrl ) || file_exists($imageUrl) && filemtime($imageUrl) > filemtime($imageResized)) :
            $imageObj = new Varien_Image ( $imageUrl );
        $imageObj->constrainOnly ( true );
        $imageObj->keepAspectRatio ( true );
        $imageObj->keepFrame ( true ); // ep
        $imageObj->quality ( $quality );
        $imageObj->keepTransparency(true);  // png
        $imageObj->backgroundColor(array(255,255,255));
        $imageObj->resize ( $width, $height );
        $imageObj->save ( $imageResized );
        endif;
        
        if(file_exists($imageResized)){
            return Mage::getBaseUrl ( 'media' ) ."/catalog/category/cache/catslider_resized/" . $cat->getCattopThumb();
        }else{
            return $this->getImageUrl();
        }

    }
	
}
