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
    use \xjryanse\traits\StaticModelTrait;
    
    protected static $mainModel;
    protected static $mainModelClass = '\\xjryanse\\statics\\model\\StaticsCondition';
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
    /**
     *
     */
    public function fId() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     *
     */
    public function fAppId() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     *
     */
    public function fCompanyId() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 统计指标id，ydzb_common_statics
     */
    public function fStaticsId() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 1字段、2条件、3表名、4groupby、5动态字段、6产品编码筛选、7、嵌套sql、9时间条件
     */
    public function fType() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     *
     */
    public function fName() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 排序
     */
    public function fSort() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 状态(0禁用,1启用)
     */
    public function fStatus() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 有使用(0否,1是)
     */
    public function fHasUsed() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 锁定（0：未锁，1：已锁）
     */
    public function fIsLock() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 锁定（0：未删，1：已删）
     */
    public function fIsDelete() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 备注
     */
    public function fRemark() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 创建者，user表
     */
    public function fCreater() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 更新者，user表
     */
    public function fUpdater() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 创建时间
     */
    public function fCreateTime() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 更新时间
     */
    public function fUpdateTime() {
        return $this->getFFieldValue(__FUNCTION__);
    }

}
