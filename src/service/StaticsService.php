<?php

namespace xjryanse\statics\service;

use xjryanse\system\interfaces\MainModelInterface;
use think\Db;
/**
 * 
 */
class StaticsService extends Base implements MainModelInterface {

    use \xjryanse\traits\InstTrait;
    use \xjryanse\traits\MainModelTrait;
    use \xjryanse\traits\MainModelRamTrait;
    use \xjryanse\traits\MainModelCacheTrait;
    use \xjryanse\traits\MainModelCheckTrait;
    use \xjryanse\traits\MainModelGroupTrait;
    use \xjryanse\traits\MainModelQueryTrait;

    use \xjryanse\traits\ObjectAttrTrait;
    use \xjryanse\traits\StaticModelTrait;

    protected static $mainModel;
    protected static $mainModelClass = '\\xjryanse\\statics\\model\\Statics';
    
    use \xjryanse\statics\service\index\FieldTraits;
    use \xjryanse\statics\service\index\ListTraits;
    use \xjryanse\statics\service\index\DoTraits;
    
    public static function extraDetails($ids) {
        return self::commExtraDetails($ids, function($lists) use ($ids) {
                    return $lists;
                },true);
    }
    
    
    // 开始时间
    protected $startTime = '';
    // 结束时间
    protected $endTime = '';
    /**
     * 开始时间
     * @param type $startTime
     */
    public function setStartTime($startTime){
        $this->startTime = $startTime;
    }
    /**
     * 结束时间
     * @param type $endTime
     */
    public function setEndTime($endTime){
        $this->endTime = $endTime;
    }
    
    /**
     * 获取业务查询结果sql语句
     */
    public function getSql(){
        //取字段
        $staticsId  = $this->uuid;
        $tableName  = StaticsConditionService::getTableName($staticsId);
        $fields     = StaticsConditionService::getStaticFields($staticsId);
        $conditions = StaticsConditionService::getStaticConditions($staticsId);
        //时间条件
        $timeCon    = StaticsConditionService::timeConWhereSql($staticsId, $this->startTime, $this->endTime);
        if($timeCon){
            $conditions[] = $timeCon;
        }
        // where条件
        $whereStr = $conditions ? ' where '.implode(' and ',$conditions) : '' ;
        // group 字段
        $groupField = StaticsConditionService::getGroupField($staticsId) ;
        $groupStr = $groupField ? ' group by '.$groupField : '';
        
        $sql = 'select '.implode(',',$fields).' from ' .$tableName . $whereStr . $groupStr ;
        return $sql ;
    }
    /**
     * key取id
     * @param type $key
     * @return type
     */
    public static function keyId($key){
        return self::mainModel()->where('static_key',$key)->value('id');
    }

}
