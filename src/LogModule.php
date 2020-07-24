<?php

namespace modava\log;

use yii\base\BootstrapInterface;
use Yii;
use yii\base\Event;
use \yii\base\Module;
use yii\web\Application;
use yii\web\Controller;

/**
 * log module definition class
 */
class LogModule extends Module implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'modava\log\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        // custom initialization code goes here
        $this->registerTranslations();
        parent::init();
        Yii::configure($this, require(__DIR__ . '/config/log.php'));
        $handler = $this->get('errorHandler');
        Yii::$app->set('errorHandler', $handler);
        $handler->register();
        $this->layout = 'log';
    }



    public function bootstrap($app)
    {
        $app->on(Application::EVENT_BEFORE_ACTION, function () {

        });
        Event::on(Controller::class, Controller::EVENT_BEFORE_ACTION, function (Event $event) {
            $controller = $event->sender;
        });
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['log/messages/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => '@modava/log/messages',
            'fileMap' => [
                'log/messages/log' => 'log.php',
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('log/messages/' . $category, $message, $params, $language);
    }
}
