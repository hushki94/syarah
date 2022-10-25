<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int|null $category_id
 * @property string|null $title
 * @property string|null $body
 * @property int|null $price
 * @property string|null $image
 *
 * @property Category $category
 */
class Product extends \yii\db\ActiveRecord
{

    /**
     * @var \yii\web\UploadedFile
     */
    public $imageFile;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => function() {
                    return date('Y-m-d H:i:s');
                },
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'price'], 'integer'],
            [['created_at', 'updated_at'], 'datetime'],
            [['body'], 'string'],
            [['imageFile'] , 'image' , 'extensions' => 'png ,jpg , jpeg' , 'maxSize' => 5*1024*1024],
            [['title', 'image'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'title' => Yii::t('app', 'Title'),
            'body' => Yii::t('app', 'Body'),
            'price' => Yii::t('app', 'Price'),
            'image' => Yii::t('app', 'Image'),
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if($this->imageFile){
            $this->image = Yii::$app->security->generateRandomString(20)."/".$this->imageFile->name;
        }

        $transaction = Yii::$app->db->beginTransaction();

        $saved = parent::save($runValidation,$attributeNames);

        if($saved && $this->imageFile){
            $fullPath = Yii::getAlias('@frontend/web/storage/products/'.$this->image);
            $dir = dirname($fullPath);
            if(!FileHelper::createDirectory($dir) || !$this->imageFile->saveAs($fullPath)){
                $transaction->rollBack();
                return false;
            }
        }
        
        
        $transaction->commit();
        return $saved;
    }


    public function getImageUrl()
    {

        return self::formatImageUrl($this->image);
       
    }

    public static function formatImageUrl($imagePath)
    {

        if($imagePath){
            return Yii::$app->params['frontendUrl'].'/storage/products/'.$imagePath;

        }
        return 'https://www.generationsforpeace.org/wp-content/uploads/2018/03/empty.jpg';
    }
}
