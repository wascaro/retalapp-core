<?php

class TextController extends CmsController
{
	public $defaultAction='index';
	public $title='<i class="fa fa-question"></i> Main Text';
	public $subTitle='Admin Main Text';

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
				'actions'=>array('index','upload'),
				'roles'=>$this->module->getAllowPermissoms(),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionIndex()
	{
		$this->title='<i class="fa fa-question"></i> '.Yii::t('app','Main Text');
		$this->subTitle='Admin '.Yii::t('app','Main Text');
		
		$model=HowWorkText::model()->find();
		if($model===null)
			$model=new HowWorkText;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['HowWorkText']))
		{
			$model->attributes=$_POST['HowWorkText'];
			if($model->save())
	        {
            	Yii::app()->user->setFlash('success',Yii::t('app','The record was saved successfully'));
                $this->refresh();
            }
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}

	//////////////////////////
	// Reutilizable methods //
	//////////////////////////
	/**
	 * Performs the AJAX validation.
	 * @param HowWorkText $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='how-work-text-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
