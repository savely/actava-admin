<?php
/**
* Controller for News model
*/
class DefaultController extends EController
{
            
    public function actionIndex() {
     $model = new Account('search');
     if(isset($_POST['Account'])) {
       $model->attributes = $_POST['Account'];
     }   
     $this->render('index', array('model' => $model));
    }
    
    public function actionActivate($active){
        $id = Yii::app()->request->getParam('id');
         Account::setActive($id, $active);
         Yii::app()->end();
    }  
    
      
    
    public function accessRules()
    {
        return array();
    }    
}
?>