<?php

/**
 * This is the model class for table "iptv_dealers".
 *
 * The followings are the available columns in table 'iptv_dealers':
 * @property integer $id
 * @property integer $account_id
 * @property string $register
 * @property string $tax_number
 * @property string $value_added_tax_number
 * @property string $customs_number
 * @property string $register_city
 * @property string $city
 * @property integer $country_id
 * @property integer $street
 * 
 *
 * The followings are the available model relations:
 * @property Account $account
 * @property Country $country
 */
class Dealer extends CActiveRecord
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
        return 'iptv_dealers';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('register, tax_numbervalue_added_tax_number', 'safe'),   
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
            'country' => array(self::HAS_ONE, 'Country', 'country_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('main', 'ID'),
            'account_id' => Yii::t('main','Account ID'),
            'register'=> Yii::t('main','Register'),
            'tax_number' => Yii::t('main','Tax Number'),
            'value_added_tax_number'=> Yii::t('main','Added Tax Number'),
            'customs_number' => Yii::t('main','Customs Number'),
            'register_city'=> Yii::t('main','Register City'),
            'city'=> Yii::t('main','City'),
            'country_id'=> Yii::t('main','Country ID'),
            'street'=> Yii::t('main','Street'),
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
?>  
?>
