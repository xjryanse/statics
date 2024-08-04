<?php
namespace xjryanse\statics\model;

/**
 * 
 */
class StaticsGroupItem extends Base
{
    use \xjryanse\traits\ModelUniTrait;
    // 20230516:数据表关联字段
    public static $uniFields = [
        [
            'field'     =>'group_id',
            'uni_name'  =>'statics_group',
            'uni_field' =>'id',
            'del_check' => true,
        ],
        [
            'field'     =>'item_id',
            'uni_name'  =>'statics',
            'uni_field' =>'id',
            'del_check' => true,
        ]
    ];


}