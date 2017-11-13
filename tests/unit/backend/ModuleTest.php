<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\banner\tests\unit\backend;

use Yii;
use motion\i18n\ConfigLanguageProvider;
use motion\i18n\LanguageProviderInterface;
use ymaker\banner\backend\Module;
use ymaker\banner\backend\services\BannerService;
use ymaker\banner\backend\services\BannerServiceInterface;
use ymaker\banner\tests\unit\TestCase;

/**
 * Test case for backend module.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class ModuleTest extends TestCase
{
    /**
     * @expectedException \yii\base\InvalidConfigException
     */
    public function testInitException()
    {
        new Module('banner');
    }

    public function testRegisterDependencies()
    {
        new Module('banner', null, [
            'languageProvider' => [
                'class' => ConfigLanguageProvider::class,
                'languages' => true,
                'defaultLanguage' => true,
            ],
        ]);

        $this->assertInstanceOf(
            LanguageProviderInterface::class,
            Yii::$container->get(LanguageProviderInterface::class)
        );
        $this->assertInstanceOf(
            BannerService::class,
            Yii::$container->get(BannerServiceInterface::class)
        );
    }
}
