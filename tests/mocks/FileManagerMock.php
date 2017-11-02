<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\banner\tests\mocks;

use ymaker\banner\common\components\FileManagerInterface;

/**
 * Mock of file manager component.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class FileManagerMock implements FileManagerInterface
{

    /**
     * @inheritdoc
     */
    public function generateFilename($extension)
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getImageSrc($fileName)
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getImageUrl($fileName)
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function deleteFile($fileName)
    {
        return null;
    }
}
