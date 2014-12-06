<?php

/**
 * This is the model class for table "home_recent_post".
 *
 * The followings are the available columns in table 'home_recent_post':
 * @property integer $id
 * @property integer $blog_posts_id
 * @property integer $orden_id
 */
class HomeRecentPost extends BaseHomeRecentPost
{
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array_merge(parent::rules(),array(
		));
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array_merge(parent::relations(),array(
			'post'=>array(self::BELONGS_TO,'BlogPosts','blog_posts_id'),
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(),array(
		));
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TestTest the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getTitlePost()
	{
		return $this->post->title;
	}

}
