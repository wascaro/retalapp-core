<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
$arratClean=Yii::app()->getModule('gii')->arrayClean;
$module=Yii::app()->getModule('gii');
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */

<?php
$label=$this->labelName;
echo "\$this->breadcrumbs=array(
	'$label'=>array('admin'),
	'Lista de {$label}',
);\n ?>";

?>
<div class="col-lg-12">
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap">
<div class="row">
	<div class="col-lg-6">
		<?php echo "<?php echo CHtml::link('<i class=\"fa fa-file\"></i> '.Yii::t('app','Download CSV file'),array('excelToUpload'),array('class'=>'btn btn-success btn-lg btn-block'))?>"?>
	</div>
	<div class="col-lg-6">
		<?php echo "<?php echo CHtml::link('<i class=\"fa fa-upload\"></i> '.Yii::t('app','Upload new CSV file'),array('create'),array('class'=>'btn btn-primary btn-lg btn-block'))?>"?>
		<h2 class="text-center mtl"><?php echo "<?=r('app','History of updates')?>"?></h2>

<?php echo "<?php"; ?> $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'itemsCssClass'=>'table table-inbox table-hover',
<?php foreach($this->tableSchema->columns as $column):?>
<?php if($column->name=='orden_id'):?>
	'rowHtmlOptionsExpression'=>'array("id"=>$row."-".$data->id,"class"=>"cursor-move")',
<?php endif;?>
<?php endforeach;?>
	'pager'=>array(
    	'class'=>'CLinkPager',
    	'htmlOptions'=>array(
    		'class'=>'pagination'
		),
		'header'=>false,
	),
    'pagerCssClass'=>'paginator-container',
	'dataProvider'=>$model->search(),
	'summaryCssClass'=>'text-center',
	'filter'=>$model,<?php foreach($this->tableSchema->columns as $column):?>
<?php if($column->name=='orden_id'):?>
    'afterAjaxUpdate'=>"js:function(){
        $('#<?php echo $this->class2id($this->modelClass); ?>-grid tbody').sortable({ opacity: 0.00001 });
        $('#<?php echo $this->class2id($this->modelClass); ?>-grid tbody').sortable({
            update: function() {
                var that = $(this);
                $('.loading').html('<i class=\"fa fa-refresh fa-spin\"></i>');
                setTimeout(function () {
                    var order = that.sortable('toArray');
                    $.post('".$this->createUrl("order")."', {order: order}, function(datos){
                        $('.loading').empty();
                    });
                },2000);
            }
        });
    }",
<?php endif;?><?php endforeach;?>
	'columns'=>array(
<?php
$count=0;
foreach($this->tableSchema->columns as $column)
{
	$tangaColumn=$module->getParamsField($column);

	if(++$count==5)
		echo "\t\t/*\n";

	$columnLat=explode('_', $column->name);

    if($column->name=='orden_id')
    {
    	$count--;	
        continue;
    }

    if(preg_match('/^(password|pass|passwd|passcode)$/i',$column->name))
        continue;
    // if($column->name=='id')
    //     continue;

    // if(isset($columnLat[0]) and isset($columnLat[2]) and $columnLat[0]=='map' and ($columnLat[2]=='lat' or $columnLat[2]=='lng'))
    //     continue;
    if(isset($columnLat[0]) and $columnLat[0]=='map')
    {
		$count--;
        continue;
    }
	if($tangaColumn['type']==='img'):
   		echo "\t\tarray(\n";
		echo "\t\t\t'name'=>'".$column->name."',\n";
		echo "\t\t\t'filter'=>false,\n";
		echo "\t\t\t'type'=>'raw',\n";
		echo "\t\t\t'value'=>'\"<span class=\\\"text-muted\\\">\".substr(\$data->".$column->name.",0,50).\"...</span>\"',\n";
		echo "\t\t\t'value'=>'CHtml::image(\$data->".$column->name."_path,\"\",array(\"class\"=>\"img-responsive img-thumbnail\",\"style\"=>\"max-width:100px\"))',\n";
		echo "\t\t),\n";
	elseif($tangaColumn['type']==='text' or $tangaColumn['type']==='editor' or $tangaColumn['type']==='redactor'):
    	echo "\t\tarray(\n";
		echo "\t\t\t'name'=>'".$column->name."',\n";
		echo "\t\t\t'type'=>'raw',\n";
		echo "\t\t\t'value'=>'\"<span class=\\\"text-muted\\\">\".substr(strip_tags(\$data->".$column->name."),0,50).\"...</span>\"',\n";
		echo "\t\t),\n";
	elseif($tangaColumn['type']==='file'):
    	echo "\t\tarray(\n";
		echo "\t\t\t'name'=>'".$column->name."',\n";
		echo "\t\t\t'filter'=>false,\n";
		echo "\t\t\t'type'=>'raw',\n";
		echo "\t\t\t'value'=>'CHtml::link(\"<i class=\\\"fa fa-download\\\"></i>\",\$data->".$column->name."_path,array(\"font-size:100%\"))',\n";
		echo "\t\t),\n";
    elseif($tangaColumn['type']==='link' or $tangaColumn['type']==='url'):
    	echo "\t\tarray(\n";
		echo "\t\t\t'name'=>'".$column->name."',\n";
		echo "\t\t\t'type'=>'raw',\n";
		echo "\t\t\t'value'=>'CHtml::link(\"<i class=\\\"fa fa-external-link\\\"></i> \".strtr(\$data->".$column->name.",array(\"http://\"=>\"\",\"https://\"=>\"\")),\$data->".$column->name.",array(\"target\"=>\"_blank\"))',\n";
		echo "\t\t),\n";
    elseif($tangaColumn['type']==='color'):
    	echo "\t\tarray(\n";
		echo "\t\t\t'name'=>'".$column->name."',\n";
		echo "\t\t\t'type'=>'raw',\n";
		echo "\t\t\t'value'=>'\"<i style=\\\"color:#\".\$data->".$column->name.".\"\\\" class=\\\"fa fa-square\\\"></i>\"',\n";
		echo "\t\t),\n";
    elseif($tangaColumn['type']==='boolean'):
    	echo "\t\tarray(\n";
		echo "\t\t\t'name'=>'".$column->name."',\n";
		echo "\t\t\t'filter'=>array('1'=>Yii::t(\"app\",\"Enabled\"),'0'=>Yii::t(\"app\",\"Disabled\")),\n";
		echo "\t\t\t'type'=>'raw',\n";
		echo "\t\t\t'value'=>'(\$data->".$column->name.")?\"<span class=\\\"label label-success\\\">\".Yii::t(\"app\",\"".ucwords(strtr($column->name,$arratClean))."\").\" \".Yii::t(\"app\",\"Enabled\").\"</span>\":\"<span class=\\\"label label-danger\\\">\".Yii::t(\"app\",\"".ucwords(strtr($column->name,$arratClean))."\").\" \".Yii::t(\"app\",\"Disabled\").\"</span>\"',\n";
		echo "\t\t),\n";
    elseif($tangaColumn['type']==='date'):
        echo "\t\tarray(\n";
		echo "\t\t\t'filter'=>\$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => \$model,
				'attribute' => '".$column->name."',
				'language' =>  Yii::app()->language,
				'htmlOptions' => array('class'=>'form-control'),
				'options' => array(
					'showButtonPanel' => true,
					'changeYear' => true,
					'dateFormat' => 'yy-mm-dd',
				),
			),true),\n";
		echo "\t\t\t'name'=>'".$column->name."',\n";
		echo "\t\t\t'type'=>'raw',\n";
		echo "\t\t\t'value'=>'Yii::app()->format->formatShort(\$data->".$column->name.").\" <br><small class=\\\"text-muted\\\">\".Yii::app()->format->formatAgoComment(\$data->".$column->name.").\"</small>\"',\n";
		echo "\t\t),\n";
	elseif($tangaColumn['type']==='users'):
        echo "\t\tarray(\n";
		echo "\t\t\t'name'=>'".$column->name."',\n";
		echo "\t\t\t'filter'=>Users::listData(),\n";
		echo "\t\t\t'type'=>'raw',\n";
		echo "\t\t\t'value'=>'\$data->user->name.\" \".\$data->user->lastname',\n";
		echo "\t\t),\n";
	elseif($tangaColumn['type']==='select'):
        echo "\t\tarray(\n";
		echo "\t\t\t'name'=>'".$column->name."',\n";
		$result='Model';
		if(isset($tangaColumn['table'])) {
			$result=$module->generateClassName($tangaColumn['table']);
		}
		echo "\t\t\t'filter'=> ".$result."::listData(),\n";
		echo "\t\t\t'type'=>'raw',\n";
		echo "\t\t\t'value'=>'\$data->".$column->name."',\n";
		echo "\t\t\t//'value'=>'\$data->relationame->namefieldtoshow',\n";
		echo "\t\t),\n";
	else:
		echo "\t\tarray(\n";
		echo "\t\t\t'name'=>'".$column->name."',\n";
		echo "\t\t\t'type'=>'raw',\n";
		echo "\t\t\t'value'=>'\$data->".$column->name."',\n";
		echo "\t\t),\n";
	endif;

}
if($count>=5)
	echo "\t\t*/\n";
?>
		/*array(
			'class'=>'CButtonColumn',
		),*/
		//array(
		//	'class'=>'CLinkColumn',
		//	'label'=>Yii::t('app','Delete'),
		//	'htmlOptions'=>array('style'=>'width:60px'),
		//	'urlExpression'=>'Yii::app()->controller->createUrl("delete",array("id"=>$data->primaryKey))',
		//	'linkHtmlOptions'=>array('class'=>'btn btn-danger','data-action'=>'delete'),
		//),
	),
)); ?>
	
	</div>
</div>


		</div>
    </div>
</section>
</div>
<script>
$(function() {
	/**
	 * This event delete or publish an Item
	 * according to selected Item
	*/
	$(document).on('click','[data-action=delete]',function(e){
	    e.preventDefault();
	    var href = $(this).attr('href');
	    bootbox.confirm("¿Está seguro que desea <strong>BORRAR</strong> el registro seleccionado?", function(result) {
	        if(result) {
	            $.ajax({
	                url: href,
	                success:function (data) {
	                    $.fn.yiiGridView.update('<?php echo $this->class2id($this->modelClass); ?>-grid');
	                },
	                error: function (xhr, ajaxOptions, thrownError) {
						bootbox.alert("Ocurrió un error <strong>BORRANDO</strong> el Registro, Verifique nuevamente");
					}
	            });
	        }
	    });
	});
<?php foreach($this->tableSchema->columns as $column):?>
<?php if($column->name=='orden_id'):?>
    $("#<?php echo $this->class2id($this->modelClass); ?>-grid tbody").sortable({ opacity: 0.00001 });
    $("#<?php echo $this->class2id($this->modelClass); ?>-grid tbody").sortable({
    	update: function() {
    		var that = $(this);
			$('.loading').html('<i class="fa fa-refresh fa-spin"></i>');
    		setTimeout(function () {
	        	var order = that.sortable("toArray");
		        $.post('<?php echo "<?php echo \$this->createUrl(\"order\") ?>"?>', {order: order}, function(datos){
	    			$('.loading').empty();
		        });
    		},2000);
        }
    });
<?php endif;?>
<?php endforeach;?>

});
</script>