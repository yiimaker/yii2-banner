<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\banner\common\components;

use Yii;
use yii\base\Object;
use yii\helpers\FileHelper;

/**
 * File manager for work with image files.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class FileManager extends Object implements FileManagerInterface
{
    /**
     * Path to catalog where you store uploaded files.
     *
     * @var string
     */
    protected $filesRoot = '@webroot/uploads/banners';
    /**
     * URL of uploaded files catalog.
     *
     * @var string
     */
    protected $filesBaseUrl = '@web/uploads/banners';


    /**
     * @param $filesRoot
     */
    public function setFilesRoot($filesRoot)
    {
        $this->filesRoot =$filesRoot;
    }

    /**
     * @param $filesBaseUrl
     */
    public function setFilesBaseUrl($filesBaseUrl)
    {
        $this->filesBaseUrl = $filesBaseUrl;
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        $filesRoot = Yii::getAlias($this->filesRoot);
        if (!file_exists($filesRoot)) {
            FileHelper::createDirectory($filesRoot);
        }
    }

    /**
     * @inheritdoc
     */
    public function generateFileName($extension)
    {
        $fileName = '';
        while (true) {
            $fileName = uniqid('', true) . '.' . $extension;
            if (!file_exists($this->getImageSrc($fileName))) {
                break;
            }
        }
        return $fileName;
    }

    /**
     * @inheritdoc
     */
    public function getImageSrc($fileName)
    {
        return Yii::getAlias($this->filesRoot . '/' . $fileName);
    }

    /**
     * @inheritdoc
     */
    public function getImageUrl($fileName)
    {
        return Yii::getAlias($this->filesBaseUrl . '/' . $fileName);
    }

    /**
     * @inheritdoc
     */
    public function deleteFile($fileName)
    {
        $file = $this->getImageSrc($fileName);
        return file_exists($file) ? unlink($file) : false;
    }
}
