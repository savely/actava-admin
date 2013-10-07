<?php

/**
 * This is the model class for table "STBs".
 *
 * The followings are the available columns in table 'STBs':
 * @property integer $id
 * @property string $mac
 * @property intefer $stb_type_id
 * @property char $fw_auto_upgrade
 * @property string $fw_last_check //datetime
 * @property string $comment
 * 
 *
 * The followings are the available model relations:
 * @property StbType $stbtype
 */
class Stb extends CActiveRecord
{
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'iptv_stb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('fw_auto_upgrade', 'in', 'range' => array('0', '1'), 'allowEmpty' => false),   
            array('login', 'unique'),   
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
			'stbtype' => array(self::BELONGS_TO, 'StbType', 'stb_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => __('ID'),
			'account_id' => __('Account'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination' => array('pageSize' => 10),
		));
	}
}