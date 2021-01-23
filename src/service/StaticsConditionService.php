<?php

namespace app\statics\service;

use xjryanse\system\interfaces\MainModelInterface;

/**
 * 
 */
class StaticsConditionService extends Base implements MainModelInterface {

    use \xjryanse\traits\InstTrait;
    use \xjryanse\traits\MainModelTrait;

    protected static $mainModel;
    protected static $mainModelClass = '\\app\\statics\\model\\StaticsCondition';

    /**
     * 获取静态字段
     * @param int $id
     * @param int $groupId
     * @return type
     */
    public static function getStaticFields( $staticsId )
    {
        $con[] = ['statics_id','=',$staticsId];
        $con[] = ['type','=','fields'];
        
        return self::mainModel()->where( $con )->column('name');
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
