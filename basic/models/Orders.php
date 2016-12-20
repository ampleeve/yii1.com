<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $orderID
 * @property integer $customerID
 * @property integer $productID
 * @property integer $count
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderID', 'customerID', 'productID', 'count'], 'required'],
            [['orderID', 'customerID', 'productID', 'count'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orderID' => 'Order ID',
            'customerID' => 'Customer ID',
            'productID' => 'Product ID',
            'count' => 'Count',
        ];
    }
}
