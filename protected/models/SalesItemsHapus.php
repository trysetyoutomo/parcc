<?php

/**
 * This is the model class for table "sales_items_hapus".
 *
 * The followings are the available columns in table 'sales_items_hapus':
 * @property integer $id
 * @property integer $siid
 * @property integer $sale_id
 * @property integer $item_id
 * @property integer $quantity_purchased
 * @property double $item_tax
 * @property double $item_price
 * @property double $item_discount
 * @property double $item_total_cost
 * @property double $item_service
 * @property string $permintaan
 * @property integer $cetak
 * @property string $author_add
 * @property string $author_edit
 * @property string $author_delete
 * @property string $datetime_add
 * @property string $datetime_edit
 * @property string $datetime_delete
 */
class SalesItemsHapus extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sales_items_hapus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('siid, sale_id, item_id, quantity_purchased, item_tax, item_price, item_discount, item_total_cost, item_service', 'required'),
			array('siid, sale_id, item_id, quantity_purchased, cetak', 'numerical', 'integerOnly'=>true),
			array('item_tax, item_price, item_discount, item_total_cost, item_service', 'numerical'),
			array('permintaan', 'length', 'max'=>500),
			array('author_add, author_edit, author_delete', 'length', 'max'=>50),
			array('datetime_add, datetime_edit, datetime_delete', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, siid, sale_id, item_id, quantity_purchased, item_tax, item_price, item_discount, item_total_cost, item_service, permintaan, cetak, author_add, author_edit, author_delete, datetime_add, datetime_edit, datetime_delete', 'safe', 'on'=>'search'),
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
			'siid' => 'Siid',
			'sale_id' => 'Sale',
			'item_id' => 'Item',
			'quantity_purchased' => 'Quantity Purchased',
			'item_tax' => 'Item Tax',
			'item_price' => 'Item Price',
			'item_discount' => 'Item Discount',
			'item_total_cost' => 'Item Total Cost',
			'item_service' => 'Item Service',
			'permintaan' => 'Permintaan',
			'cetak' => 'Cetak',
			'author_add' => 'Author Add',
			'author_edit' => 'Author Edit',
			'author_delete' => 'Author Delete',
			'datetime_add' => 'Datetime Add',
			'datetime_edit' => 'Datetime Edit',
			'datetime_delete' => 'Datetime Delete',
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
		$criteria->compare('siid',$this->siid);
		$criteria->compare('sale_id',$this->sale_id);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('quantity_purchased',$this->quantity_purchased);
		$criteria->compare('item_tax',$this->item_tax);
		$criteria->compare('item_price',$this->item_price);
		$criteria->compare('item_discount',$this->item_discount);
		$criteria->compare('item_total_cost',$this->item_total_cost);
		$criteria->compare('item_service',$this->item_service);
		$criteria->compare('permintaan',$this->permintaan,true);
		$criteria->compare('cetak',$this->cetak);
		$criteria->compare('author_add',$this->author_add,true);
		$criteria->compare('author_edit',$this->author_edit,true);
		$criteria->compare('author_delete',$this->author_delete,true);
		$criteria->compare('datetime_add',$this->datetime_add,true);
		$criteria->compare('datetime_edit',$this->datetime_edit,true);
		$criteria->compare('datetime_delete',$this->datetime_delete,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SalesItemsHapus the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
