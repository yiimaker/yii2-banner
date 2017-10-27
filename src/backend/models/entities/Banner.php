<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\banner\backend\models\entities;

use yii\behaviors\TimestampBehavior;
use ymaker\banner\backend\Module as BannerModule;
use ymaker\banner\common\models\entities\Banner as CommonBanner;

/**
 * This is the model class for table "{{%banner}}".
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class Banner extends CommonBanner
{
    /**
     * @inheritdoc
     */
    public static function find()
    {
        return parent::find()->with('translations');
    }

    /**
     * @inheritdoc
     */
    public function loadDefaultValues($skipIfSet = true)
    {
        $this->slug = 'banner-' . (self::find()->count() + 1);
        return parent::loadDefaultValues($skipIfSet);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['timestamp'] = TimestampBehavior::class;
        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['slug', 'required'],
            ['slug', 'unique'],
            ['slug', 'string', 'max' => 255],

            ['published', 'boolean'],
            ['published', 'default', 'value' => true],

            ['views_count', 'integer'],
            ['views_count', 'default', 'value' => 0],

            [['create_at', 'updated_at'], 'safe'],

            [['valid_from', 'valid_until'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'slug'          => BannerModule::t('Slug'),
            'views_count'   => BannerModule::t('Views count'),
            'published'     => BannerModule::t('Published'),
            'created_at'    => BannerModule::t('Created at'),
            'updated_at'    => BannerModule::t('Updated at'),
            'valid_from'    => BannerModule::t('Valid from'),
            'valid_until'   => BannerModule::t('Valid until'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * @inheritdoc
     */
    public function getTranslations()
    {
        return $this->hasMany(BannerTranslation::class, ['banner_id' => 'id']);
    }
}
