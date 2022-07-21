<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sector_overview".
 *
 * @property int $id
 * @property string $name
 *
 * @property DocumentsSectorOverview[] $documentsSectorOverviews
 * @property string                    $info
 */
class SectorOverview extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sector_overview';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 64],
            [['info'], 'string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'info' => 'Info'
        ];
    }

    /**
     * Gets query for [[DocumentsSectorOverviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentsSectorOverviews()
    {
        return $this->hasMany(DocumentsSectorOverview::className(), ['sector_overview_id' => 'id']);
    }
}
