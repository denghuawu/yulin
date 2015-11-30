<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%schedule_action}}".
 *
 * @property integer $id
 * @property string $sch_theme
 * @property integer $sch_type
 * @property integer $customer_id
 * @property integer $execute_id
 * @property string $execute_partner
 * @property integer $priority_level
 * @property string $shc_desc
 * @property integer $sch_time_start
 * @property integer $sch_time_end
 * @property double $complete_level
 * @property integer $em_id
 * @property integer $admin_id
 * @property integer $createed_time
 */
class ScheduleAction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%schedule_action}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sch_theme', 'sch_type', 'customer_id', 'execute_id', 'execute_partner', 'priority_level', 'shc_desc', 'sch_time_start', 'sch_time_end', 'complete_level', 'em_id', 'admin_id', 'createed_time'], 'required'],
            [['sch_type', 'customer_id', 'execute_id', 'priority_level', 'sch_time_start', 'sch_time_end', 'em_id', 'admin_id', 'createed_time'], 'integer'],
            [['shc_desc'], 'string'],
            [['complete_level'], 'number'],
            [['sch_theme', 'execute_partner'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sch_theme' => '日程主题',
            'sch_type' => '日程类型',
            'customer_id' => '客户',
            'execute_id' => '执行人',
            'execute_partner' => '执行伙伴',
            'priority_level' => '优先级',
            'shc_desc' => '日程描述',
            'sch_time_start' => '开始时间',
            'sch_time_end' => '结束时间',
            'complete_level' => '完成度',
            'em_id' => '创建人',
            'admin_id' => 'Admin ID',
            'createed_time' => '创建时间',
        ];
    }
}
