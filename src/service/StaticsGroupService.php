<?php

namespace xjryanse\statics\service;

use xjryanse\system\interfaces\MainModelInterface;

/**
 * 
 */
class StaticsGroupService extends Base implements MainModelInterface {

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
    protected static $mainModelClass = '\\xjryanse\\statics\\model\\StaticsGroup';

    use \xjryanse\statics\service\group\FieldTraits;
    use \xjryanse\statics\service\group\ListTraits;
    
    public static function extraDetails($ids) {
        return self::commExtraDetails($ids, function($lists) use ($ids) {
                    return $lists;
                },true);
    }
    
    /**
     * key  转id
     * @param type $key
     * @return type
     */
    public static function keyToId($key) {
        $con[] = ['group_key', '=', $key];
        $info = self::staticConFind($con);
        return $info ? $info['id'] : '';
    }
}
