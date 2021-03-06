<?php
/* @var $this HeaderController */
/* @var $model ShoppingHeader */

$this->breadcrumbs=array(
	'Compras'=>array('admin'),
	$model->id,
);
?>
<div class="col-lg-12">
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap">
    <div class="form-group">
      <div class="text-right">
        
        <?php if($model->state!=1):?>
          <?php echo CHtml::link(Yii::t('app','Marcar como pagado'),array('pay','id'=>$model->id),array('class'=>'btn btn-large btn-success'))?>
        <?php else:?>
          <?php echo CHtml::link(Yii::t('app','Marcar como cancelada'),array('cancel','id'=>$model->id),array('class'=>'btn btn-large btn-danger'))?>
        <?php endif;?>
        <?php echo CHtml::link(Yii::t('app','Back'),array('admin'),array('class'=>'btn btn-large btn-default'))?>

      </div>
    </div>
<div class="row">
    
    <div class="col-lg-4">
    
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('buyer_name')); ?>:</b></div>
          <div class="panel-body">
            <p>
            <?php echo $model->buyer_name;?> 
              <?php echo $model->getStateLabel();?>
            </p>
          </div>

          <!-- <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('state')); ?>:</b></div>
          <div class="panel-body">
            <?php if($model->state):?>
              <a href="#" data-field="state" data-action="enabled" class="btn btn-lg btn-block btn-success">Activa</a>
            <?php else:?>
              <a href="#" data-field="state" data-action="enabled" class="btn btn-lg btn-block btn-danger">Inactiva</a>
            <?php endif;?>
          </div> -->
 
          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('buyer_email')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->buyer_email;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('buyer_phone')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->buyer_phone;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('buyer_address')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->buyer_address;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('buyer_message')); ?>:</b></div>
          <div class="panel-body">
            <?php echo Yii::app()->format->toBr($model->buyer_message);?>
          </div>

        </div>
    </div>
    <div class="col-lg-4">
      <div class="panel panel-default">
          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('send_name')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->send_name;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('send_phone')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->send_phone;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('send_address')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->send_address;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('send_date')); ?>:</b></div>
          <div class="panel-body">
              <?php echo Yii::app()->format->formatShort($model->send_date);?>
          </div>


        </div>
    </div>
    <div class="col-lg-4">
      <div class="panel panel-default">
          
          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('created_at')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->created_at;?>
            <span class="text-muted">
              <?php echo Yii::app()->format->formatAgoComment($model->created_at);?>
            </span>
            </p>
          </div>


          <!-- <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('pol_response')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->pol_response;?></p>
          </div>
          -->
          <?php if(!isset($delivery)):?>
          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('datetime_return_pay')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->datetime_return_pay;?></p>
          </div> 
          
          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('message_return_pay')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->message_return_pay;?></p>
          </div> 
          
          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('code2_response_pay')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->code2_response_pay;?></p>
          </div> 
          <?php endif;?>


        </div>
    </div>

    <div class="col-lg-12">
      <?php $this->renderPartial('../detail/view_embed',array(
          'model'=>$model,
          'detailDataProvider'=>$detailDataProvider,
          'detail'=>$detail,
      ))?>
      <h1>$<?php echo r()->format->money($model->getTotalPurchase())?> <small>Total de la compra</small></h1>
    
    </div>
    
</div>

    <div class="form-group">
        <div class="text-right">
        <?php echo CHtml::link(Yii::t('app','Back'),array('admin'),array('class'=>'btn btn-large btn-default'))?>        </div>
    </div>
        </div>
    </div>
</section>
</div>
<script>
  // $(function(){

  //   $(document).on('click', '[data-action="enabled"]', function(e) {
  //     e.preventDefault();
  //     var that=$(this);
  //     var field = that.attr('data-field');
  //     that.html('...');
  //     that.removeClass('btn-success btn-danger');
  //     $.ajax({
  //         url: '<?=$this->createUrl("enabled",array("id"=>$model->id))?>',
  //         type: 'post',
  //         data: { 'field': field },
  //         dataType: 'json',
  //         success: function(data){
              
  //             if(data.result) {
  //               setTimeout(function(){
  //                 that.addClass(data.btn);
  //                 that.html(data.html);
  //               },200);
  //             } else {
  //               bootbox.alert(data.message);
  //             }
  //         },
  //     });
  //   });
  // })
</script>