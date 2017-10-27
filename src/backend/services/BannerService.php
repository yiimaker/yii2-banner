<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\banner\backend\services;

use Yii;
use yii\base\Object;
use yii\data\ActiveDataProvider;
use yii\db\Connection;
use yii\di\Instance;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use ymaker\banner\backend\exceptions\FileUploadException;
use ymaker\banner\backend\models\entities\Banner;
use ymaker\banner\backend\models\entities\BannerTranslation;
use ymaker\banner\backend\Module;
use ymaker\banner\common\components\FileManager;

/**
 * Service for banner.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class BannerService extends Object implements BannerServiceInterface
{
    /**
     * @var string|array|Connection
     */
    private $_db = 'db';
    /**
     * @var FileManager
     */
    private $_fileManager;
    /**
     * @var Banner
     */
    private $_model;


    /**
     * @inheritdoc
     * @param FileManager $fileManager
     */
    public function __construct(FileManager $fileManager, $config = [])
    {
        $this->_fileManager = $fileManager;
        parent::__construct($config);
    }

    /**
     * @param string|array|Connection $db
     */
    public function setDb($db)
    {
        $this->_db = $db;
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->_db = Instance::ensure($this->_db, Connection::class);
    }

    /**
     * @return \yii\data\ActiveDataProvider
     */
    public function getDataProvider()
    {
        return new ActiveDataProvider([
            'db' => $this->_db,
            'query' => Banner::find()->with('translations'),
        ]);
    }

    /**
     * @param int $id
     * @return Banner
     * @throws NotFoundHttpException
     */
    private function findModel($id)
    {
        if ($model = Banner::findOne($id)) {
            return $model;
        }
        throw new NotFoundHttpException();
    }

    /**
     * Returns primary model object.
     *
     * @param null|int $id
     * @return Banner
     * @throws NotFoundHttpException
     */
    public function getModel($id = null)
    {
        if ($id == null) {
            $model = new Banner();
            $model->loadDefaultValues();
            $this->_model = $model;
        } else {
            $this->_model = $this->findModel($id);
        }

        return $this->_model;
    }

    /**
     * Save uploaded file to file system.
     *
     * @param BannerTranslation $model
     * @return string
     * @throws FileUploadException
     */
    private function saveUploadedFile($model)
    {
        $uploadedFile = UploadedFile::getInstance($model, 'imageFile');
        if ($uploadedFile === null) {
            return $model->file_name;
        }

        $fileName = $this->_fileManager->generateFileName($uploadedFile->extension);
        if ($uploadedFile->saveAs($this->_fileManager->getImageSrc($fileName))) {
            if (!$model->getIsNewRecord()) {
                $this->_fileManager->deleteFile($model->file_name);
            }
            return $fileName;
        }

        throw new FileUploadException('Error code #' . $uploadedFile->error);
    }

    /**
     * Save data to database.
     *
     * @param array $data
     * @return bool
     */
    protected function save(array $data)
    {
        if (!$this->_model->load($data)) {
            Yii::trace('Cannot load data to primary model', 'yii2-banner');
        } else {
            try {
                foreach ($data[BannerTranslation::internalFormName()] as $language => $dataSet) {
                    $model = $this->_model->getTranslation($language);
                    $model->file_name = $this->saveUploadedFile($model);
                    foreach ($dataSet as $attribute => $translation) {
                        $model->$attribute = $translation;
                    }
                }
                return $this->_model->save();
            } catch (\Exception $ex) {
                Yii::trace($ex, 'yii2-banner');
            }
        }

        return false;
    }

    /**
     * Creates banner.
     *
     * @param array $data
     * @return bool
     */
    public function create(array $data)
    {
        return $this->save($data);
    }

    /**
     * Updates banner.
     *
     * @param array $data
     * @return bool
     */
    public function update(array $data)
    {
        return (bool)$this->save($data);
    }

    /**
     * Removes banner.
     *
     * @param int $id
     * @return bool
     * @throws NotFoundHttpException
     */
    public function delete($id)
    {
        $model = $this->findModel($id);
        foreach ($model->translations as $translation) {
            if (!$this->_fileManager->deleteFile($translation->file_name)) {
                Yii::trace('Cannot delete "' . $translation->file_name . '" file', 'yii2-banner');
            }
        }
        return $model->delete();
    }
}
