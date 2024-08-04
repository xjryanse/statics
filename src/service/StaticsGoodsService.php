<?php

namespace xjryanse\statics\service;

use xjryanse\system\interfaces\MainModelInterface;

/**
 * 
 */
class StaticsGoodsService extends Base implements MainModelInterface {

    use \xjryanse\traits\InstTrait;
    use \xjryanse\traits\MainModelTrait;
    use \xjryanse\traits\MainModelRamTrait;
    use \xjryanse\traits\MainModelCacheTrait;
    use \xjryanse\traits\MainModelCheckTrait;
    use \xjryanse\traits\MainModelGroupTrait;
    use \xjryanse\traits\MainModelQueryTrait;


    protected static $mainModel;
    protected static $mainModelClass = '\\xjryanse\\statics\\model\\StaticsGoods';

    use \xjryanse\statics\service\goods\FieldTraits;

}
