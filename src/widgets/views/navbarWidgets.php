<?php
use yii\helpers\Url;
use modava\log\LogModule;

?>
<ul class="nav nav-tabs nav-sm nav-light mb-25">
    <li class="nav-item mb-5">
        <a class="nav-link link-icon-left<?php if (Yii::$app->controller->id == 'system-log') echo ' active' ?>"
           href="<?= Url::toRoute(['/log/system-log']); ?>">
            <i class="ion ion-ios-locate"></i><?= LogModule::t('log', 'System Log'); ?>
        </a>
    </li>
    <li class="nav-item mb-5">
        <a class="nav-link link-icon-left<?php if (Yii::$app->controller->id == 'voip24h-log') echo ' active' ?>"
           href="<?= Url::toRoute(['/log/voip24h-log']); ?>">
            <i class="ion ion-ios-locate"></i><?= LogModule::t('log', 'Voip24h Log'); ?>
        </a>
    </li>
</ul>
