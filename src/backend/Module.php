<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\banner\backend;

use Yii;
use yii\base\InvalidConfigException;
use motion\i18n\LanguageProviderInterface;
use ymaker\banner\backend\services\BannerService;
use ymaker\banner\backend\services\BannerServiceInterface;
use ymaker\banner\common\components\FileManager;
use ymaker\banner\common\components\FileManagerInterface;

/**
 * Backend banner module definition class.
 *
 * @property \motion\i18n\LanguageProviderInterface $languageProvider
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'ymaker\banner\backend\controllers';

    /**
     * @var \motion\i18n\LanguageProviderInterface
     */
    private $_languageProvider;
    /**
     * @var FileManagerInterface
     */
    private $_fileManager;
    /**
     * @var BannerServiceInterface
     */
    private $_service;


    /**
     * @param array $providerConfig
     */
    public function setLanguageProvider(array $providerConfig)
    {
        $this->_languageProvider = $providerConfig;
    }

    /**
     * @param array $fileManagerConfig
     */
    public function setFileManager(array $fileManagerConfig)
    {
        $this->_fileManager = $fileManagerConfig;
    }

    /**
     * @param BannerServiceInterface $service
     */
    public function setService($service)
    {
        $this->_service = $service;
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (empty($this->_languageProvider)) {
            throw new InvalidConfigException('You should configure language provider');
        }
        if (empty($this->_fileManager)) {
            $this->_fileManager = ['class' => FileManager::class];
        }
        if (empty($this->_service)) {
            $this->_service = ['class' => BannerService::class];
        }

        $this->registerDependencies();
    }

    /**
     * Register dependencies in container.
     */
    protected function registerDependencies()
    {
        Yii::$container->setDefinitions([
            LanguageProviderInterface::class => $this->_languageProvider,
            FileManagerInterface::class => $this->_fileManager,
            BannerServiceInterface::class => $this->_service,
        ]);
    }

    /**
     * Wrapper for `Yii::t()`.
     *
     * @param string $message
     * @param array $params
     * @param null|string $language
     * @return string
     */
    public static function t($message, $params = [], $language = null)
    {
        return Yii::t('back/banner', $message, $params, $language);
    }
}
