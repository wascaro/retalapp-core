<?php
/* @var $this BackController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<div class="col-lg-12">
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap">

<em>Para cambiar los estilos del front crea un nuevo tema en <code>/themes/</code> a partir de <code>/themes/classic</code> </em>

<h4>Esta es la vista del front <?php echo $this->uniqueId . '/' . $this->action->id; ?></h4>
<?php echo CHtml::link('El FRONT Controller de este módulo es este ',array('/'.$this->module->id.'/page'),array('class'=>'btn btn-primary')); ?>
<p>Para personalizar este actualiza <tt><?php echo __FILE__; ?></tt></p>


<h4>Ir a la Vista del back <?php echo $this->uniqueId . '/' . $this->action->id; ?></h4>
<?php echo CHtml::link('EL BACK Controller de este módulo es',array('/'.$this->module->id.'/back'),array('class'=>'btn btn-default')); ?>


	</div>
    </div>
</section>
</div>