<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\banner\common\models\entities;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%banner_translation}}".
 *
 * @property int $id
 * @property int $banner_id
 * @property string $language
 * @property string $content
 * @property string $hint
 * @property string $file_name
 * @property string $alt
 * @property string $link
 *
 * @property Banner $banner
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class BannerTranslation extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%banner_translation}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanner()
    {
        return $this->hasOne(Banner::class, ['id' => 'banner_id']);
    }
}
