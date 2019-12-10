<?php

namespace console\helpers;

use yii\base\Exception;
use yii\helpers\Url;
use yii\imagine\Image;

class ImageHelper
{
    public static function generateMiniature($path, array $size)
    {
        try {
            $imgPath = Url::to("@runtime/images/");
            $originFile = $imgPath . $path;

            // Generate a thumbnail image
            for ($i = 0; $i < count($size); $i++) {
                if (isset($size[$i][1])) {
                    $thumbFile = $imgPath . explode(".", $path)[0] . '-thumb-' . $size[$i][0] . 'x' . $size[$i][1] . '.' . explode(".", $path)[1];
                    Image::resize($originFile, $size[$i][0], $size[$i][1], true, true)->save($thumbFile, ['quality' => 80]);
                } else {
                    $thumbFile = $imgPath . explode(".", $path)[0] . '-thumb-' . $size[$i][0] . 'x' . $size[$i][0] . '.' . explode(".", $path)[1];
                    Image::resize($originFile, $size[$i][0], $size[$i][0], true, true)->save($thumbFile, ['quality' => 80]);
                }
            }

            return $thumbFile ?? '';
        } catch (\Exception $exception) {
            throw new Exception('Something went wrong');
        }
    }

    public static function generateWatermarkedMiniature($path, array $size)
    {
        try {
            $imgPath = Url::to("@runtime/images/");
            $originFile = $imgPath . $path;
            $watermarkImage = Url::to("@runtime/images/watermark.png");

            // Generate a thumbnail image
            for ($i = 0; $i < count($size); $i++) {
                if (isset($size[$i][1])) {
                    $thumbFile = $imgPath . explode(".", $path)[0] . '-thumb-' . $size[$i][0] . 'x' . $size[$i][1] . '.' . explode(".", $path)[1];
                    Image::resize($originFile, $size[$i][0], $size[$i][1])->save($thumbFile, ['quality' => 80]);
                    Image::watermark($thumbFile, Image::resize($watermarkImage, $size[$i][0] / 10, $size[$i][0] / 10))->save($thumbFile, ['quality' => 80]);
                } else {
                    $thumbFile = $imgPath . explode(".", $path)[0] . '-thumb-' . $size[$i][0] . 'x' . $size[$i][0] . '.' . explode(".", $path)[1];
                    Image::resize($originFile, $size[$i][0], $size[$i][0])->save($thumbFile, ['quality' => 80]);
                    Image::watermark($thumbFile, Image::resize($watermarkImage, $size[$i][0] / 10, $size[$i][0] / 10))->save($thumbFile, ['quality' => 80]);
                }
            }

            return $thumbFile ?? '';
        } catch (\Exception $exception) {
            throw new Exception('Something went wrong');
        }
    }
}
