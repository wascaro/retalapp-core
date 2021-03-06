<?php

/**
 * Examples how to use for retrive data
 * 
 * Update one record  
 * $model=NewsletterConfig::model()->findByPk($id);
 * // Or create a new record
 * // $model=new NewsletterConfig;
 * $model->text='value';
 * $model->save();
 *
 *
 * Retrive Severals records
 * $newsletter_config=NewsletterConfig::model()->findAll(array('order'=>'orden_id'));
 * <?php foreach($newsletter_config as $data): ?>
 * <?=$data->id;?>
 * <?=r()->format->toBr($data->text);?>
 * <?php endforeach; ?>
 * 
 *
 * Retrive first record
 * $newsletter_config=NewsletterConfig::model()->find();
 * <?=$newsletter_config->id;?>
 * <?=r()->format->toBr($newsletter_config->text);?>
 * 
 * This is the model class for table "newsletter_config".
 *
 * The followings are the available columns in table 'newsletter_config':
 * @property integer $id
 * @property string $text
 */
class BaseNewsletterConfig extends Model
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
		return 'newsletter_config';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('text', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, text', 'safe', 'on'=>'search'),
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
			'text' => Yii::t('app','Text'),
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
		$criteria->compare('text',$this->text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the list key value
	 */
	public static function listData()
	{
		return CHtml::listData(CActiveRecord::model(__CLASS__)->findAll(),'id','text');
	}
}