<?php

/**
 * This is the model class for table "voucher".
 *
 * The followings are the available columns in table 'voucher':
 * @property string $kode_voucher
 * @property string $jenis
 * @property integer $nominal
 * @property string $masa_berlaku
 */
class Voucher extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Voucher the static model class
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
		return 'voucher';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kategori,persentase,kode_voucher,jenis,nominal,masa_berlaku', 'required'),
			array('kode_voucher', 'unique'),
			array('nominal', 'numerical', 'integerOnly'=>true),
			array('kode_voucher, jenis', 'length', 'max'=>100),
			array('masa_berlaku', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('kode_voucher, jenis, nominal, masa_berlaku', 'safe', 'on'=>'search'),
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
			'kode_voucher' => 'Kode Voucher',
			'jenis' => 'Jenis',
			'nominal' => 'Nominal',
			'masa_berlaku' => 'Masa Berlaku',
			'kategori' => 'Event/kategori',
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

		$criteria->compare('kode_voucher',$this->kode_voucher,true);
		$criteria->compare('jenis',$this->jenis,true);
		$criteria->compare('nominal',$this->nominal);
		$criteria->compare('masa_berlaku',$this->masa_berlaku,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}