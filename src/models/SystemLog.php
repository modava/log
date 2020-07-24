<?php

namespace modava\log\models;

use common\helpers\MyHelper;
use common\models\User;
use modava\log\LogModule;
use modava\log\models\table\SystemLogTable;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "system_log".
 *
 * @property int $id
 * @property int $level
 * @property string $category
 * @property double $log_time
 * @property string $prefix
 * @property string $message
 */
class SystemLog extends SystemLogTable
{
    public $toastr_key = 'system-log';

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['level'], 'integer'],
            [['log_time'], 'number'],
            [['prefix', 'message'], 'string'],
            [['category'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => LogModule::t('log', 'ID'),
            'level' => LogModule::t('log', 'Level'),
            'category' => LogModule::t('log', 'Category'),
            'log_time' => LogModule::t('log', 'Log Time'),
            'prefix' => LogModule::t('log', 'Prefix'),
            'message' => LogModule::t('log', 'Message'),
        ];
    }


}
