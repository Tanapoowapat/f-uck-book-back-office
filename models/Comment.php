<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property string $id
 * @property string $post_id
 * @property string $owner_comment
 * @property string|null $message
 * @property int|null $like
 * @property string|null $create_time
 * @property string|null $update_time
 *
 * @property Users $ownerComment
 * @property Post $post
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'post_id', 'owner_comment'], 'required'],
            [['id', 'post_id', 'owner_comment', 'message'], 'string'],
            [['like'], 'default', 'value' => null],
            [['like'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['id'], 'unique'],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['owner_comment'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['owner_comment' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'owner_comment' => 'Owner Comment',
            'message' => 'Message',
            'like' => 'Like',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }

    /**
     * Gets query for [[OwnerComment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOwnerComment()
    {
        return $this->hasOne(Users::className(), ['id' => 'owner_comment']);
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }
}
