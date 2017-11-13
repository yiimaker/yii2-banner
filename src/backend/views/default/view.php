<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

use yii\helpers\Html;
use yii\widgets\DetailView;
use ymaker\banner\common\helpers\ImageHelper;
use ymaker\banner\backend\models\entities\Banner;
use ymaker\banner\backend\Module as BannerModule;

/**
 * View file used by default controller.
 *
 * @var \yii\web\View $this
 * @var \ymaker\banner\backend\models\entities\Banner $model
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */

\yii\bootstrap\BootstrapAsset::register($this);
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>
                <?= BannerModule::t('Banner: {slug}', [
                    'slug' => $model->slug,
                ]) ?>
            </h1>
            <div class="alert alert-warning">
                <?= $model->hint ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <hr>
        <div class="col-md-12">
            <?= Html::a(
                BannerModule::t('Update'),
                ['update', 'id' => $model->id],
                ['class' => 'btn btn-warning']
            ) ?>
            <?= Html::a(
                BannerModule::t('Delete'),
                ['delete', 'id' => $model->id],
                ['class' => 'btn btn-danger']
            ) ?>
        </div>
        <div class="clearfix"></div>
        <hr>
        <div class="col-md-12">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'slug',
                    'content',
                    'link:url',
                    [
                        'attribute' => 'file_name',
                        'label' => BannerModule::t('Banner image'),
                        'format' => 'html',
                        'value' => function (Banner $model) {
                            return Html::img(ImageHelper::getUrl($model->file_name), ['width' => 300]);
                        }
                    ],
                    'alt',
                    [
                        'attribute' => 'valid_from',
                        'format' => ['date', 'y-M-dd'],
                    ],
                    [
                        'attribute' => 'valid_until',
                        'format' => ['date', 'y-M-dd'],
                    ],
                    'views_count',
                    'valid_from:datetime',
                    'valid_until:datetime',
                    'published:boolean',
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ]) ?>
        </div>
    </div>
</div>
