<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "book".
 *
 * @property integer $id
 * @property string $name
 * @property integer $date_create
 * @property integer $date_update
 * @property integer $date_release
 * @property integer $author_id
 * @property string $preview
 *
 * @property Author $author
 */
class Book extends ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'author_id'], 'required'],
            [['date_create', 'date_update', 'author_id'], 'integer'],
            [['name'], 'string', 'max' => 161],
            [['preview'], 'string', 'max' => 255],
            [['date_release'], 'safe'],
//            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'date_release' => 'Date Release',
            'author_id' => 'Author ID',
            'preview' => 'Preview',
        ];
    }
    
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'createdAtAttribute' => 'date_create',
                'updatedAtAttribute' => 'date_update',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date_create', 'date_update'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date_update'],
                ],
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }
    
    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->date_release = \Yii::$app->formatter->asDate($this->date_release, 'php:U');
            $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
            if ($this->imageFile) {
                $name = md5(microtime());
                $this->imageFile->saveAs(\Yii::getAlias('@webroot') . '/uploads/' . $name . '.' . $this->imageFile->extension);
                $this->preview = $name . '.' . $this->imageFile->extension;
            }
            return true;
        } else {
            return false;
        }
    }
    
    public function getImageurl()
    {
        return \Yii::getAlias('@webroot') . '/uploads/' . $this->preview;
    }
    
    public function getAuthorName()
    {
        $author = $this->getAuthor()->one();
        return $author->first_name . ' ' . $author->last_name;
    }
}
