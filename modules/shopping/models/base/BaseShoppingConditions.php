<?php

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=ShoppingConditions::model()->findByPk($id);
 * // Or create a new record
 * // $model=new ShoppingConditions;
 * $model->conditions='value';
 * $model->save();
 *
 *
 * Retrive Severals records
 * $shopping_conditions=ShoppingConditions::model()->findAll(array('order'=>'orden_id'));
 * <?php foreach($shopping_conditions as $data): ?>
 * <?=$data->id;?>
 * <?=$data->conditions;?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $shopping_conditions=ShoppingConditions::model()->find();
 * <?=$shopping_conditions->id;?>
 * <?=$shopping_conditions->conditions;?>
 * 
 * This is the model class for table "shopping_conditions".
 *
 * The followings are the available columns in table 'shopping_conditions':
 * @property integer $id
 * @property string $conditions
 */
class BaseShoppingConditions extends Model
{

	public function afterFind()
	{
		parent::afterFind();
	}

	protected function beforeValidate()
	{
		return parent::beforeValidate();
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shopping_conditions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('conditions', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, conditions', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app','ID'),
			'conditions' => Yii::t('app','Términos y condiciones'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('conditions',$this->conditions,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the list key value
	 */
	public static function listData()
	{
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','conditions');
	}
}