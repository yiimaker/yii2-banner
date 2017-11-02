<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\banner\tests\unit\backend\services;

use yii\data\ActiveDataProvider;
use ymaker\banner\backend\models\entities\Banner;
use ymaker\banner\backend\models\entities\BannerTranslation;
use ymaker\banner\backend\services\BannerService;
use ymaker\banner\backend\services\BannerServiceInterface;
use ymaker\banner\tests\mocks\FileManagerMock;
use ymaker\banner\tests\unit\DbTestCase;
use ymaker\banner\tests\fixtures\BannerTranslationFixture;

/**
 * Test case for banner service.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class BannerServiceTest extends DbTestCase
{
    /**
     * @var BannerService
     */
    protected $service;


    /**
     * @inheritdoc
     */
    public function fixtures()
    {
        return [BannerTranslationFixture::class];
    }

    /**
     * @inheritdoc
     */
    protected function _before()
    {
        parent::_before();
        $this->service = new BannerService(new FileManagerMock());
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf(
            BannerServiceInterface::class,
            $this->service
        );
    }

    public function testGetDataProvider()
    {
        $this->testInstanceOf(ActiveDataProvider::class, $this->service->getDataProvider());
    }

    public function testGetModelNewInstance()
    {
        $model = $this->service->getModel();

        $this->assertInstanceOf(Banner::class, $model);
        $this->assertTrue($model->getIsNewRecord());
    }

    public function testGetModelFromDb()
    {
        $model = $this->service->getModel(1);

        $this->assertInstanceOf(Banner::class, $model);
        $this->assertFalse($model->getIsNewRecord());
    }

    /**
     * @expectedException \yii\web\NotFoundHttpException
     */
    public function testGetModelException()
    {
        $this->service->getModel(999);
    }

    public function testSave()
    {
        $bannerData = ['slug' => 'save-test'];
        $bannerDataEn = [
            'language' => 'en',
            'content' => 'save test content',
            'hint' => 'save test hint',
            'file_name' => 'save test file name',
            'alt' => 'save test alt',
        ];
        $bannerDataRu = [
            'language' => 'ru',
            'content' => 'тест сохранения контента',
            'hint' => 'тест сохранения подсказки',
            'file_name' => 'тест сохранения имени файла',
            'alt' => 'тест сохранения альт аттрибута',
        ];

        $data = [
            'Banner' => $bannerData,
            'BannerTranslation' => [
                'en' => $bannerDataEn,
                'ru' => $bannerDataRu,
            ],
        ];
        $this->service->getModel();
        $res = $this->service->save($data);

        $this->assertTrue($res);
        $this->tester->seeRecord(Banner::class, $bannerData);
        $this->tester->seeRecord(BannerTranslation::class, $bannerDataEn);
        $this->tester->seeRecord(BannerTranslation::class, $bannerDataRu);
    }

    public function testDelete()
    {
        $res = $this->service->delete(1);

        $this->assertTrue($res);
        $this->tester->dontSeeRecord(Banner::class, ['slug' => 'test-banner']);
    }

    /**
     * @expectedException \yii\web\NotFoundHttpException
     */
    public function testDeleteException()
    {
        $this->service->delete(999);
    }
}
