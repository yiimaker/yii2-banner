<?php
/**
 * @link https://github.com/yiimaker/yii2-banner
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\banner\migrations;

use yii\db\Migration;

/**
 * Handles the creation of tables `banner` and `banner_translation`.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class m171024_132212_create_banner_entities extends Migration
{
    /**
     * @var string
     */
    public $primaryTableName = '{{%banner}}';
    /**
     * @var string
     */
    public $translationTableName = '{{%banner_translation}}';


    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->getDriverName() === 'mysql') {
            /* @link http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci */
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // tables
        $this->createTable(
            $this->primaryTableName,
            [
                'id'            => $this->primaryKey(),

                'slug'          => $this->string()->notNull()->unique(),
                'published'     => $this->boolean()->notNull()->defaultValue(true),
                'views_count'   => $this->integer()->unsigned()->notNull()->defaultValue(0),

                'created_at'    => $this->integer()->unsigned()->notNull()->defaultValue(0),
                'updated_at'    => $this->integer()->unsigned()->notNull()->defaultValue(0),

                'valid_from'    => $this->dateTime()->null(),
                'valid_until'   => $this->dateTime()->null(),
            ],
            $tableOptions
        );
        $this->createTable(
            $this->translationTableName,
            [
                'id'        => $this->primaryKey(),
                'banner_id' => $this->integer()->unsigned()->notNull(),

                'language'  => $this->string(16)->notNull(),
                'content'   => $this->text()->null(),
                'hint'      => $this->string()->null(),

                'file_name' => $this->string()->notNull(),
                'alt'       => $this->string()->null(),

                'link'      => $this->string()->notNull()->defaultValue('#'),
            ],
            $tableOptions
        );

        // foreign keys
        $this->addForeignKey(
            'fk-banner_translation-banner_id-banner-id',
            $this->translationTableName,
            'banner_id',
            'banner',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // indexes
        $this->createIndex(
            'idx-banner-slug',
            $this->primaryTableName,
            'slug',
            true
        );
        $this->createIndex(
            'idx-banner_translation-banner_id',
            $this->translationTableName,
            'banner_id'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // foreign keys
        $this->dropForeignKey('fk-banner_translation-banner_id-banner-id', $this->translationTableName);
        // indexes

        $this->dropIndex('idx-banner_translation-banner_id', $this->translationTableName);
        $this->dropIndex('idx-banner-slug', $this->primaryTableName);

        // tables
        $this->dropTable($this->translationTableName);
        $this->dropTable($this->primaryTableName);
    }
}
