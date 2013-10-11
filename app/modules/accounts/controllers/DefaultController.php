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
         Account::setActiveById($id, $active);
         Yii::app()->end();
    }  
    
    public function actionCreate()
    {
        $model = new Account();
        
        if(isset($_POST['Account'])) {
          //create new account 
          $model->attributes = $_POST['Account'];  
          $model->pass = $model->encrypt($model->newPassword);
          $model->contract_number = Account::generateContractOfAccount();
//          $dateFormatter = new CDateFormatter('en_US');
//          $model->activate_date  = $dateFormatter->format('yyyy-mm-dd HH:mm:ss',  $model->activate_date);
//          $model->deactivate_date = $dateFormatter->format('yyyy-mm-dd HH:mm:ss',  $model->deactivate_date);
          
          if($model->validate()) {
             if($model->save()) {
                Yii::app()->user->setFlash('success', Yii::t('main', 'Account created!'));   
                    $this->redirect(array('update'));                
             }
          }else {
                   Yii::app()->user->setFlash('error', Yii::t('main', 'Error on create account!')) ; 
                }
        }
        $this->render('edit', array('model' => $model));
    }    
    
    public function actionUpdate($id)
    {
      $model = $this->loadModel('Account', $id);          
      
        if(isset($_POST['Account'])) {
          //update account 
           $model->attributes = $_POST['Account'];  
          if(!empty($model->newPassword)) {
          $model->pass = $model->encrypt($model->newPassword);
           $model->newPassword = '';
          }
          //$dateFormatter = new CDateFormatter('en_US');
          //$model->activate_date  = $dateFormatter->format('yyyy-mm-dd HH:mm:ss',  $model->activate_date);
          //$model->deactivate_date = $dateFormatter->format('yyyy-mm-dd HH:mm:ss',  $model->deactivate_date);
          if($model->validate()) {
             if($model->save()) {
                Yii::app()->user->setFlash('success', Yii::t('main', 'Account updated!'));   
             }
          }else {
                   Yii::app()->user->setFlash('error', Yii::t('main', 'Error on create account!')) ; 
                }
        }  
       $this->render('edit', array('model' => $model));
    }     
    
    public function accessRules()
    {
        return array();
    }
    
        
}
?>