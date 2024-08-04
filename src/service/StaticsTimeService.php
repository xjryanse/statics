<?php

namespace xjryanse\statics\service;

use xjryanse\system\interfaces\MainModelInterface;
use xjryanse\logic\DbOperate;
use xjryanse\logic\Datetime;
use xjryanse\logic\Number;
use xjryanse\logic\Arrays;
use xjryanse\logic\Arrays2d;
use xjryanse\logic\Strings;
/**
 * 
 */
class StaticsTimeService extends Base implements MainModelInterface {

    use \xjryanse\traits\InstTrait;
    use \xjryanse\traits\MainModelTrait;
    use \xjryanse\traits\MainModelRamTrait;
    use \xjryanse\traits\MainModelCacheTrait;
    use \xjryanse\traits\MainModelCheckTrait;
    use \xjryanse\traits\MainModelGroupTrait;
    use \xjryanse\traits\MainModelQueryTrait;

    use \xjryanse\traits\StaticModelTrait;
    
    protected static $mainModel;
    protected static $mainModelClass = '\\xjryanse\\statics\\model\\StaticsTime';

    public static function dimListByStaticsId($staticsId){
        $con    = [];
        $con[]  = ['statics_id','=',$staticsId];
        return self::staticConList($con);
    }

    /**
     * 根据配置维度，计算分组统计结果
     * @param type $staticsKey 
     * @param type $ids 例如：车辆id
     * @param type $timeScope   [开始时间，结束时间]
     */
    public static function calGroupStaticsByKey($staticsKey,$ids,$timeScope = []){
        $staticsId  = StaticsService::keyId($staticsKey);
        $lists      = self::dimListByStaticsId($staticsId);
        $arr        = [];
        foreach($lists as $v){
            $tmpVal     = 0;
            $cond       = $v['condition'] ? json_decode($v['condition'],true) : [];
            $cond       = array_merge($cond, Datetime::scopeTimeCon($v['time_field'], $timeScope));
            $service    = DbOperate::getService($v['table_name']);
            if($v['sum_field']){
                // 有求和字段，求和
                // $tmpVal = $service::groupBatchSum($v['key_field'], $ids, $v['sum_field'], $cond);
                if(Strings::hasBlank($v['table_name'])){
                    // 有空格，认为表名是sql
                    $tmpVal = DbOperate::groupBatchSum($v['table_name'], $v['key_field'], $ids, $v['sum_field'], $cond);
                } else {
                    // 没有空格，可提取服务类
                    $tmpVal = $service::groupBatchSum($v['key_field'], $ids, $v['sum_field'], $cond);
                }
            } else{
                // 没有求和字段，计数
                $tmpVal = $service::groupBatchCount($v['key_field'], $ids, $cond);
            }
            // 20231219
            $allSum = Number::round(array_sum(array_values($tmpVal)),2);
            // 类型：0计数；1进账；2出账
            $arr[$v['st_field']] = [
                'key'   => $v['st_field'],
                'value' => $tmpVal,
                'type'  => $v['st_type'],
                'level' => $v['level'],
                'sum'   => $allSum
            ];
        }

         return $arr;
    }
    
    /**
     * 
     * @param type $arr             数据数组
     * @param string $staticsKey    例如：busFeeStatics
     * @param type $arrKey          例如，车辆表的id字段
     */
    public static function addStaticsDataArr($arr, $staticsKey,  $arrKey='id', $timeScope = []){
        // $dIds  例如：车辆id
        $dIds       = array_column($arr, $arrKey);
        // 提取各配置费用
        // $staticsKey = 'busFeeStatics';
        $feeArr     = self::calGroupStaticsByKey($staticsKey, $dIds, $timeScope);

        // 20231219：分级求和
        $levels     = Arrays2d::uniqueColumn($feeArr, 'level');
        sort($levels);
        foreach($arr as &$v){
            // 加油：报销：高速等费用的聚合组合
            // 数据格式：['key'=>'','value'=>[车1=>11,车2=>22],'type'=>1]
            $hasData    = 0;
            foreach($feeArr as $fe){
                $v[$fe['key']]  = Arrays::value($fe['value'], $v['id']);
                $num        = $v[$fe['key']] ? :0;
                // 标记为有数据
                $hasData    = $num ? 1 : $hasData;
            }
            
            // 20231219:按分级求和
            foreach($levels as $lv){
                // level 小于当前level;type是1进账
                $coni    = [];
                $coni[]  = ['level','<=', $lv];
                $coni[]  = ['type','=', 1];
                $tmpIArr = Arrays2d::listFilter($feeArr,$coni);
                $iKeys   = array_column($tmpIArr, 'key');
                $v['stInPrize'.$lv]     = round(array_sum(Arrays::getByKeys($v, $iKeys)),2);

                // 2查出账
                $cono   = [];
                $cono[] = ['level','<=', $lv];
                $cono[] = ['type','=', 2];
                $tmpOArr = Arrays2d::listFilter($feeArr,$cono);
                $oKeys   = array_column($tmpOArr, 'key');
                $v['stOutPrize'.$lv]    = round(array_sum(Arrays::getByKeys($v, $oKeys)),2);
                $v['finalPrize'.$lv]    = Number::minus($v['stInPrize'.$lv], $v['stOutPrize'.$lv]);
                $v['finalRate'.$lv]     = Number::rate($v['finalPrize'.$lv], $v['stInPrize'.$lv]);
            }

            $coni       = [];
            $coni[]     = ['type','=', 1];
            $tmpIArr    = Arrays2d::listFilter($feeArr,$coni);
            $inKeys     = array_column($tmpIArr, 'key');
            $v['stInPrize']     = array_sum(Arrays::getByKeys($v, $inKeys));

            $cono       = [];
            $cono[]     = ['type','=', 2];
            $tmpOArr    = Arrays2d::listFilter($feeArr,$cono);
            $ouKeys     = array_column($tmpOArr, 'key');
            $v['stOutPrize']     = array_sum(Arrays::getByKeys($v, $ouKeys));

            // 是否有出车趟
            $v['hasData']       = $hasData;
        }
        return $arr;
    }
    /**
     * 20231219：计算费用求和
     */
    private static function calFeeSum(){
        
    }
    
}
