<?php

/**
 * This is the model class for table "accounts".
 *
 * The followings are the available columns in table 'accounts':
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $contract_number
 * @property char $active
 * @property integer $active_date
 * @property integer $active_dealer
 * @property string $birth_date //datetime
 * @property integer $operator_id
 * @property string $first_login //datetime
 * @property string $blz //??
 * @property string $conto //??
 * @property string $bic //??
 * @property string $iban //??
 * @property string $gender 
 * @property string $organization
 * @property string $org_number
 * @property string $street
 * @property string $district
 * @property string $zip
 * @property string $city
 * @property integer $country_id
 * @property string $federal
 * @property string $phone
 * @property string $fax
 * @property string $create_account //datetime
 * @property string $owner
 * @property string $bankName
 * @property string $pass
 * @property string $passNew
 * @property string $recoverykey
 * @property string $activate_date //datetime
 * @property string $deactivate_date //datetime
 * @property integer $test_duration
 * @property string $external_id
 * @property string $last_update //timestamp
 * @property string $EditSequence //???
 * @property string $comments //TEXT
 * @property double $bonuses  
 * @property double $credit_limit
 * @property string $bilingRefresh //datetime
 * 
 * 
 * The followings are the available model relations:
 * @property User[] $users
 */
 
class Account extends CActiveRecord
{
    const ON  = 1;
    const OFF = 0;    

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
		return 'iptv_Accounts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('contract_number, active_date, birth_date, ', 'default', 'value'=>NULL),
            array('last_update', 'default', 'value'=> new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'update'),
            array('create_account', 'default', 'value'=> new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
            array('email', 'email'),            
            array('active', 'in', 'range' => array('0', '1'), 'allowEmpty' => false),            
            array('gender', 'in', 'range' => array('male', 'female'), 'allowEmpty' => false),            
            array('allow_sync', 'in', 'range' => array('y', 'n'), 'allowEmpty' => true),            
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, active, contract_number, name, surname, email, first_login', 'safe', 'on'=>'search'),
		);
	}
    
    public function behaviors() {
        return array(
            'restore-state'=>array(
                'class'=>'PersistGridStateBehavior',
                'defaultSorting' => 'id DESC',
        ));
    }    

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'users' => array(self::HAS_MANY, 'User', 'account_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => _('ID'),
			'active' => Yii::t('main', 'Is Active'),
            'name' => Yii::t('main', 'First name'),
			'surname' => Yii::t('main', 'Last name'),
            'contract_number' => Yii::t('main', 'Contract'),
			'email' => Yii::t('main', 'Email'),
            'pass' => Yii::t('main', 'Password'),
            'passNew' => Yii::t('main', 'New password'),
			'first_login' => Yii::t('main', 'First login'),
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
        $criteria->compare('active',$this->active);
        $criteria->compare('name',$this->name, true);
        $criteria->compare('surname',$this->surname, true);
        $criteria->compare('contract_number',$this->contract_number, true);
		$criteria->compare('first_login',$this->first_login, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination' => array('pageSize' => 10),
		));
	}

    static public function setActive($id, $active) {
      $account = Account::model()->findByPk($id);
      $account->active = $active ? self::ON : self::OFF;
      $account->save(true, array('active'));
    }
}