<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documents_sector_overview".
 *
 * @property int $id
 * @property int $documents_id
 * @property int $sector_overview_id
 *
 * @property Documents $documents
 * @property SectorOverview $sectorOverview
 */
class DocumentsSectorOverview extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documents_sector_overview';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['documents_id', 'sector_overview_id'], 'required'],
            [['documents_id', 'sector_overview_id'], 'integer'],
            [['documents_id'], 'exist', 'skipOnError' => true, 'targetClass' => Documents::className(), 'targetAttribute' => ['documents_id' => 'id']],
            [['sector_overview_id'], 'exist', 'skipOnError' => true, 'targetClass' => SectorOverview::className(), 'targetAttribute' => ['sector_overview_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'documents_id' => 'Documents ID',
            'sector_overview_id' => 'Sector Overview ID',
        ];
    }

    /**
     * Gets query for [[Documents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasOne(Documents::className(), ['id' => 'documents_id']);
    }

    /**
     * Gets query for [[SectorOverview]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSectorOverview()
    {
        return $this->hasOne(SectorOverview::className(), ['id' => 'sector_overview_id']);
    }
}
