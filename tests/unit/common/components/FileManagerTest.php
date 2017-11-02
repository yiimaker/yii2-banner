<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\banner\tests\unit\common\components;

use Yii;
use ymaker\banner\common\components\FileManager;
use ymaker\banner\common\components\FileManagerInterface;
use ymaker\banner\tests\unit\TestCase;

/**
 * Test case for file manager component.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class FileManagerTest extends TestCase
{
    /**
     * @var FileManager
     */
    protected $fileManager;


    /**
     * @inheritdoc
     */
    protected function _before()
    {
        $this->fileManager = new FileManager([
            'filesRoot' => '@data/files',
            'filesBaseUrl' => '/url/to'
        ]);
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf(
            FileManagerInterface::class,
            $this->fileManager
        );
    }

    public function testInit()
    {
        $alias = '@tests/_output/test_dir';
        new FileManager(['filesRoot' => $alias]);

        $this->assertFileExists(Yii::getAlias('@tests/_output/test_dir'));
    }

    public function testGenerateFileName()
    {
        $actual = $this->fileManager->generateFileName('jpg');

        $this->assertInternalType('string', $actual);
        $this->assertRegExp('/[a-z0-9\.]\.jpg/', $actual);
    }

    public function testGetImgSrc()
    {
        $expected = Yii::getAlias('@data/files/img.jpg');
        $actual = $this->fileManager->getImageSrc('img.jpg');

        $this->assertEquals($expected, $actual);
    }

    public function testGetImgUrl()
    {
        $expected = '/url/to/img.png';
        $actual = $this->fileManager->getImageUrl('img.png');

        $this->assertEquals($expected, $actual);
    }

    public function testDeleteFile()
    {
        $fileName = Yii::getAlias('@data/files/minimalism.jpg');
        $backFileName = Yii::getAlias('@data/files/minimalism.jpg.back');

        copy($fileName, $backFileName);

        $this->assertTrue($this->fileManager->deleteFile('minimalism.jpg'));
        $this->assertFileNotExists($fileName);

        copy($backFileName, $fileName);
        unlink($backFileName);
    }
}
