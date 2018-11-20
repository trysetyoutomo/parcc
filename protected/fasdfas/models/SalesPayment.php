<?php

/**
 * This is the model class for table "sales_payment".
 *
 * The followings are the available columns in table 'sales_payment':
 * @property integer $id
 * @property integer $cash
 * @property integer $voucher
 * @property integer $compliment
 * @property integer $edc_bca
 * @property integer $edc_niaga
 * @property integer $dll
 */
class SalesPayment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SalesPayment the static model class
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
		return 'sales_payment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('id, cash, voucher, compliment, edc_bca, edc_niaga, dll', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cash, voucher, compliment, edc_bca, edc_niaga, dll', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'cash' => 'Cash',
			'voucher' => 'Voucher',
			'compliment' => 'Compliment',
			'edc_bca' => 'Edc Bca',
			'edc_niaga' => 'Edc Niaga',
			'dll' => 'Dll',
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
		$criteria->compare('cash',$this->cash);
		$criteria->compare('voucher',$this->voucher);
		$criteria->compare('compliment',$this->compliment);
		$criteria->compare('edc_bca',$this->edc_bca);
		$criteria->compare('edc_niaga',$this->edc_niaga);
		$criteria->compare('dll',$this->dll);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}