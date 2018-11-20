<?php

/**
 * This is the model class for table "netoutlet".
 *
 * The followings are the available columns in table 'netoutlet':
 * @property integer $id
 * @property integer $sale_id
 * @property string $date
 * @property integer $kode_outlet
 * @property double $net_item_outlet
 * @property double $net_item_comp
 */
class Netoutlet extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Netoutlet the static model class
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
		return 'netoutlet';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('net_item_comp', 'required'),
			array('sale_id, kode_outlet', 'numerical', 'integerOnly'=>true),
			array('net_item_outlet, net_item_comp', 'numerical'),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sale_id, date, kode_outlet, net_item_outlet, net_item_comp', 'safe', 'on'=>'search'),
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
			'sale_id' => 'Sale',
			'date' => 'Date',
			'kode_outlet' => 'Kode Outlet',
			'net_item_outlet' => 'Net Item Outlet',
			'net_item_comp' => 'Net Item Comp',
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
		$criteria->compare('sale_id',$this->sale_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('kode_outlet',$this->kode_outlet);
		$criteria->compare('net_item_outlet',$this->net_item_outlet);
		$criteria->compare('net_item_comp',$this->net_item_comp);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}