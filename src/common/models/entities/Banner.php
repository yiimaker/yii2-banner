<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\banner\common\models\entities;

use yii\db\ActiveRecord;
use creocoder\translateable\TranslateableBehavior;

/**
 * This is the model class for table "{{%banner}}".
 *
 * @property int $id
 * @property string $slug
 * @property bool $published
 * @property int $views_count
 * @property int $created_at
 * @property int $updated_at
 * @property string $valid_from
 * @property string $valid_until
 *
 * @property BannerTranslation[] $translations
 * @property string $content
 * @property string $file_name
 * @property string $alt
 *
 * @method BannerTranslation getTranslation($language = null)
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class Banner extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%banner}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'translateable' => [
                'class' => TranslateableBehavior::class,
                'translationAttributes' => $this->getTranslationAttributes(),
            ],
        ];
    }

    /**
     * Returns list of translation attributes.
     *
     * @return string[]
     */
    public function getTranslationAttributes()
    {
        return [
            'content',
            'hint',
            'alt',
            'file_name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(BannerTranslation::class, ['banner_id' => 'id']);
    }
}
