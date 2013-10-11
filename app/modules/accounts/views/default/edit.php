<?php 

$modelClass = get_class($model);

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links'=>array(
            Yii::t('main',ucfirst($this->module->id))=> Yii::app()->createUrl($this->module->id), 
            Yii::t('main',ucfirst($this->action->id)),//Yii::t('main','Update')
    ),
));
?>

<?php
$this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true, // display a larger alert block?
    'fade'=>true, // use transitions?
    'closeText'=>'×', // close link text - if set to false, no close link is displayed
    'alerts'=>array( // configurations per alert type
        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
        'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
    ),
    ));
    
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'account-form',
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    ),
));

    //show errors (for all models)
echo $form->errorSummary($model, null, null, array('class' => 'alert-error'));
$accountContent =  $this->renderPartial('_edit_account' , array('model'=> $model,
                                              'form' => $form,
                                               ), true, false);
                                               
   $this->widget('bootstrap.widgets.TbTabs', array(
    'type'=>'tabs',
    'tabs'=>array(
        array('label'=> Yii::t('main', 'Account'), 'content'=> $accountContent, 'active' => true, 'id' => 'tab1'),
        array('label'=> Yii::t('main', 'Users'), 'content'=> '', 'active' => false, 'id' => 'tab2'),
        array('label'=> Yii::t('main', 'Packages'), 'content'=> '', 'active' => false, 'id' => 'tab3'),
      )));
      
?>
    <div class="buttons">
        <? echo TbHtml::submitButton($model->isNewRecord ? Yii::t('main','Create') : Yii::t('main','Save'),array('class'=>'fl-r'))?>
    </div>
    

<?php
$this->endWidget();    
?>