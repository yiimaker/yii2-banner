<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\banner\backend\controllers;

use Yii;
use yii\web\Controller;
use ymaker\banner\backend\services\BannerServiceInterface;

/**
 * Default controller for backend banner module.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class DefaultController extends Controller
{
    /**
     * @var BannerServiceInterface
     */
    private $_service;


    /**
     * @inheritdoc
     * @param BannerServiceInterface $service
     */
    public function __construct($id, $module, BannerServiceInterface $service, $config = [])
    {
        $this->_service = $service;
        parent::__construct($id, $module, $config);
    }

    /**
     * Renders banners list.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'dataProvider' => $this->_service->getDataProvider(),
        ]);
    }

    /**
     * Creates new banner.
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        return $this->commonAction($this->redirect(['index']), 'index');
    }

    /**
     * Updates banner.
     *
     * @param int $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        return $this->commonAction($this->redirect(['view', 'id' => $id]), 'update');
    }

    /**
     * Common code for create and update actions.
     *
     * @param \yii\web\Response $redirect
     * @param string $view
     * @return string|\yii\web\Response
     */
    protected function commonAction($redirect, $view)
    {
        $model = $this->_service->getModel();
        $request = Yii::$app->getRequest();
        if ($request->getIsPost() && $this->_service->save($request->post())) {
            return $redirect;
        }

        return $this->render($view, compact('model'));
    }

    /**
     * Renders details about banner.
     *
     * @param int $id Banner model ID.
     * @return string
     */
    public function actionView($id)
    {
        $model = $this->_service->getModel($id);
        return $this->render('view', compact('model'));
    }

    /**
     * Delete banner.
     *
     * @param int $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
        $message = 'Error: banner not removed';
        if ($this->_service->delete($id)) {
            $message = 'Removed successfully';
        }
        Yii::$app->getSession()->setFlash('yii2-banner', $message);

        return $this->redirect(['index']);
    }
}
