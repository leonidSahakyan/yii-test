<?php

namespace console\models;

use Yii;

/**
 * This is the model class for table "store_product".
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $product_image
 */
class StoreProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['product_image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'product_image' => 'Product Image',
        ];
    }
}
