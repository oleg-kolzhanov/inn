<?php

namespace frontend\models;

use Yii;

/**
 * Модель для таблицы "inn".
 *
 * @property int $id
 * @property string $value инн
 * @property int|null $created_at дата и время создания записми
 * @property int|null $updated_at дата и время обновления записи
 */
class Inn extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%inn}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'required'],
            [['created_at', 'updated_at'], 'default', 'value' => null],
            [['created_at', 'updated_at'], 'integer'],
            [['value'], 'string', 'max' => 12],
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
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }
}
