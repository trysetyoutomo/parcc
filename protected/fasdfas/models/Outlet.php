<?php

/**
 * This is the model class for table "outlet".
 *
 * The followings are the available columns in table 'outlet':
 * @property integer $kode_outlet
 * @property string $nama_outlet
 * @property string $nama_owner
 * @property string $jenis_outlet
 * @property integer $persentase_hasil
 * @property integer $status
 */
class Outlet extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Outlet the static model class
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
		return 'outlet';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kode_outlet, persentase_hasil', 'numerical', 'integerOnly'=>true),
			array('nama_outlet, jenis_outlet', 'length', 'max'=>30),
			array('nama_owner', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('kode_outlet, nama_outlet, nama_owner, jenis_outlet, persentase_hasil, status', 'safe', 'on'=>'search'),
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
			'kode_outlet' => 'Kode Outlet',
			'nama_outlet' => 'Nama Outlet',
			'nama_owner' => 'Nama Owner',
			'jenis_outlet' => 'Jenis Outlet',
			'persentase_hasil' => 'Persentase Hasil',
			'status' => 'Status',
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

		$criteria->compare('kode_outlet',$this->kode_outlet);
		$criteria->compare('nama_outlet',$this->nama_outlet,true);
		$criteria->compare('nama_owner',$this->nama_owner,true);
		$criteria->compare('jenis_outlet',$this->jenis_outlet,true);
		$criteria->compare('persentase_hasil',$this->persentase_hasil);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}