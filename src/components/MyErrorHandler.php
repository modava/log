<?php
namespace modava\log\components;

class MyErrorHandler extends \yii\web\ErrorHandler
{
    public $errorView = '@modava/log/views/error/error.php';

}
