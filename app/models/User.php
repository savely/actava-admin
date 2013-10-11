<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property integer $account_id
 * @property integer $software_id //??
 * @property string $login 
 * @property string $pass
 * @property integer $rating_id
 * @property string $ip_addr
 * @property integer $stb_id //FK??
 * @property integer $skin_id //??
 * @property integer $residence_id //??
 * @property integer $timezone 
 * @property string $options
 * @property string $channel_offset
 * @property char $use_tvcategory
 * @property char $vodmain_output
 * @property integer $last_channel
 * @property integer $volume
 * @property integer $buffering_time
 * @property integer $alfaLevel
 * @property integer $lang_id
 * @property string $sig_pult
 * @property string $channel_pass
 * @property string $dest_player
 * @property string $portal
 * @property integer $collocation_id
 * @property string $request
 * @property string $http
 * @property string $effect
 * @property string $aspect
 * 
 * 
 *
 * The followings are the available model relations:
 * @property Lang $lang
 * @property Account $account
 * @property Stb $stb
 */
class User extends CActiveRecord
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
		return 'iptv_Users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('use_tvcategory', 'in', 'range' => array('y', 'n'), 'allowEmpty' => false),   
            array('use_tvcategory', 'default', 'value' =>  'n'),   
            array('vodmain_output', 'in', 'range' => array('text', 'images'), 'allowEmpty' => false),   
            array('vodmain_output', 'default', 'value' =>  'images'),   
            array('volume', 'default', 'value' =>  30),   
            array('buffering_time', 'default', 'value' =>  3),   
            array('alfaLevel', 'default', 'value' =>  90),   
            array('lang_id', 'default', 'value' =>  1),   
            array('sig_pult', 'in', 'range' => array('gray', 'black'), 'allowEmpty' => true),               
            array('dest_player', 'in', 'range' => array('both', 'stb', 'pcclient'), 'allowEmpty' => false),   
            array('dest_player', 'default', 'value' =>  'both'),            
            array('portal', 'in', 'range' => array('normal', 'simple'), 'allowEmpty' => false),   
            array('portal', 'default', 'value' =>  'normal'),            
            array('request', 'in', 'range' => array('full', 'on_request'), 'allowEmpty' => false),   
            array('request', 'default', 'value' =>  'full'),            
            array('http', 'in', 'range' => array('http', 'udp'), 'allowEmpty' => false),   
            array('effect', 'in', 'range' => array('y', 'n'), 'allowEmpty' => false),   
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
            'account' => array(self::BELONGS_TO, 'Account', 'account_id'),
            'lang' => array(self::HAS_ONE, 'Lang', 'lang_id'),
			'stb' => array(self::HAS_ONE, 'Stb', 'stb_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('main','ID'),
			'account_id' => Yii::t('main','Account'),
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
                        'pagination' => array('pageSize' => 100),
		));
	}
}
?>