<?php
namespace xjryanse\statics\model;

/**
 * 
 */
class StaticsTime extends Base
{
    use \xjryanse\traits\ModelUniTrait;
    // 20230516:数据表关联字段
    public static $uniFields = [
        [
            'field'     =>'statics_id',
            // 去除prefix的表名
            'uni_name'  =>'statics',
            'uni_field' =>'id',
            'del_check' => true,
        ]
    ];

}