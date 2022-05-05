<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cart".
 *
 * @property string $id
 * @property string $owner_cart
 * @property string $product_id
 *
 * @property Users $ownerCart
 * @property Products $product
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'owner_cart', 'product_id'], 'required'],
            [['id', 'owner_cart', 'product_id'], 'string'],
            [['id'], 'unique'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['owner_cart'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['owner_cart' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'owner_cart' => 'Owner Cart',
            'product_id' => 'Product ID',
        ];
    }

    /**
     * Gets query for [[OwnerCart]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOwnerCart()
    {
        return $this->hasOne(Users::className(), ['id' => 'owner_cart']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }
}
