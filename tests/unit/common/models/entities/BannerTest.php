<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\banner\tests\unit\common\models\entities;

use ymaker\banner\common\models\entities\Banner;
use ymaker\banner\tests\fixtures\BannerFixture;
use ymaker\banner\tests\unit\DbTestCase;

/**
 * Test case for banner entity.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class BannerTest extends DbTestCase
{
    /**
     * @inheritdoc
     */
    public function fixtures()
    {
        return [BannerFixture::class];
    }

    public function testIncrementViewsCounter()
    {
        $banner = Banner::findOne(1);

        $banner->incrementViewsCounter();
        $this->tester->seeRecord(Banner::class, [
            'id' => 1,
            'views_count' => 1,
        ]);

        $banner->incrementViewsCounter();
        $this->tester->seeRecord(Banner::class, [
            'id' => 1,
            'views_count' => 2,
        ]);
    }
}
