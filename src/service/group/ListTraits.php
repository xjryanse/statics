<?php

namespace xjryanse\statics\service\group;

use xjryanse\logic\Arrays;
use xjryanse\logic\Arrays2d;
use xjryanse\logic\Datetime;
use xjryanse\statics\service\StaticsService;
use Exception;
use think\Db;
use think\facade\Request;
/**
 * 
 */
trait ListTraits{
    /**
     * 统计结果
     * @param type $param
     * @throws Exception
     */
    public static function listStaticsKeyData($param){
        // 取时间范围
        $scopeTimeArr = Datetime::paramScopeTime($param);
        $groupKey = Arrays::value($param, 'group_key') ? : Request::param('group_key');
        if(!$groupKey){
            throw new Exception('group_key必须');
        }
        $groupId = self::keyToId($groupKey);
        $groupItemList = self::getInstance($groupId)->objAttrsList('staticsGroupItem');
        
        $itemIds = Arrays2d::uniqueColumn($groupItemList, 'item_id');
        $data = [];
        foreach($itemIds as $staticsId){
            $inst = StaticsService::getInstance($staticsId);
            $inst->setStartTime($scopeTimeArr[0]);
            $inst->setEndTime($scopeTimeArr[1]);

            $sql = $inst->getSql();
            $res = Db::query($sql);
            // 只取一行
            $data = array_merge($data,$res[0]);
        }
        
        $arr = [];
        foreach($groupItemList as $v){
            $tmp = [];
            $tmp['describe']        = $v['describe'];
            $tmp['value']           = Arrays::value($data,$v['field_key']);
            $tmp['detail_page_key'] = $v['detail_page_key'];
            $arr[] = $tmp;
        }
        
        return $arr;
    }
    

}
