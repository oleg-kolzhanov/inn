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
     * Период актуальности данных в БД.
     */
    const OUTDATED_PERIOD = '1 day';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inn';
    }

    /**
     * {@inheritdoc}
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

    /**
     * Проверка на актуальность данных в БД.
     * @return bool
     */
    public function isOutdated() {
        $outdated =  strtotime('+' . self::OUTDATED_PERIOD, $this->updated_at);
        $now = time();
        return ($outdated < $now);
    }
}
