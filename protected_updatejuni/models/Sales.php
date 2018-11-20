<?php

/**
 * This is the model class for table "sales".
 *
 * The followings are the available columns in table 'sales':
 * @property string $id
 * @property string $date
 * @property integer $customer_id
 * @property integer $sale_sub_total
 * @property integer $sale_discount
 * @property integer $sale_service
 * @property integer $sale_tax
 * @property integer $sale_total_cost
 * @property integer $sale_payment
 * @property integer $paidwith_id
 * @property integer $total_items
 * @property integer $branch
 * @property integer $user_id
 * @property integer $table
 * @property string $comment
 * @property integer $status
 */
class Sales extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Sales the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function payment() {
        return array( 'BCA' => 'BCA', 'MANDIRI' => 'MANDIRI', 'NIAGA' => 'NIAGA');
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sales';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('customer_id, sale_sub_total, sale_discount, sale_service, sale_tax, sale_total_cost, sale_payment, paidwith_id, total_items, branch, user_id, status', 'required'),
            array('customer_id, sale_sub_total, sale_discount, sale_service, sale_tax, sale_total_cost, sale_payment, paidwith_id, total_items, branch, user_id, status', 'numerical', 'integerOnly' => true),
            array('comment', 'length', 'max' => 200),
            array('date', 'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'insert'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, date, customer_id, sale_sub_total, sale_discount, sale_service, sale_tax, sale_total_cost, sale_payment, paidwith_id, total_items, branch, user_id, table, comment, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
			'user'=>array(self::BELONGS_TO,'users','inserter'),
			'branch'=>array(self::BELONGS_TO,'Branch','branch'),
			'sales_items'=>array(self::HAS_MANY,'SalesItems','id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'date' => 'Date',
            'customer_id' => 'Customer',
            'sale_sub_total' => 'Sale Sub Total',
            'sale_discount' => 'Sale Discount',
            'sale_service' => 'Sale Service',
            'sale_tax' => 'Sale Tax',
            'sale_total_cost' => 'Sale Total Cost',
            'sale_payment' => 'Sale Payment',
            'paidwith_id' => 'Paidwith',
            'total_items' => 'Total Items',
            'branch' => 'Branch',
            'user_id' => 'User',
            'table' => 'Table',
            'comment' => 'Comment',
            'status' => 'Status',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
		
        $criteria->condition = "status=:status";
        $criteria->params = array("status" => 1);
        
        $criteria->compare('id', $this->id, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('customer_id', $this->customer_id);
        $criteria->compare('sale_sub_total', $this->sale_sub_total);
        $criteria->compare('sale_discount', $this->sale_discount);
        $criteria->compare('sale_service', $this->sale_service);
        $criteria->compare('sale_tax', $this->sale_tax);
        $criteria->compare('sale_total_cost', $this->sale_total_cost);
        $criteria->compare('sale_payment', $this->sale_payment);
        $criteria->compare('paidwith_id', $this->paidwith_id);
        $criteria->compare('total_items', $this->total_items);
        $criteria->compare('branch', $this->branch);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('table', $this->table);
        $criteria->compare('comment', $this->comment, true);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}