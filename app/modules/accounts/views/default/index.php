<?php 
/* @var $this DefaultController */

//create datetime picker for first login filter
$modelClass = get_class($model);

$dateFilter = $this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
                    'name'=>$modelClass.'[first_login]',
                    'value'=>$model->first_login,
                    'pluginOptions' => array(
                        'format' => 'yyyy-mm-dd',
                    ),
                    'htmlOptions' => array(
                        'id'=>$modelClass.'_first_login',
                    ),
                ), true);

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links'=>array(
            Yii::t('main',ucfirst($this->module->id))=> Yii::app()->createUrl($this->module->id), 
            Yii::t('main',ucfirst($this->action->id)),
    ),
));
?>

<?php echo CHtml::link('<span>'.Yii::t('main','Create').'</span>', Yii::app()->controller->createUrl("create"), array(
        'id' => 'btnAdd',
        'class' => 'btn fr',
    )); ?>
<div class="fl-l" style="margin-top: 10px;">
    <div id="div-loading" class=""></div>
</div>
<div class="clearfix"></div>

<?php
$this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true, // display a larger alert block?
    'fade'=>true, // use transitions?
    'closeText'=>'&times;',//'&times;', // close link text - if set to false, no close link is displayed
    'alerts'=>array( // configurations per alert type
    'success'=>array('block'=>true, 'fade'=>true/*, 'closeText'=>'&times;'*/), // success, info, warning, error or danger
     'error'=>array('block'=>true, 'fade'=>true/*, 'closeText'=>'&times;'*/), // success, info, warning, error or danger
    'warning'=>array('block'=>true, 'fade'=>true/*, 'closeText'=>'&times;'*/), // success, info, warning, error or danger
    ),
));
?>

                     

<?php
$idGrid = 'accounts-grid';
   $columns = array (
        array(
            'name'=>'id',
            'header'=>Yii::t('main','ID'),
            'type'=>'raw',
            'htmlOptions'=>array('style'=>'width: 50px'),
            'filterInputOptions'=>array('style'=>'width: 50px'),
//            'value'=>'$data->author->email',
//            'filter'=>'<input id="'.$modelClass.'_postAuthor" type="text" name="'.$modelClass.'[postAuthor]" value="' . $model->postAuthor . '">',
        ),

        array(
            'name'=>'name',
            'type'=>'raw',
        ),

        array(
            'name'=>'surname',
            'type'=>'raw',
        ),

        array(
            'name'=>'contract_number',
            'type'=>'raw',
        ),
        
        array(
            'name'=>'first_login',
            'type'=>'raw',
            'htmlOptions'=>array('style'=>'width: 150px'),
            'filter'=>$dateFilter,
            'filterInputOptions'=>array('style'=>'width: 150px'),
            'value'=>'$data->first_login',
        ),        

        
    );
    
    $buttoncolumn = array(
            'htmlOptions' => array('nowrap'=>'nowrap', 'style' => 'width: 150px'),
            'class'=>'TbButtonColumn',
            'template' => '{update}{delete}{active}'  ,
            
          'buttons' => array(  'active' =>  array(
                                            'labelExpression' => '$data->active == 1 ?  Yii::t("main","Off") : Yii::t("main","On")',
                                            'url' => 'Yii::app()->controller->createUrl("activate", array("id" => $data->id, "active" => (!$data->active) ? 1:0))',
                                            //'cssClassExpression' => '$data->active == 1 ? "button on fl-l mr-5" : "button off fl-l mr-5"',
//                                            'imageUrl'=>'$data->active == 0 ? "images/icons/inactive.png" : "images/icons/active.png"',
                                            // 'icon' => 'on', 
                                            'options' => array(
                                                'ajax' => array(
                                                    'type' => 'get', 
                                                    'url'=>'js:$(this).attr("href")', 
                                                    'beforeSend' => 'js:onBeforeSend', 
                                                    'success' => 'js:onSuccess', 
                                                ), 
                                            ),
                                           ),
                           'delete'   => array(
                                           //'label'=>Yii::t("main","Delete"),
                                           'icon' => 'remove',
                                           'url' => 'Yii::app()->controller->createUrl("delete", array("id" => $data->id))',
                                           'options' => array(
                                                //'class' => 'button btn btn-small btn-info', 
                                                'ajax' => array(
                                                    'type' => 'post', 
                                                    'url'=>'js:$(this).attr("href")', 
                                                    'beforeSend' => 'js:function() { 
                                                                    if ((isDel = confirm("' . Yii::t('main', 'Are you sure to delete this item') . '?")))
                                                                        loadingShow();
                                                                    else
                                                                        loadingHide();
                                                                    return isDel;
                                                             }',
                                                    'success' => 'js:onSuccess', 
                                                    )
                                           ),
                                           ), 

                           'update'  => array(
                                            'label'=>Yii::t("main", "Edit"),
                                            'icon' => 'edit',
                                            'url' => 'Yii::app()->controller->createUrl("update", array("id" => $data->id))',
                                            'options' => array(
                                               // 'class' => 'button edit fl-l mr-5', 
                                            ),
                                           ),
                           )                                          
            );
    
    $columns[] = $buttoncolumn;
                
                
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>$idGrid,
    'dataProvider'=> $model->search(),
    'filter'=> $model,
    'type'=>'striped', //'striped, condensed, bordered, hover',
    'htmlOptions' => array('class' => 'table-list'),
    'template'=>"{items}\n{pager}",
    'beforeAjaxUpdate' => 'onBeforeSend',
    'afterAjaxUpdate' => 'reinstallDatePicker',
    'columns'=>$columns,
    )
); 

$js = '
       function loadingShow() {
            $("#div-loading").addClass("grid-loading");
       }
       function loadingHide() {
            $("#div-loading").removeClass("grid-loading");
       }

       function onBeforeSend() { 
            loadingShow()
            return true;
       }
       function onAfterSend(data) { 
            loadingHide();
       }
       function onSuccess(data) { 
            $.fn.yiiGridView.update("'.$idGrid.'");
            loadingHide();
       }';
Yii::app()->getClientScript()->registerScript('jsLoading', $js); 

//$js1 = "jQuery.datepicker.regional['ru'].dateFormat = 'yyyy-mm-dd';";
//Yii::app()->getClientScript()->registerScript('setDateFormat', $js1, CClientScript::POS_END);

Yii::app()->clientScript->registerScript('re-install-date-picker', "
        function reinstallDatePicker(id, data) {
            $('#".$modelClass."_first_login').datepicker({format: 'yyyy-mm-dd'});
            onAfterSend();
        }
    ");


?>