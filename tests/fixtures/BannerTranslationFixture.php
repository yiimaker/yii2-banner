<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\banner\tests\fixtures;

use yii\test\ActiveFixture;
use ymaker\banner\common\models\entities\BannerTranslation;

/**
 * Fixture for banner translation entity.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class BannerTranslationFixture extends ActiveFixture
{
    /**
     * @inheritdoc
     */
    public $modelClass = BannerTranslation::class;
    /**
     * @inheritdoc
     */
    public $dataFile = '@data/banner-translation.php';
    /**
     * @inheritdoc
     */
    public $depends = [BannerFixture::class];
}
