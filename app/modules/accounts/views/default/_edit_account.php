 <div class="row">
<div class="span6">
<? if(!$model->isNewRecord): ?>
    <div class="control-group">
        <?php echo TbHtml::activeLabelEx($model,'id', array('class'=>'control-label')); ?>
        <div class="controls">
            <?php echo TbHtml::activeTelField($model, 'id', array('disabled' => true)); ?>
        </div>
    </div>
<?endif?>

    <div class="control-group">
        <?php echo TbHtml::activeLabelEx($model,'name', array('class'=>'control-label')); ?>
        <div class="controls">
            <?php echo TbHtml::activeTextField($model, 'name', array()); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo TbHtml::activeLabelEx($model,'surname', array('class'=>'control-label')); ?>
        <div class="controls">
            <?php echo TbHtml::activeTextField($model, 'surname', array()); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo TbHtml::activeLabelEx($model,'active', array('class'=>'control-label')); ?>
        <div class="controls">
            <?php echo TbHtml::activeCheckBox($model, 'active', array()); ?>
        </div>
    </div>
</div>  
 
<div class="span6">
    <div class="control-group">
        <?php echo TbHtml::activeLabelEx($model,'pass', array('class'=>'control-label')); ?>
        <div class="controls">
            <?php echo TbHtml::activePasswordField($model, 'newPassword', array()); ?>
        </div>
    </div>
    <div class="control-group">
        <?php echo TbHtml::activeLabelEx($model,'email', array('class'=>'control-label')); ?>
        <div class="controls">
            <?php echo TbHtml::activeEmailField($model, 'email', array()); ?>
        </div>
    </div>
    <div class="control-group">
        <?php echo TbHtml::activeLabelEx($model,'activate_date', array('class'=>'control-label')); ?>
        <div class="controls">
             <div class="input-append">
            <? $this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'activate_date',
                    'pluginOptions'=>array(
                        'format'=>'mm-dd-yyyy hh:mm:ss',
                    ),
                   'htmlOptions' => array(
                        'placeholder' => 'Select date'
                    ),
                ));
            ?>
          </div>
        </div>
    </div>
    <div class="control-group">
        <?php echo TbHtml::activeLabelEx($model,'deactivate_date', array('class'=>'control-label')); ?>  
        
        <div class="controls">
             <div class="input-append">
            <? $this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
                    'model'=>$model,
                    'attribute'=>'deactivate_date',
                    'pluginOptions'=>array(
                        'format'=>'mm-dd-yyyy hh:mm:ss',
                    ),
                   'htmlOptions' => array(
                        'placeholder' => 'Select date'
                    ),
                ));
            ?>
          </div>
        </div>
    </div>  
    
    <!--<div class="control-group">
        <?php //echo TbHtml::activeLabelEx($model->dealer,'dealer', array('class'=>'control-label')); ?>  
            <div class="controls">
            <? /*$this->widget('yiiwheels.widgets.select2.WhSelect2', array(
            'asDropDownList'=>true,
            'model'=>$model,
            'attribute'=>'id',
            'pluginOptions'=>array(
                'ajax'=>array(
                    'url'=>$this->createUrl('dealers/autocomplete'),
                    'dataType'=>'json',
                    'data'=>'js: function (term, page) {
                    return {
                    name: term,
                    self: true 
                    };
                    }',
                    'results'=>'js: function (data, page) { 
                    return {results: data};
                    }'
                ),
                'formatResult'=>'js: function (data) {
                return data.name;
                }',
                'formatSelection'=>'js: function (data) {
                return data.name;
                }',
            )
        ));
           */ ?>
        </div>
    </div> -->
    <? if(!$model->isNewRecord): ?>
    <div class="control-group">
        <?php echo TbHtml::activeLabelEx($model,'first_login', array('class'=>'control-label')); ?>
        <div class="controls">
            <?php echo TbHtml::activeDateTimeField($model, 'first_login', array('disabled' => true)); ?>
        </div>
    </div>
 <?endif?>   
</div>     