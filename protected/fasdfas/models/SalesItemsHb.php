<?php

/**
 * This is the model class for table "sales_items".
 *
 * The followings are the available columns in table 'sales_items':
 * @property integer $id
 * @property integer $sale_id
 * @property integer $item_id
 * @property integer $quantity_purchased
 * @property integer $item_tax
 * @property integer $item_price
 * @property integer $item_discount
 * @property integer $item_total_cost
 */
class SalesItemsHb extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SalesItems the static model class
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
		return 'sales_items_hb';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sale_id, item_id, quantity_purchased, item_tax, item_price, item_discount, item_total_cost', 'required'),
			array('sale_id, item_id, quantity_purchased, item_tax, item_price, item_discount, item_total_cost', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sale_id, item_id, quantity_purchased, item_tax, item_price, item_discount, item_total_cost', 'safe', 'on'=>'search'),
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
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('quantity_purchased',$this->quantity_purchased);
		$criteria->compare('item_tax',$this->item_tax);
		$criteria->compare('item_price',$this->item_price);
		$criteria->compare('item_discount',$this->item_discount);
		$criteria->compare('item_total_cost',$this->item_total_cost);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}