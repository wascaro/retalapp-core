<?php
/* @var $this MessagesController */
/* @var $model JobMessages */

$this->breadcrumbs=array(
	'Job Messages'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
