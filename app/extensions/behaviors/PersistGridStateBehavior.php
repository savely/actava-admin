<?php
class PersistGridStateBehavior extends CActiveRecordBehavior {
    
    private $_stateId = null;

    private $_defaultSorting = '';
    

  //get cirrent state for module - controller
    public function getStateId() {

        if(is_object(Yii::app()->controller->module)) {
            $this->_stateId =  Yii::app()->controller->module->getName(). '_'. Yii::app()->controller->id;
        } else {
            $this->_stateId = 'default_'.Yii::app()->controller->id;
        }
         $lastId = Yii::app()->user->getState('stateId');
         
         if($lastId !== $this->_stateId) {
          //cleanup previous state
          if(strlen($lastId)) $this->clearState($lastId);   
          Yii::app()->user->setState('stateId', $this->_stateId); 
         }

        return $this->_stateId; 
    }
    
    public function getModelName() {
      return get_class($this->owner);  
    }
    
    public function getDefaultSorting() {
       return $this->_defaultSorting; 
    }
    
    /**
    * @see CSort for params format
    * 
    * @param string $value
    */
    
    public function setDefaultSorting($value) {
      $attrSep = '-';
      $dirSep = '.';  
      $attributes = array();
      foreach(explode(',' ,$value) as $attribute) {
         $desc = ''; 
         $attr = explode(' ',trim($attribute));
         if(isset($attr[1]) && (strpos('DESC', strtoupper($attr[1])) !== false)) {
          $desc = $dirSep.'desc';   
         }
         $attributes[] = trim($attr[0]).$desc;
      }
      
      $this->_defaultSorting = implode($attrSep, $attributes);
    }
    
   private function hasFilters() {
      return   isset($_GET[$this->modelName]);  
   }
   
   //change from private to public for auto set category from filter on new news record
   public  function readFilters($stateId) { 
        $attributes = $this->owner->getSafeAttributeNames();
            if (null != ($saveAttrs = Yii::app()->user->getState($stateId. '_attributes', null))) {
                try
                {
                  foreach ($attributes as $attribute) {
                    if(isset($saveAttrs[$attribute]))  
                    $this->owner->$attribute = $saveAttrs[$attribute];
                  }
                }
                catch (Exception $e) {
                }
            }
    }

    private function saveFilters($stateId) {

      $this->owner->unsetAttributes();
      
        $this->owner->attributes = $_GET[$this->modelName];
        
        $attributes = $this->owner->getSafeAttributeNames();
        $saveAttrs = array();
        foreach ($attributes as $attribute) {
            if (isset($this->owner->$attribute)) {
              $saveAttrs[$attribute] = $this->owner->$attribute;    
            }
        }
        if(count($saveAttrs)) {
        Yii::app()->user->setState($stateId. '_attributes', $saveAttrs);        
        }
    }
    
    private function hasSorting() {
      $sortVar = $this->modelName. '_sort';
      return Yii::app()->getRequest()->getParam($sortVar, null) !== null; 
    }
    
    private function readSorting($stateId) {
     if (null != ($value = Yii::app()->user->getState($stateId. '_sort', null))) {
       $sortVar = $this->modelName. '_sort';
       $_GET[$sortVar] = $value;  
     }
    }

    private function saveSorting($stateId) {
       $sortVar = $this->modelName. '_sort'; 
       if (($value = Yii::app()->getRequest()->getParam($sortVar, null)) !== null) {
         Yii::app()->user->setState($stateId. '_sort', $value);           
       }
    }
    
    public function hasPagination() {
      $pageVar = $this->modelName. '_page';
      $hasPagination =  Yii::app()->getRequest()->getParam($pageVar, null) !== null; 
      //first page doesnt set GET variable
      return $hasPagination || isset($_GET['ajax']);
    }    
    
    private function readPagination($stateId) {
     if (null != ($value = Yii::app()->user->getState($stateId. '_page', null))) {
       $pageVar = $this->modelName. '_page';
       $_GET[$pageVar] = $value;  
     }
    }

    private function savePagination($stateId) {
       $pageVar = $this->modelName. '_page'; 
       $value = Yii::app()->getRequest()->getParam($pageVar, null);
         Yii::app()->user->setState($stateId.'_page', $value);           
       
    }
    
    public function afterConstruct($event) { 
      //check if not in console
      if(isset(Yii::app()->user) && $this->owner->scenario == 'search') {  
       $this->readSaveState(); 
      }
    }
    
    protected function readSaveState() {
      $stateId = $this->stateId;  
      if($this->hasFilters()) {
      $this->saveFilters($stateId);  
      } else {
       $this->readFilters($stateId);   
      }
      if($this->hasSorting()) {
      $this->saveSorting($stateId);
      } else {
        $this->readSorting($stateId);
      }
      if($this->hasPagination()) {
      $this->savePagination($stateId);
      } else {
         $this->readPagination($stateId); 
      }
    }
    
    public function clearState($stateId = null) {
      if (empty($stateId)) {
        $stateId = $this->_stateId;  
      }   
      $this->clearFilters($stateId);  
      $this->clearSorting($stateId);
      $this->clearPagination($stateId);
      if(Yii::app()->user->hasState('stateId')) {
      Yii::app()->user->setState('stateId', null);
      }
    }

    protected function clearFilters($stateId) {
    
            if (Yii::app()->user->hasState($stateId. '_attributes')) {
                Yii::app()->user->setState($stateId. '_attributes', null);
            }
    }
    
    protected function clearSorting($stateId) {    
            if (Yii::app()->user->hasState($stateId. '_sort')) {
                Yii::app()->user->setState($stateId. '_sort', strlen($this->defaultSorting) ?  $this->defaultSorting : null);
            }
    }

    protected function clearPagination($stateId) {   
            if (Yii::app()->user->hasState($stateId. '_page')) {
                Yii::app()->user->setState($stateId. '_page', null);
            }
     
    }
    
} 
?>
