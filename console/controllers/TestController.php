<?php
namespace console\controllers;

use console\helpers\ImageHelper;
use console\models\Product;
use console\models\StoreProduct;

class TestController extends \yii\console\Controller
{
    public static function actionGenerateMiniature($size, $watermarked = 'false', $catalogOnly = 'true')
    {
        $model = Product::find();

        if ($catalogOnly === 'true') {
            $model = $model
                ->joinWith('store')
                ->where(StoreProduct::tableName() . '.id is not null');
        }

        $model = $model
            ->orderBy('id')
            ->all();

        $success = 0;
        $error = 0;
        $generateFunction = $watermarked === 'true' ? 'generateWatermarkedMiniature' : 'generateMiniature';
        $output = [];
        $arr = explode(",", $size);

        foreach ($arr as $item) {
            array_push($output, explode("x", $item));
        }

        try {
            foreach ($model as $item) {
                ImageHelper::$generateFunction($item->image, $output);
                $success++;
            }
        } catch (\Exception $e) {
            $error++;
        }

        echo 'Success - ' . $success . PHP_EOL;
        echo 'Error - ' . $error;
    }
}
