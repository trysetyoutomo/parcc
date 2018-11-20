<?php

/**
 * This is the model class for table "spoile".
 *
 * The followings are the available columns in table 'spoile':
 * @property integer $id
 * @property integer $sale_id
 * @property integer $item_id
 * @property integer $quantity_purchased
 * @property double $item_tax
 * @property double $item_price
 * @property double $item_discount
 * @property double $item_total_cost
 * @property double $item_service
 */
class Spoile extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'spoile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, sale_id, item_id, quantity_purchased, item_tax, item_price, item_discount, item_total_cost, item_service', 'required'),
			array('id, sale_id, item_id, quantity_purchased', 'numerical', 'integerOnly'=>true),
			array('item_tax, item_price, item_discount, item_total_cost, item_service', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sale_id, item_id, quantity_purchased, item_tax, item_price, item_discount, item_total_cost, item_service', 'safe', 'on'=>'search'),
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
			'item_id' => 'Item',
			'quantity_purchased' => 'Quantity Purchased',
			'item_tax' => 'Item Tax',
			'item_price' => 'Item Price',
			'item_discount' => 'Item Discount',
			'item_total_cost' => 'Item Total Cost',
			'item_service' => 'Item Service',
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
		$criteria->compare('sale_id',$this->sale_id);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('quantity_purchased',$this->quantity_purchased);
		$criteria->compare('item_tax',$this->item_tax);
		$criteria->compare('item_price',$this->item_price);
		$criteria->compare('item_discount',$this->item_discount);
		$criteria->compare('item_total_cost',$this->item_total_cost);
		$criteria->compare('item_service',$this->item_service);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Spoile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
