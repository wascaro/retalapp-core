<?php

class FeaturesController extends CmsController
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('delete','view','create','update','order','upload'),
				'roles'=>$this->module->getAllowPermissoms(),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		if(!Yii::app()->request->isAjaxRequest)
			throw new CHttpException(403,"Petición inválida, probablemente ha fallado el JavaScript de su navegador.");
		echo CJSON::encode($this->loadModel($id));
		Yii::app()->end();
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		if(!Yii::app()->request->isAjaxRequest)
			throw new CHttpException(403,"Petición inválida, probablemente ha fallado el JavaScript de su navegador.");
		
		$model=new PriceFeatures;

		if(isset($_POST['PriceFeatures']))
		{
			$model->attributes=$_POST['PriceFeatures'];
			$model->price_items_id=$_GET['price_items_id']; // en curso
$last=PriceFeatures::model()->findAll();
			$model->orden_id=count($last)+1;
			if($model->save())
			{
				echo CJSON::encode($model);
				Yii::app()->end();
			}
			$this->validateAjax($model);
		}
	}

	/**
	 * Update a model.
	 * If update is successful, return a json with updated data.
	 */
	public function actionUpdate($id)
	{
		if(!Yii::app()->request->isAjaxRequest)
			throw new CHttpException(403,"Petición inválida, probablemente ha fallado el JavaScript de su navegador.");
		
		$model=$this->loadModel($id);

		if(isset($_POST['PriceFeatures']))
		{
			$model->attributes=$_POST['PriceFeatures'];
			if($model->save())
			{
				echo CJSON::encode($model);
				Yii::app()->end();
			}
			$this->validateAjax($model);
		}
		
		echo CJSON::encode($model);
		Yii::app()->end();
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(!Yii::app()->request->isAjaxRequest)
			throw new CHttpException(403,"Petición inválida, probablemente ha fallado el JavaScript de su navegador.");
		$model=$this->loadModel($id);
		if($model->delete())
		{
			echo CJSON::encode(array("result"=>1));
			Yii::app()->end();
		} else
			throw new CHttpException(500,"Error al tratar de eliminar este registro, por favor intente más tarde");
	}
	/**
	 * Manages all models.
	 */
	public function actionOrder()
	{
		if(!isset($_POST['order']))
			throw new CHttpException(403,"Petición inválida");
			
		$orden = $_POST['order'];
        $cant = count($orden);
        $id = array();
        $pos = array();
        for($i = 0 ; $i < $cant ; $i++){
            $data = explode('-', $orden[$i]);
            $pos[$i] = $data[0];
            $id[$i] = $data[1];
        }        
        $ini = min($pos);         
        for($i = 0 ; $i < $cant ; $i++){
            $datos = array(
                'orden_id' => $ini,
                'id' => $id[$i]
            );
	        $ini = $ini + 1 ;
	        $model=$this->loadModel($datos['id']);
	        $model->orden_id=$ini; // la tabla debe tener orden_id
	        $model->save(true,array('orden_id'));
	    }
	}

	//////////////////////////
	// Reutilizable methods //
	//////////////////////////
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PriceFeatures the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PriceFeatures::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function validateAjax($model)
	{
		if($model->getErrors()!==array() and isset($_POST['ajax']) and $_POST['ajax']==='price-features-form')
		{
			$result=array();
			foreach($model->getErrors() as $attribute=>$errors)
				$result[CHtml::activeId($model,$attribute)]=$errors;	
			echo CJSON::encode($result);
			Yii::app()->end();
		}
	}
}
