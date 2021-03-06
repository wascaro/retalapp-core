<?php
/* @var $this ConfigController */
/* @var $model CartConfig */

$this->breadcrumbs=array(
	Yii::t('app','Update'),
);
?>

<div class="col-lg-12">
<?php foreach(Yii::app()->user->getFlashes() as $type => $message):?>
  <div class="alert alert-<?php echo $type?>">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo $message?>
  </div>
<?php endforeach;?>

<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap ">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cart-config-form',
	'htmlOptions'=>array("class"=>"","role"=>"form"),
	'enableAjaxValidation'=>true,
    'clientOptions'=>array('validateOnSubmit'=>true),
)); ?>
	<div class="col-lg-12">
	<?php echo $form->errorSummary($model,null,null,array('class'=>'alert alert-danger')); ?>

    <div class="form-group">
        <div class="pull-right">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'btn btn-primary btn-large')); ?>
        </div>
    </div>

<div class="row">
<div class="col-lg-4">
    
    <div class="alert alert-info mtl">
        <em>For testing <strong>POL</strong> you can see more info <a target="_black" href="http://www.pagosonline.com/desarrolladores/manuales/pagosonline.net%20-%20manual%20de%20integracin%20tradicional%203.pdf">here</a></em> 
        <br>
        <em>For testing <strong>PAYU</strong> you can see more info <a target="_black" href="http://docs.payulatam.com/manual-integracion-web-checkout/paso-a-produccion/">here</a></em> 
    </div>
    
    <legend><?=r('app','Config account')?></legend>

<div class="form-group">
    <?php echo $form->labelEx($model,'pol_api_key',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
                'model'=>$model,
                'attribute'=>'pol_api_key',
                'allowed' => 255,
                'htmlOptions' => array('class'=>'form-control'),
            ),true); ?>
    <?php echo $form->error($model,'pol_api_key',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'pol_merchant_id',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
                'model'=>$model,
                'attribute'=>'pol_merchant_id',
                'allowed' => 255,
                'htmlOptions' => array('class'=>'form-control'),
            ),true); ?>
    <?php echo $form->error($model,'pol_merchant_id',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'pol_test',array('class'=>'control-label')); ?>
    <?php echo $form->checkBox($model,'pol_test'); ?>
    <?php echo $form->error($model,'pol_test',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'pol_currency',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
                'model'=>$model,
                'attribute'=>'pol_currency',
                'allowed' => 3,
                'htmlOptions' => array('class'=>'form-control'),
            ),true); ?>
    <?php echo $form->error($model,'pol_currency',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'pol_description',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
                'model'=>$model,
                'attribute'=>'pol_description',
                'allowed' => 255,
                'htmlOptions' => array('class'=>'form-control'),
            ),true); ?>
    <?php echo $form->error($model,'pol_description',array('class'=>'help-block')); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model,'overall_tax',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
                'model'=>$model,
                'attribute'=>'overall_tax',
                'allowed' => 11,
                'htmlOptions' => array('class'=>'form-control'),
            ),true); ?>
    <?php echo $form->error($model,'overall_tax',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'email_just_test',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
                'model'=>$model,
                'attribute'=>'email_just_test',
                'allowed' => 255,
                'htmlOptions' => array('class'=>'form-control'),
            ),true); ?>
    <?php echo $form->error($model,'email_just_test',array('class'=>'help-block')); ?>
</div>
    </div>
    <div class="col-lg-8">
 

<?php /*
<div class="form-group">
    <?php echo $form->labelEx($model,'shipping_cost',array('class'=>'control-label')); ?>
    <?php echo $form->textField($model,'shipping_cost',array('class'=>'form-control')); ?>
    <?php echo $form->error($model,'shipping_cost',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'shipping_data_required',array('class'=>'control-label')); ?>
    <?php echo $form->checkBox($model,'shipping_data_required'); ?>
    <?php echo $form->error($model,'shipping_data_required',array('class'=>'help-block')); ?>
</div>
*/?>
    <!-- <legend><?=r('app','Emails and copies')?></legend> -->
<?php if($this->module->showConditions):?>
    <legend><?=r('app','Purcharse Conditions')?></legend>
    <div class="form-group">
        <?php echo $form->labelEx($model,'editor_purchase_terms',array('class'=>'control-label')); ?>
        <?php echo $this->widget('ext.inputs.wisi.GSummerNote', array(
                    'model'=>$model,
                    'attribute'=>'editor_purchase_terms',
                    'height'=>'250px',
                    'htmlOptions' => array(
                        'class' => 'form-control',
                    )
                ),true)?>
        <?php echo $form->error($model,'editor_purchase_terms',array('class'=>'help-block')); ?>
    </div>
<?php endif;?>
    </div>
    
</div>
    <div class="form-group">
        <div class="pull-right">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'btn btn-primary btn-large')); ?>
        </div>
    </div>
    </div>
<?php $this->endWidget(); ?>
        </div>
    </div>
</section>

</div>