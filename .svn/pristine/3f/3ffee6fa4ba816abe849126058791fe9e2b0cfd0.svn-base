<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%work_report}}".
 *
 * @property integer $id
 * @property string $report_title
 * @property integer $report_type
 * @property integer $submit_leader
 * @property integer $report_time_start
 * @property integer $report_time_end
 * @property string $report_summary
 * @property string $next_plan
 * @property integer $em_id
 * @property integer $admin_id
 * @property integer $report_time
 */
class WorkReport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%work_report}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['report_title', 'report_type', 'submit_leader', 'report_time_start', 'report_time_end', 'report_summary', 'next_plan', 'em_id', 'admin_id', 'report_time'], 'required'],
            [['report_type', 'submit_leader', 'report_time_start', 'report_time_end', 'em_id', 'admin_id', 'report_time'], 'integer'],
            [['report_summary', 'next_plan'], 'string'],
            [['report_title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'report_title' => '报告标题',
            'report_type' => '报告类型',
            'submit_leader' => '呈报领导',
            'report_time_start' => '呈报区间开始',
            'report_time_end' => '呈报区间结束',
            'report_summary' => '本周总结',
            'next_plan' => '下周计划',
            'em_id' => '员工id',
            'admin_id' => '管理员id',
            'report_time' => '报告时间',
        ];
    }
}
