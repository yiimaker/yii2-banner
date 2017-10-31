<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\banner\backend\models\entities;

use ymaker\banner\backend\Module as BannerModule;
use ymaker\banner\common\models\entities\BannerTranslation as CommonBannerTranslation;

/**
 * This is the model class for table "{{%banner_translation}}".
 * 
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class BannerTranslation extends CommonBannerTranslation
{
    /**
     * @var \yii\web\UploadedFile
     */
    public $imageFile;


    /**
     * @inheritdoc
     */
    public function formName()
    {
        return parent::formName() . '[' . $this->language . ']';
    }

    /**
     * Returns internal form name.
     *
     * @return string
     */
    public static function internalFormName()
    {
        $reflector = new \ReflectionClass(self::class);
        return $reflector->getShortName();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['banner_id', 'safe'],

            ['language', 'safe'],

            ['content', 'string'],

            ['hint', 'string', 'max' => 255],

            ['file_name', 'string', 'max' => 255],

            ['alt', 'string', 'max' => 255],

            ['link', 'string', 'max' => 255],
            ['link', 'default', 'value' => '#'],

            ['imageFile', 'file', 'extensions' => 'png, jpg, gif, svg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $labels = [
            'content'   => BannerModule::t('Content'),
            'hint'      => BannerModule::t('Hint'),
            'alt'       => BannerModule::t('Alt'),
            'link'      => BannerModule::t('Link'),
            'imageFile' => BannerModule::t('Banner image'),
        ];

        foreach ($labels as $key => $label) {
            $labels[$key] = $this->addLabelPostfix($label);
        }

        return $labels;
    }

    /**
     * Adds prefix to label.
     *
     * @param string $label
     * @return string
     */
    protected function addLabelPostfix($label)
    {
        return $label . ' [' . $this->language . ']';
    }
}
