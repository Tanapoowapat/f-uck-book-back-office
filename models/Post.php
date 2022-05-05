<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property string $id
 * @property string|null $title
 * @property string|null $message
 * @property string|null $image
 * @property int|null $like
 * @property string $owner_post
 * @property string|null $create_time
 * @property string|null $update_time
 *
 * @property Comment[] $comments
 * @property Users $ownerPost
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'owner_post'], 'required'],
            [['id', 'message', 'image', 'owner_post'], 'string'],
            [['like'], 'default', 'value' => null],
            [['like'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['title'], 'string', 'max' => 128],
            [['id'], 'unique'],
            [['owner_post'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['owner_post' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'message' => 'Message',
            'image' => 'Image',
            'like' => 'Like',
            'owner_post' => 'Owner Post',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }

    /**
     * Gets query for [[OwnerPost]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOwnerPost()
    {
        return $this->hasOne(Users::className(), ['id' => 'owner_post']);
    }
}
