<?php

class HeaderController extends CmsController
{
	/////////////////////////////
	// This controller is for  //
	// Back actions            //
	/////////////////////////////
	
	public $defaultAction='admin';
	public $title='<i class="fa fa-shopping-cart"></i> Compras';
	public $subTitle='Admin Compras';
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','update','view','create','order','upload','pdf','excel','enabled','pay','cancel'),
				'roles'=>$this->module->getAllowPermissoms(),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	///////////////////
	// REST actions  //
	///////////////////
	// Put here your rest actions and just response a json

	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model=$this->loadModel($id);

		$detail=new ShoppingDetail;
		$criteria=new CDbCriteria;
		$criteria->compare('shopping_header_id',$id);
		$criteria->order='orden_id';
		$detailDataProvider=new CActiveDataProvider('ShoppingDetail',array(
		    "criteria"=>$criteria,
		));


		$typeRender=Yii::app()->request->isAjaxRequest?"renderPartial":"render";
		$this->{$typeRender}('view',array(
		    'model'=>$model,
		    'detail'=>$detail,
		    'detailDataProvider'=>$detailDataProvider,
		));

	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ShoppingHeader;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['ShoppingHeader']))
		{
			$model->attributes=$_POST['ShoppingHeader'];
			$model->created_at=date('Y-m-d H:i:s');
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['ShoppingHeader']))
		{
			$model->attributes=$_POST['ShoppingHeader'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ShoppingHeader('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ShoppingHeader']))
			$model->attributes=$_GET['ShoppingHeader'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionPdf($id)
	{
		$model=$this->loadModel($id);
		$content=$this->renderPartial('view',array(
			'model'=>$model,
		),true);

		$html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'es');
	    // $html2pdf->setModeDebug();
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content);
		$html2pdf->Output('ShoppingHeader.pdf');
	}

	/**
	 * Manages all models.
	 */
	public function actionExcel()
	{
		$model=new ShoppingHeader('search');
		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['ShoppingHeader']))
			$model->attributes=$_GET['ShoppingHeader'];

		$content=$this->renderPartial('excel',array(
			'model'=>$model,
		),true);
		r()->request->sendFile('Compras.xls',$content);
	}

	public function actionEnabled($id)
	{
		$model=$this->loadModel($id);
		$field=$_POST['field'];
		if($model->{$field})
		{
			$model->{$field}=0;	
			$model->save(true,array($field));
			echo CJSON::encode(array(
				"html"=>r('app','Inactiva'),
				"btn"=>"btn-danger",
				"result"=>1,
			));
		}
		else
		{
			$model->{$field}=1;	
			$model->save(true,array($field));
			echo CJSON::encode(array(
				"html"=>r('app','Activa'),
				"btn"=>"btn-success",
				"result"=>1,
			));
		}
	}

	public function actionPay($id)
	{
		$model=$this->loadModel($id);
		$model->state=1;
		$model->message_return_pay='MANUAL';
		if($model->save(true,array('state','message_return_pay'))) {

			$detail=new ShoppingDetail;
			$criteria=new CDbCriteria;
			$criteria->compare('shopping_header_id',$model->id);
			$criteria->order='orden_id';
			$detailDataProvider=new CActiveDataProvider('ShoppingDetail',array(
			    "criteria"=>$criteria,
			));
			$details=$this->renderPartial('../page/_email',array(
				'model'=>$model,
				'email'=>true,
				'client'=>true,
				'message'=>'Su compra ha sido aprobada y su curso ha sido activado',
				'detail'=>$detail,
				'detailDataProvider'=>$detailDataProvider,
			),true);

			r('email')->add($model->buyer_email,$model->buyer_email);
			r('email')->send(
				Yii::t('app','[Compra aprobada] ').' '.strip_tags(Yii::app()->name),
				$details
			);
		}
		$this->redirect(array('view','id'=>$id));
	}

	public function actionCancel($id)
	{
		$model=$this->loadModel($id);
		$model->state=3;
		$model->message_return_pay='MANUAL';
		$model->save(true,array('state','message_return_pay'));
		$this->redirect(array('view','id'=>$id));
	}

	//////////////////////////
	// Reutilizable methods //
	//////////////////////////
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ShoppingHeader the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ShoppingHeader::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ShoppingHeader $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='shopping-header-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}