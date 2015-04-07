<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;


/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $slug
 *
 * @property Category $parent
 * @property Category[] $categories
 * @property Product[] $products
 */
class Category extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'slug'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'default', 'value' => null],
            [['parent_id'], 'integer'],
            [['parent_id'], 'validateParent'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * Validates the parent_id
     * You cannot move it to the child item or current item itself.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateParent($attribute, $params)
    {
        if ($this->parent_id && !$this->isNewRecord) {
            $categories = static::find()->all();
            $disallowedIds = static::getCategoryIds($categories, $this->id);
            if (in_array($this->parent_id,$disallowedIds)) {
                $this->addError($attribute, 'Parent can\'t be its child item');
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent',
            'title' => 'Title',
            'slug' => 'Slug',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    /**
     * Returns IDs of category and all its sub-categories
     *
     * @param Category[] $categories all categories
     * @param int $categoryId id of category to start search with
     * @param array $categoryIds
     * @return array $categoryIds
     */
    static public function getCategoryIds($categories, $categoryId, &$categoryIds = [])
    {

        foreach ($categories as $category) {
            if ($category->id == $categoryId) {
                $categoryIds[] = $category->id;
                break;
            }
        }
        foreach ($categories as $category) {
            if ($category->parent_id == $categoryId) {
                static::getCategoryIds($categories, $category->id, $categoryIds);
            }
        }

        return $categoryIds;
    }

}
