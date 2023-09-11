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
    use \xjryanse\traits\MainModelQueryTrait;
    use \xjryanse\traits\StaticModelTrait;

    protected static $mainModel;
    protected static $mainModelClass = '\\xjryanse\\statics\\model\\Statics';
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
    /**
     * 20230509：后台配置完成，可调用此方法进行测试
     * 
     */
    public static function staticsTest($id, $param = []){
        //$key = "webOrderStatics";
        // $id     = StaticsService::keyId($key);
        $inst   = self::getInstance($id);
        $inst->setStartTime(date('Y-m-d 00:00:00'));
        $inst->setEndTime(date('Y-m-d 23:59:59'));
        // 今天
        $sql1   = $inst->getSql();
        $data   = Db::query($sql1);
        // 测试
        $res['sql']     = $sql1;
        $res['data']    = $data;

        return $res;
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
     * 模块
     */
    public function fModule() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 指标描述
     */
    public function fDesc() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 本表详情id
     */
    public function fDetail() {
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
