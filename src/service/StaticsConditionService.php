<?php

namespace xjryanse\statics\service;

use xjryanse\system\interfaces\MainModelInterface;
use xjryanse\logic\Arrays;
/**
 * 
 */
class StaticsConditionService extends Base implements MainModelInterface {

    use \xjryanse\traits\InstTrait;
    use \xjryanse\traits\MainModelTrait;
    use \xjryanse\traits\MainModelRamTrait;
    use \xjryanse\traits\MainModelCacheTrait;
    use \xjryanse\traits\MainModelCheckTrait;
    use \xjryanse\traits\MainModelGroupTrait;
    use \xjryanse\traits\MainModelQueryTrait;

    use \xjryanse\traits\StaticModelTrait;
    
    protected static $mainModel;
    protected static $mainModelClass = '\\xjryanse\\statics\\model\\StaticsCondition';
    
    use \xjryanse\statics\service\condition\FieldTraits;
    /**
     * 表名-唯一
     * @param type $staticsId
     * @return type
     */
    public static function getTableName($staticsId){
        $con[] = ['statics_id','=',$staticsId];
        $con[] = ['type','=','table_name'];
        $res = self::staticConFind($con);
        return Arrays::value($res, 'name');
        //return StaticsConditionService::mainModel()->where( $con )->value('name');
    }
    /**
     * 时间条件字段-唯一
     * @param type $staticsId
     * @return type
     */
    public static function getTimeConField($staticsId){
        $con[] = ['statics_id','=',$staticsId];
        $con[] = ['type','=','time_con'];
        $res = self::staticConFind($con);
        return Arrays::value($res, 'name');
        //return StaticsConditionService::mainModel()->where( $con )->value('name');
    }
    /**
     * 拼接时间字段的开始，结束
     */
    public static function timeConWhereSql($staticsId,$startTime,$endTime){
        $timeConField = self::getTimeConField($staticsId);
        //时间字段存在，则between
        return $timeConField ? '('.$timeConField." between '". $startTime ."' and '". $endTime ."')" : '';
    }
    /**
     * group字段-唯一
     * @param type $staticsId
     * @return type
     */
    public static function getGroupField($staticsId){
        $con[] = ['statics_id','=',$staticsId];
        $con[] = ['type','=','group'];
        $res = self::staticConFind($con);
        return Arrays::value($res, 'name');
        //return StaticsConditionService::mainModel()->where( $con )->value('name');
    }
    /**
     * 静态字段
     */
    public static function getStaticFields($staticsId){
        $con[] = ['statics_id','=',$staticsId];
        $con[] = ['type','=','field'];
        return self::staticConColumn('name',$con);

        //return StaticsConditionService::mainModel()->where( $con )->column('name');
    }
    /**
     * 动态字段
     */
    public static function getDynamicFields(){
        
    }
    /**
     * 静态条件
     * @param type $staticsId
     * @return type
     */
    public static function getStaticConditions($staticsId){
        $con[] = ['statics_id','=',$staticsId];
        $con[] = ['type','=','condition'];
        return self::staticConColumn('name',$con);
        //return StaticsConditionService::mainModel()->where( $con )->column('name');
    }
    
}
