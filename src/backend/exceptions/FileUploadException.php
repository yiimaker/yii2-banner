<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\banner\backend\exceptions;

use yii\base\Exception;

/**
 * File upload exception.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class FileUploadException extends Exception
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'File upload exception';
    }
}
