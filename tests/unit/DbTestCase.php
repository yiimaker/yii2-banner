<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\banner\tests\unit;

use yii\test\FixtureTrait;

/**
 * Base test case with fixtures support.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class DbTestCase extends TestCase
{
    use FixtureTrait;

    /**
     * @inheritdoc
     */
    protected function _before()
    {
        $this->loadFixtures();
    }

    /**
     * @inheritdoc
     */
    public function _after()
    {
        $this->unloadFixtures();
    }

    /**
     * @inheritdoc
     */
    public function fixtures()
    {
        return [];
    }
}
