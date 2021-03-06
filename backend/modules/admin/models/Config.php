<?php

namespace backend\modules\admin\models;

use Yii;

use common\behaviors\TimestampBehavior;
use common\behaviors\BlameableBehavior;
use common\behaviors\DeleteBehavior;

/**
 * This is the model class for table "config".
 *
 * @property integer $config_id
 * @property integer $application_id
 * @property string $key
 * @property string $value
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 */
class Config extends \yii\db\ActiveRecord
{

    /**
     * behaviour to add created_at and updatet_at field with current datetime (timestamp)
     * and created_by and updated_by field with current user id (blameable)
     */
    public function behaviors(){
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sysx_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['application_id', 'key'], 'required'],
            [['application_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['key'], 'string', 'max' => 100],
            [['key'], 'checkSemiUnique', 'on' => 'add_config'],
            [['value'], 'string', 'max' => 255],
            [['created_by', 'updated_by'], 'string', 'max' => 45]
        ];
    }

    /**
     * ensure the key is unique for each application
     */
    public function checkSemiUnique($attribute, $params){
        if (!$this->hasErrors()) {
            $config = Config::find()->where('`key` = :key AND application_id = :apid', [':key' => $this->key, ":apid" => $this->application_id])->one();
            if ($config !== null) {
                $this->addError($attribute, 'Key telah digunakan, pilih key yang lain !!');
            }
        }
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'config_id' => 'Config ID',
            'application_id' => 'Application ID',
            'key' => 'Key',
            'value' => 'Value',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplication()
    {
        return $this->hasOne(Application::className(), ['application_id' => 'application_id']);
    }

}
