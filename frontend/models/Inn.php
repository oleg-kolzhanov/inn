<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * Модель для таблицы "inn".
 *
 * @property int $id
 * @property string $value ИНН
 * @property bool $status Статус
 * @property string $message Сообщение
 * @property int|null $created_at Дата и время создания записми
 * @property int|null $updated_at Дата и время обновления записи
 */
class Inn extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inn';
    }

    /**
     * {@inheritdoc}
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value', 'status', 'message'], 'required'],
            [['status'], 'boolean'],
            [['created_at', 'updated_at'], 'default', 'value' => null],
            [['created_at', 'updated_at'], 'integer'],
            [['value'], 'string', 'max' => 12],
            [['message'], 'string', 'max' => 255],
            [['value'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'ИНН',
            'status' => 'Статус',
            'message' => 'Сообщение',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    public function isOutdated() {
        return true;
    }
}
