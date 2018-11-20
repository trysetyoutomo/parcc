<?php

/**
 * This is the model class for table "items".
 *
 * The followings are the available columns in table 'items':
 * @property integer $id
 * @property string $item_name
 * @property string $item_number
 * @property string $description
 * @property integer $category_id
 * @property integer $unit_price
 * @property integer $tax_percent
 * @property integer $total_cost
 * @property integer $discount
 * @property string $image
 * @property integer $status
 */
class Items extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Items the static model class
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
		return 'items';
	}

	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kode_outlet,item_name, item_number, description, category_id, unit_price, total_cost, discount, status', 'required'),
			array('category_id, unit_price, tax_percent, total_cost, discount, status', 'numerical', 'integerOnly'=>true),
			array('item_name', 'length', 'max'=>30),
			array('item_number', 'length', 'max'=>20),
			array('image', 'length', 'max'=>80),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, item_name, item_number, description, category_id, unit_price, tax_percent, total_cost, discount, image, status', 'safe', 'on'=>'search'),
		);
	}
	
	public function data_items()
	{
		$model=Items::model()->with('outlet')->findAll(
		array(
		'select'=>'kode_outlet,item_name',)
		);
                $data = array();
                foreach ($model as $item)
                {
                    $temp = array();
                    $data[$item->id] = $item->outlet->status." ".$item->item_name;
                }
                return $data;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'outlet'=>array(self::BELONGS_TO,'outlet','kode_outlet'),
			'categories'=>array(self::BELONGS_TO,'categories','id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'item_name' => 'Item Name',
			'item_number' => 'Item Number',
			'description' => 'Description',
			'category_id' => 'Category',
			'unit_price' => 'Unit Price',
			'tax_percent' => 'Tax Percent',
			'total_cost' => 'Total Cost',
			'discount' => 'Discount',
			'image' => 'Image',
			'status' => 'Status',
			'kode_outlet' => 'kode outlet',
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
		$criteria->compare('item_name',$this->item_name,true);
		$criteria->compare('item_number',$this->item_number,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('unit_price',$this->unit_price);
		$criteria->compare('tax_percent',$this->tax_percent);
		$criteria->compare('total_cost',$this->total_cost);
		$criteria->compare('discount',$this->discount);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('kode_outlet',$this->kode_outlet);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}