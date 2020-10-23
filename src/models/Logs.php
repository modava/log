<?php

namespace modava\log\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;
use common\models\UserProfile;
use yii\db\Exception;

/**
 * This is the model class for table "logs".
 *
 * @property int $id
 * @property string $table_name
 * @property int $action 0: Create, 1: Update, 2: Delete
 * @property array $data
 * @property int $created_at
 * @property int $created_by
 */
class Logs extends \yii\db\ActiveRecord
{
    const NONE_ACTION = 0;
    const ACTION_CREATE = 1;
    const ACTION_UPDATE = 2;
    const ACTION_DELETE = 3;
    const ACTION = [
        self::NONE_ACTION => 'Chưa xác định',
        self::ACTION_CREATE => 'Tạo mới',
        self::ACTION_UPDATE => 'Cập nhật',
        self::ACTION_DELETE => 'Xóa',
    ];

    public static function tableName()
    {
        return 'logs';
    }

    public function behaviors()
    {
        return [
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['table_name', 'action', 'data'], 'required'],
            [['action', 'created_at', 'created_by'], 'integer'],
            [['data'], 'safe'],
            [['table_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'table_name' => Yii::t('backend', 'Table Name'),
            'action' => Yii::t('backend', 'Action'),
            'data' => Yii::t('backend', 'Data'),
            'created_at' => Yii::t('backend', 'Created At'),
            'created_by' => Yii::t('backend', 'Created By'),
        ];
    }

    public function getUserCreatedBy($id)
    {
        if ($id == null)
            return null;
        $user = UserProfile::find()->where(['user_id' => $id])->one();
        return $user;
    }

    public static function quickCreate($table_name = null, $action = null, $data = null)
    {
        if ($action != null && !array_key_exists($action, self::ACTION)) $action = self::NONE_ACTION;
        $attributes = [
            'table_name' => $table_name,
            'action' => $action,
            'data' => $data,
            'created_at' => time(),
            'created_by' => Yii::$app->user->id
        ];
        try {
            $logs = new self();
            $logs->setAttributes($attributes);
            if (!$logs->save()) {
                Yii::warning('Lưu log thao tác thất bại. User "' . Yii::$app->user->id . '" "' . self::ACTION[$action] . '" dữ liệu table "' . $table_name . '". Dữ liệu: ' . json_encode($data, JSON_UNESCAPED_UNICODE));
                return false;
            }
            return true;
        } catch (Exception $ex) {
            Yii::warning('Lưu log thao tác thất bại. User "' . Yii::$app->user->id . '" "' . self::ACTION[$action] . '" dữ liệu table "' . $table_name . '". Dữ liệu: ' . json_encode($data, JSON_UNESCAPED_UNICODE) . '. Lỗi hệ thống: ' . $ex->getMessage());
            return false;
        }
    }
}
