<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\banner\frontend\widgets;

use yii\base\InvalidConfigException;
use yii\base\Widget;
use ymaker\banner\common\models\entities\Banner as BannerEntity;

/**
 * Renders banner by slug.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class Banner extends Widget
{
    /**
     * @var string
     */
    protected $slug;
    /**
     * @var bool If set `true` - views counter will be updated.
     */
    protected $countViews = true;
    /**
     * @var BannerEntity|null
     */
    protected $model;


    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @param bool $countViews
     */
    public function setCountViews($countViews)
    {
        $this->countViews = $countViews;
    }

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        if (empty($this->slug)) {
            throw new InvalidConfigException('You should set a slug');
        }

        $this->model = BannerEntity::find()
            ->where([
                'slug' => $this->slug,
                'published' => true,
            ])
            ->with(['translations'])
            ->one();

        parent::init();
    }

    /**
     * @inheritdoc
     * @return string|null
     */
    public function run()
    {
        if (empty($this->model)) {
            return null;
        }
        if ($this->countViews) {
            $this->model->incrementViewsCounter();
        }

        return $this->render('banner', [
            'model' => $this->model,
        ]);
    }
}
