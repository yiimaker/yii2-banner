<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

use ymaker\banner\backend\helpers\ImageHelper;

/**
 * View file used by banner widget.
 *
 * @var \yii\web\View $this
 * @var \ymaker\banner\common\models\entities\Banner $model
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
?>
<div>
    <img src="<?= ImageHelper::getUrl($model->file_name) ?>" alt="<?= $model->alt ?>" width="200">
<?php if (!empty($model->content)): ?>
    <p><?= $model->content ?></p>
<?php endif ?>
</div>
