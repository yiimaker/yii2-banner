<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\banner\backend\services;

/**
 * Interface of banner service.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
interface BannerServiceInterface
{
    /**
     * Returns data provider.
     *
     * @return \yii\data\ActiveDataProvider
     */
    public function getDataProvider();

    /**
     * Returns model instance.
     *
     * @param null|int $id
     * @return \yii\db\ActiveRecord
     */
    public function getModel($id = null);

    /**
     * Save record.
     *
     * @param array $data
     * @return bool
     */
    public function save(array $data);

    /**
     * Removes record.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id);
}
