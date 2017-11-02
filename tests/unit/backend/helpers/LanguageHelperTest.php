<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\banner\tests\unit\backend\helpers;

use Yii;
use motion\i18n\ConfigLanguageProvider;
use motion\i18n\LanguageProviderInterface;
use ymaker\banner\backend\helpers\LanguageHelper;
use ymaker\banner\tests\unit\TestCase;

/**
 * Test case for language helper.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class LanguageHelperTest extends TestCase
{
    /**
     * @inheritdoc
     */
    protected function _before()
    {
        Yii::$container->set(LanguageProviderInterface::class, [
            'class' => ConfigLanguageProvider::class,
            'languages' => [
                [
                    'label' => 'eng',
                    'locale' => 'en',
                ],
                [
                    'label' => 'rus',
                    'locale' => 'ru',
                ],
            ],
            'defaultLanguage' => [
                'label' => 'eng',
                'locale' => 'en',
            ],
        ]);
    }

    public function testGetLocales()
    {
        $expected = ['en', 'ru'];
        $actual = LanguageHelper::getLocales();

        $this->assertEquals($expected, $actual);
    }
}
