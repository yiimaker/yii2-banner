<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use ymaker\banner\backend\helpers\LanguageHelper;
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
            <h1><?= BannerModule::t('Create banner') ?></h1>
        </div>
        <div class="clearfix"></div>
        <hr>
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
            <?= $form->field($model, 'slug') ?>
            <?php foreach (LanguageHelper::getLocales() as $language): ?>
                <?php $translation = $model->getTranslation($language) ?>
                <?= $form->field($translation, 'content')->textarea() ?>
                <?= $form->field($translation, 'hint') ?>
                <?= $form->field($translation, 'imageFile')->fileInput() ?>
                <?= $form->field($translation, 'alt') ?>
            <?php endforeach ?>
            <?= $form->field($model, 'published')->checkbox() ?>
            <?= Html::submitButton(
                BannerModule::t('Create'),
                ['class' => 'btn btn-success']
            ) ?>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
