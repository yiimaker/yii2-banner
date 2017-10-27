<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\banner\common\components;

/**
 * Interface of file manager for work with image files.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
interface FileManagerInterface
{
    /**
     * Generates filename.
     *
     * @param string $extension File extension.
     * @return string
     */
    public function generateFilename($extension);

    /**
     * Returns source of image.
     *
     * @param string $fileName
     * @return string
     */
    public function getImageSrc($fileName);

    /**
     * Returns URL to image.
     *
     * @param string $fileName
     * @return string
     */
    public function getImageUrl($fileName);

    /**
     * Delete file from file system.
     *
     * @param string $fileName
     * @return bool
     */
    public function deleteFile($fileName);
}
