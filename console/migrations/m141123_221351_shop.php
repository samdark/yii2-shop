<?php

use yii\db\Schema;
use yii\db\Migration;

class m141123_221351_shop extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category}}', [
            'id' => Schema::TYPE_PK,
            'parent_id' => Schema::TYPE_INTEGER,
            'title' => Schema::TYPE_STRING,
            'slug' => Schema::TYPE_STRING,
        ], $tableOptions);

        $this->addForeignKey('fk-category-parent_id-category-id', '{{%category}}', 'parent_id', '{{%category}}', 'id', 'CASCADE');

        $this->createTable('{{%product}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING,
            'slug' => Schema::TYPE_STRING,
            'description' => Schema::TYPE_TEXT,
            'category_id' => Schema::TYPE_INTEGER,
            'price' => Schema::TYPE_MONEY,
        ], $tableOptions);

        $this->addForeignKey('fk-product-category_id-category_id', '{{%product}}', 'category_id', '{{%category}}', 'id', 'RESTRICT');

        $this->createTable('{{%image}}', [
            'id' => Schema::TYPE_PK,
            'product_id' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        $this->addForeignKey('fk-image-product_id-product_id', '{{%image}}', 'product_id', 'product', 'id', 'SET NULL');

        $this->createTable('{{%order}}', [
            'id' => Schema::TYPE_PK,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
            'phone' => Schema::TYPE_STRING,
            'address' => Schema::TYPE_TEXT,
            'email' => Schema::TYPE_STRING,
            'notes' => Schema::TYPE_TEXT,
            'status' => Schema::TYPE_STRING,
        ], $tableOptions);

        $this->createTable('{{%order_item}}', [
            'id' => Schema::TYPE_PK,
            'order_id' => Schema::TYPE_INTEGER,
            'title' => Schema::TYPE_STRING,
            'price' => Schema::TYPE_MONEY,
            'product_id' => Schema::TYPE_INTEGER,
            'quantity' => Schema::TYPE_FLOAT,
        ], $tableOptions);

        $this->addForeignKey('fk-order_item-order_id-order-id', '{{%order_item}}', 'order_id', '{{%order}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-order_item-product_id-product-id', '{{%order_item}}', 'product_id', '{{%product}}', 'id', 'SET NULL');
    }

    public function down()
    {
        $this->dropTable('{{%order_item}}');
        $this->dropTable('{{%order}}');
        $this->dropTable('{{%image}}');
        $this->dropTable('{{%product}}');
        $this->dropTable('{{%category}}');
    }
}
