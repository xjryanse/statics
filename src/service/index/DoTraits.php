<?php

namespace xjryanse\statics\service\index;

use think\Db;
/**
 * 分页复用列表
 */
trait DoTraits{
   
    /**
     * 获取调试sql
     * 使用今日的数据进行测试，今日可以，则月，年同理可以
     * @return type
     */
    public function doTestSql(){
        $this->setStartTime(date('Y-m-d 00:00:00'));
        $this->setEndTime(date('Y-m-d 23:59:59'));
        // 今天
        return $this->getSql();
    }
        /**
     * 20230509：后台配置完成，可调用此方法进行测试
     * 
     */
    public function doTestData(){
        $this->setStartTime(date('Y-m-d 00:00:00'));
        $this->setEndTime(date('Y-m-d 23:59:59'));
        // 今天
        $sql1   = $this->getSql();
        $data   = Db::query($sql1);
        // 测试
        $res['sql']     = $sql1;
        $res['data']    = $data;

        return $res;
    }
}
