<?php

namespace common\traits;

use common\models\Category;

trait CategoryTrait
{

/**
 * Returns IDs of category and all its sub-categories
 *
 * @param Category[] $categories all categories
 * @param int $categoryId id of category to start search with
 * @param array $categoryIds
 * @return array $categoryIds
 */
    public function getCategoryIds($categories, $categoryId, &$categoryIds = [])
    {

        foreach ($categories as $category) {
            if ($category->id == $categoryId) {
                $categoryIds[] = $category->id;
                break;
            }
        }
        foreach ($categories as $category) {
            if ($category->parent_id == $categoryId) {
                $this->getCategoryIds($categories, $category->id, $categoryIds);
            }
        }

        return $categoryIds;
    }

}