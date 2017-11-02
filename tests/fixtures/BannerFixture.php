<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\banner\tests\fixtures;

use yii\test\ActiveFixture;
use ymaker\banner\common\models\entities\Banner;

/**
 * Fixture for banner entity.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class BannerFixture extends ActiveFixture
{
    /**
     * @inheritdoc
     */
    public $modelClass = Banner::class;
    /**
     * @inheritdoc
     */
    public $dataFile = '@data/banner.php';
}
