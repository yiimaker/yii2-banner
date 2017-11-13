<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\banner\tests\unit\frontend\widgets;

use ymaker\banner\common\models\entities\Banner;
use ymaker\banner\frontend\widgets\Banner as BannerWidget;
use ymaker\banner\tests\fixtures\BannerFixture;
use ymaker\banner\tests\unit\DbTestCase;

/**
 * Test case for banner widget.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
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

    /**
     * @expectedException \yii\base\InvalidConfigException
     */
    public function testInitException()
    {
        new BannerWidget();
    }

    public function testRunNotFoundModel()
    {
        $widget = new BannerWidget(['slug' => 'not exists']);
        $this->assertNull($widget->run());
    }

    public function testIncrementViewsCounter()
    {
        $model = Banner::findOne(1);
        $this->assertEquals(0, $model->views_count);

        (new BannerWidget(['slug' => 'test-banner']))->run();

        $model = Banner::findOne(1);
        $this->assertEquals(1, $model->views_count);
    }
}
