<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\banner\common\helpers;

use Yii;
use ymaker\banner\common\components\FileManagerInterface;

/**
 * Helper for banner images.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class ImageHelper
{
    /**
     * @var FileManagerInterface
     */
    private static $_fileManager;


    /**
     * Returns URL to image.
     *
     * @param string $fileName
     * @return string
     */
    public static function getUrl($fileName)
    {
        if (self::$_fileManager === null) {
            self::$_fileManager = Yii::$container->get(FileManagerInterface::class);
        }
        return self::$_fileManager->getImageUrl($fileName);
    }
}
