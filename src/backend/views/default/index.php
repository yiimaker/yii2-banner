<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use ymaker\banner\backend\Module as BannerModule;

/**
 * View file used by default controller.
 *
 * @var \yii\web\View $this
 * @var \yii\data\ActiveDataProvider $dataProvider
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */

\yii\bootstrap\BootstrapAsset::register($this);
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1><?= BannerModule::t('Banners list') ?></h1>
        </div>
        <div class="clearfix"></div>
        <hr>
        <div class="col-md-12">
            <?= Html::a(BannerModule::t('create'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="clearfix"></div>
        <hr>
        <div class="col-md-12">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => SerialColumn::class],
                    'slug',
                    'hint',
                    'published:boolean',
                    'created_at:datetime',
                    ['class' => ActionColumn::class],
                ],
            ]) ?>
        </div>
    </div>
</div>
