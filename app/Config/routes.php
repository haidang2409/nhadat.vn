<?php
Router::parseExtensions('html', 'rss');
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
//Router::connect('/:language/:controller/:action/*',
//    array(),
//    array(
//        'language' => '[a-z]{3}'
//    )
//);
//Trang chủ
Router::connect('/', array('controller' => 'products', 'action' => 'index'));
//Đăng tin bất động sản
Router::connect('/dang-tin-bat-dong-san', array('controller' => 'products', 'action' => 'add'));
//Sử tin bất động sản
Router::connect('/sua-tin-bat-dong-san', array('controller' => 'products', 'action' => 'edit'));
//Đăng tin cần mua cần thuê
Router::connect('/dang-tin-can-mua-can-thue', array('controller' => 'products', 'action' => 'add_can_mua_can_thue'));
//Nha dat
//Sửa tin cần mua cần thuê
Router::connect('/sua-tin-can-mua-can-thue', array('controller' => 'products', 'action' => 'edit_can_mua_can_thue'));

//Nha dat ban
Router::connect('/nha-dat-ban', array('controller' => 'products', 'action' => 'index_product', 'type' => 'ban'));
Router::connect('/nha-dat-ban/:provincelink-:provinceid',
    array('controller' => 'products', 'action' => 'index_product', 'type' => 'ban'),
    array(
        'pass' => array('provincelink', 'provincelink'),
        'provincelink' => '[a-z0-9-]+',
        'provinceid' => '[p][0-9]+'
    )
);
Router::connect('/nha-dat-ban/:districtlink-:districtid',
    array('controller' => 'products', 'action' => 'index_product', 'type' => 'ban'),
    array(
        'pass' => array('districtlink', 'districtid'),
        'districtlink' => '[a-z0-9-]+',
        'districtid' => '[d][0-9]+'
    )
);
Router::connect('/nha-dat-ban/:wardlink-:wardid',
    array('controller' => 'products', 'action' => 'index_product', 'type' => 'ban'),
    array(
        'pass' => array('wardlink', 'wardid'),
        'wardlink' => '[a-z0-9-]+',
        'wardid' => '[w][0-9]+'
    )
);
//Nha dat cho thue
Router::connect('/nha-dat-cho-thue', array('controller' => 'products', 'action' => 'index_product', 'type' => 'cho-thue'));
Router::connect('/nha-dat-cho-thue/:provincelink-:provinceid',
    array('controller' => 'products', 'action' => 'index_product', 'type' => 'cho-thue'),
    array(
        'pass' => array('provincelink', 'provincelink'),
        'provincelink' => '[a-z0-9-]+',
        'provinceid' => '[p][0-9]+'
    )
);
Router::connect('/nha-dat-cho-thue/:districtlink-:districtid',
    array('controller' => 'products', 'action' => 'index_product', 'type' => 'cho-thue'),
    array(
        'pass' => array('districtlink', 'districtid'),
        'districtlink' => '[a-z0-9-]+',
        'districtid' => '[d][0-9]+'
    )
);
Router::connect('/nha-dat-cho-thue/:wardlink-:wardid',
    array('controller' => 'products', 'action' => 'index_product', 'type' => 'cho-thue'),
    array(
        'pass' => array('wardlink', 'wardid'),
        'wardlink' => '[a-z0-9-]+',
        'wardid' => '[w][0-9]+'
    )
);

//
////////Group
//Ban theo group(nha, can ho, ...)
Router::connect('/ban-:grouplink-:groupid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'ban'
    ),
    array(
        'pass' => array('grouplink', 'groupid'),
        'grouplink' => '[a-z0-9-]+',
        'groupid' => '[g][0-9]+'
    )
);
//cho thue theo group group(nha, can ho, ...)
Router::connect('/cho-thue-:grouplink-:groupid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'cho-thue'
    ),
    array(
        'pass' => array('grouplink', 'groupid'),
        'grouplink' => '[a-z0-9-]+',
        'groupid' => '[g][0-9]+'
    )
);


///////Group/province
//Ban theo group(nha, can ho, ...)
Router::connect('/ban-:grouplink-:groupid/:provincelink-:provinceid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'ban'
    ),
    array(
        'pass' => array('grouplink', 'groupid', 'provincelink', 'provinceid'),
        'grouplink' => '[a-z0-9-]+',
        'groupid' => '[g][0-9]+',
        'provincelink' => '[a-z0-9-]+',
        'provinceid' => '[p][0-9]+'
    )
);
//cho thue theo group group(nha, can ho, ...)
Router::connect('/cho-thue-:grouplink-:groupid/:provincelink-:provinceid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'cho-thue'
    ),
    array(
        'pass' => array('grouplink', 'groupid', 'provincelink', 'provinceid'),
        'grouplink' => '[a-z0-9-]+',
        'groupid' => '[g][0-9]+',
        'provincelink' => '[a-z0-9-]+',
        'provinceid' => '[p][0-9]+'
    )
);


///////Group/district
//Ban theo group/ward(ban-nha/quan-1-ho-chi-minh ...)
Router::connect('/ban-:grouplink-:groupid/:districtlink-:districtid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'ban'
    ),
    array(
        'pass' => array('grouplink', 'groupid', 'districtlink', 'districtid'),
        'grouplink' => '[a-z0-9-]+',
        'groupid' => '[g][0-9]+',
        'districtlink' => '[a-z0-9-]+',
        'districtid' => '[d][0-9]+'
    )
);
//cho thue theo group/district(cho-thue-nha/ho-chi-minh ...)
Router::connect('/cho-thue-:grouplink-:groupid/:districtlink-:districtid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'cho-thue'
    ),
    array(
        'pass' => array('grouplink', 'groupid', 'districtlink', 'districtid'),
        'grouplink' => '[a-z0-9-]+',
        'groupid' => '[g][0-9]+',
        'districtlink' => '[a-z0-9-]+',
        'districtid' => '[d][0-9]+'
    )
);



///////Group/ward
//Ban theo group/district(ban-nha/ho-chi-minh ...)
Router::connect('/ban-:grouplink-:groupid/:wardlink-:wardid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'ban'
    ),
    array(
        'pass' => array('grouplink', 'groupid', 'wardlink', 'wardid'),
        'grouplink' => '[a-z0-9-]+',
        'groupid' => '[g][0-9]+',
        'wardlink' => '[a-z0-9-]+',
        'wardid' => '[w][0-9]+'
    )
);
Router::connect('/cho-thue-:grouplink-:groupid/:wardlink-:wardid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'cho-thue'
    ),
    array(
        'pass' => array('grouplink', 'groupid', 'wardlink', 'wardid'),
        'grouplink' => '[a-z0-9-]+',
        'groupid' => '[g][0-9]+',
        'wardlink' => '[a-z0-9-]+',
        'wardid' => '[w][0-9]+'
    )
);


///////////Category
//Ban theo category
Router::connect('/ban-:categorylink-:categoryid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'ban'
    ),
    array(
        'pass' => array('categorylink', 'categoryid'),
        'categorylink' => '[a-z0-9-]+',
        'categoryid' => '[c][0-9]+'
    )
);
//Cho thue theo group
Router::connect('/cho-thue-:categorylink-:categoryid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'cho-thue'
    ),
    array(
        'pass' => array('categorylink', 'categoryid'),
        'categorylink' => '[a-z0-9-]+',
        'categoryid' => '[c][0-9]+'
    )
);

//

///////Category/province
//Ban theo category/province(nha, can ho, ...)
Router::connect('/ban-:categorylink-:categoryid/:provincelink-:provinceid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'ban'
    ),
    array(
        'pass' => array('categorylink', 'categoryid', 'provincelink', 'provinceid'),
        'categorylink' => '[a-z0-9-]+',
        'categoryid' => '[c][0-9]+',
        'provincelink' => '[a-z0-9-]+',
        'provinceid' => '[p][0-9]+'
    )
);
Router::connect('/cho-thue-:categorylink-:categoryid/:provincelink-:provinceid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'cho-thue'
    ),
    array(
        'pass' => array('categorylink', 'categoryid', 'provincelink', 'provinceid'),
        'categorylink' => '[a-z0-9-]+',
        'categoryid' => '[c][0-9]+',
        'provincelink' => '[a-z0-9-]+',
        'provinceid' => '[p][0-9]+'
    )
);


/////////Category/district
Router::connect('/ban-:categorylink-:categoryid/:districtlink-:districtid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'ban'
    ),
    array(
        'pass' => array('categorylink', 'categoryid', 'districtlink', 'districtid'),
        'categorylink' => '[a-z0-9-]+',
        'categoryid' => '[c][0-9]+',
        'districtlink' => '[a-z0-9-]+',
        'districtid' => '[d][0-9]+'
    )
);
Router::connect('/cho-thue-:categorylink-:categoryid/:districtlink-:districtid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'cho-thue'
    ),
    array(
        'pass' => array('categorylink', 'categoryid', 'districtlink', 'districtid'),
        'categorylink' => '[a-z0-9-]+',
        'categoryid' => '[c][0-9]+',
        'districtlink' => '[a-z0-9-]+',
        'districtid' => '[d][0-9]+'
    )
);

//
//
/////////category/ward
Router::connect('/ban-:categorylink-:categoryid/:wardlink-:wardid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'ban'
    ),
    array(
        'pass' => array('categorylink', 'categoryid', 'wardlink', 'wardid'),
        'categorylink' => '[a-z0-9-]+',
        'categoryid' => '[c][0-9]+',
        'wardlink' => '[a-z0-9-]+',
        'wardid' => '[w][0-9]+'
    )
);
Router::connect('/cho-thue-:categorylink-:categoryid/:wardlink-:wardid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'cho-thue'
    ),
    array(
        'pass' => array('categorylink', 'categoryid', 'wardlink', 'wardid'),
        'categorylink' => '[a-z0-9-]+',
        'categoryid' => '[c][0-9]+',
        'wardlink' => '[a-z0-9-]+',
        'wardid' => '[w][0-9]+'
    )
);



//Nha dat theo ban do
Router::connect('/tim-theo-ban-do', array('controller' => 'products', 'action' => 'index_maps'));

/////////////////////////////////
/////////////////////////////////
/////////////////////////////////

//Nha dat can mua
Router::connect('/can-mua-nha-dat', array('controller' => 'products', 'action' => 'index_product', 'type' => 'can-mua'));
Router::connect('/can-mua-nha-dat/:provincelink-:provinceid',
    array('controller' => 'products', 'action' => 'index_product', 'type' => 'can-mua'),
    array(
        'pass' => array('provincelink', 'provincelink'),
        'provincelink' => '[a-z0-9-]+',
        'provinceid' => '[p][0-9]+'
    )
);
Router::connect('/can-mua-nha-dat/:districtlink-:districtid',
    array('controller' => 'products', 'action' => 'index_product', 'type' => 'can-mua'),
    array(
        'pass' => array('districtlink', 'districtid'),
        'districtlink' => '[a-z0-9-]+',
        'districtid' => '[d][0-9]+'
    )
);
Router::connect('/can-mua-nha-dat/:wardlink-:wardid',
    array('controller' => 'products', 'action' => 'index_product', 'type' => 'can-mua'),
    array(
        'pass' => array('wardlink', 'wardid'),
        'wardlink' => '[a-z0-9-]+',
        'wardid' => '[w][0-9]+'
    )
);
//Nha dat can thue
Router::connect('/can-thue-nha-dat', array('controller' => 'products', 'action' => 'index_product', 'type' => 'can-thue'));
Router::connect('/can-thue-nha-dat/:provincelink-:provinceid',
    array('controller' => 'products', 'action' => 'index_product', 'type' => 'can-thue'),
    array(
        'pass' => array('provincelink', 'provincelink'),
        'provincelink' => '[a-z0-9-]+',
        'provinceid' => '[p][0-9]+'
    )
);
Router::connect('/can-thue-nha-dat/:districtlink-:districtid',
    array('controller' => 'products', 'action' => 'index_product', 'type' => 'can-thue'),
    array(
        'pass' => array('districtlink', 'districtid'),
        'districtlink' => '[a-z0-9-]+',
        'districtid' => '[d][0-9]+'
    )
);
Router::connect('/can-thue-nha-dat/:wardlink-:wardid',
    array('controller' => 'products', 'action' => 'index_product', 'type' => 'can-thue'),
    array(
        'pass' => array('wardlink', 'wardid'),
        'wardlink' => '[a-z0-9-]+',
        'wardid' => '[w][0-9]+'
    )
);

//
////////Group
//Can mua theo group(nha, can ho, ...)
Router::connect('/can-mua-:grouplink-:groupid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'can-mua'
    ),
    array(
        'pass' => array('grouplink', 'groupid'),
        'grouplink' => '[a-z0-9-]+',
        'groupid' => '[g][0-9]+'
    )
);

//Can thue theo group group(nha, can ho, ...)
Router::connect('/can-thue-:grouplink-:groupid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'can-thue'
    ),
    array(
        'pass' => array('grouplink', 'groupid'),
        'grouplink' => '[a-z0-9-]+',
        'groupid' => '[g][0-9]+'
    )
);


///////Group/province
//Ban theo group(nha, can ho, ...)
Router::connect('/can-mua-:grouplink-:groupid/:provincelink-:provinceid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'can-mua'
    ),
    array(
        'pass' => array('grouplink', 'groupid', 'provincelink', 'provinceid'),
        'grouplink' => '[a-z0-9-]+',
        'groupid' => '[g][0-9]+',
        'provincelink' => '[a-z0-9-]+',
        'provinceid' => '[p][0-9]+'
    )
);
Router::connect('/can-thue-:grouplink-:groupid/:provincelink-:provinceid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'can-thue'
    ),
    array(
        'pass' => array('grouplink', 'groupid', 'provincelink', 'provinceid'),
        'grouplink' => '[a-z0-9-]+',
        'groupid' => '[g][0-9]+',
        'provincelink' => '[a-z0-9-]+',
        'provinceid' => '[p][0-9]+'
    )
);
//End Group/province

///////Group/district
//Ban theo group/ward(ban-nha/quan-1-ho-chi-minh ...)
Router::connect('/can-mua-:grouplink-:groupid/:districtlink-:districtid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'can-mua'
    ),
    array(
        'pass' => array('grouplink', 'groupid', 'districtlink', 'districtid'),
        'grouplink' => '[a-z0-9-]+',
        'groupid' => '[g][0-9]+',
        'districtlink' => '[a-z0-9-]+',
        'districtid' => '[d][0-9]+'
    )
);
Router::connect('/can-thue-:grouplink-:groupid/:districtlink-:districtid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'can-thue'
    ),
    array(
        'pass' => array('grouplink', 'groupid', 'districtlink', 'districtid'),
        'grouplink' => '[a-z0-9-]+',
        'groupid' => '[g][0-9]+',
        'districtlink' => '[a-z0-9-]+',
        'districtid' => '[d][0-9]+'
    )
);

///////Group/ward
//Ban theo group/district(ban-nha/ho-chi-minh ...)
Router::connect('/can-mua-:grouplink-:groupid/:wardlink-:wardid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'can-mua'
    ),
    array(
        'pass' => array('grouplink', 'groupid', 'wardlink', 'wardid'),
        'grouplink' => '[a-z0-9-]+',
        'groupid' => '[g][0-9]+',
        'wardlink' => '[a-z0-9-]+',
        'wardid' => '[w][0-9]+'
    )
);
Router::connect('/can-thue-:grouplink-:groupid/:wardlink-:wardid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'can-thue'
    ),
    array(
        'pass' => array('grouplink', 'groupid', 'wardlink', 'wardid'),
        'grouplink' => '[a-z0-9-]+',
        'groupid' => '[g][0-9]+',
        'wardlink' => '[a-z0-9-]+',
        'wardid' => '[w][0-9]+'
    )
);
//End group/ward

///////////Category
//Ban theo category
Router::connect('/can-mua-:categorylink-:categoryid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'can-mua'
    ),
    array(
        'pass' => array('categorylink', 'categoryid'),
        'categorylink' => '[a-z0-9-]+',
        'categoryid' => '[c][0-9]+'
    )
);
//Cho thue theo group
Router::connect('/can-thue-:categorylink-:categoryid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'can-thue'
    ),
    array(
        'pass' => array('categorylink', 'categoryid'),
        'categorylink' => '[a-z0-9-]+',
        'categoryid' => '[c][0-9]+'
    )
);
//Category
//

///////Category/province
//Ban theo category/province(nha, can ho, ...)
Router::connect('/can-mua-:categorylink-:categoryid/:provincelink-:provinceid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'can-mua'
    ),
    array(
        'pass' => array('categorylink', 'categoryid', 'provincelink', 'provinceid'),
        'categorylink' => '[a-z0-9-]+',
        'categoryid' => '[c][0-9]+',
        'provincelink' => '[a-z0-9-]+',
        'provinceid' => '[p][0-9]+'
    )
);
Router::connect('/can-thue-:categorylink-:categoryid/:provincelink-:provinceid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'can-thue'
    ),
    array(
        'pass' => array('categorylink', 'categoryid', 'provincelink', 'provinceid'),
        'categorylink' => '[a-z0-9-]+',
        'categoryid' => '[c][0-9]+',
        'provincelink' => '[a-z0-9-]+',
        'provinceid' => '[p][0-9]+'
    )
);
//End Category/province

/////////Category/district
Router::connect('/can-mua-:categorylink-:categoryid/:districtlink-:districtid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'can-mua'
    ),
    array(
        'pass' => array('categorylink', 'categoryid', 'districtlink', 'districtid'),
        'categorylink' => '[a-z0-9-]+',
        'categoryid' => '[c][0-9]+',
        'districtlink' => '[a-z0-9-]+',
        'districtid' => '[d][0-9]+'
    )
);
Router::connect('/can-thue-:categorylink-:categoryid/:districtlink-:districtid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'can-thue'
    ),
    array(
        'pass' => array('categorylink', 'categoryid', 'districtlink', 'districtid'),
        'categorylink' => '[a-z0-9-]+',
        'categoryid' => '[c][0-9]+',
        'districtlink' => '[a-z0-9-]+',
        'districtid' => '[d][0-9]+'
    )
);
////End Category/district
//

//
/////////category/ward
Router::connect('/can-mua-:categorylink-:categoryid/:wardlink-:wardid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'can-mua'
    ),
    array(
        'pass' => array('categorylink', 'categoryid', 'wardlink', 'wardid'),
        'categorylink' => '[a-z0-9-]+',
        'categoryid' => '[c][0-9]+',
        'wardlink' => '[a-z0-9-]+',
        'wardid' => '[w][0-9]+'
    )
);
Router::connect('/can-thue-:categorylink-:categoryid/:wardlink-:wardid',
    array(
        'controller' => 'products',
        'action' => 'index_product',
        'type' => 'can-thue'
    ),
    array(
        'pass' => array('categorylink', 'categoryid', 'wardlink', 'wardid'),
        'categorylink' => '[a-z0-9-]+',
        'categoryid' => '[c][0-9]+',
        'wardlink' => '[a-z0-9-]+',
        'wardid' => '[w][0-9]+'
    )
);
//End category/ward



//View product
Router::connect('/:product_title-:id',
    array(
        'controller' => 'products',
        'action' => 'view'
    ),
    array(
        'pass' => array('product_title', 'id'),
        'product_title' => '[a-z0-9-]+',
        'id' => '[0-9]+'
    ));


//Project
//Index all project
Router::connect('/du-an', array('controller' => 'projects', 'action' => 'index'));
//Index project vip
Router::connect('/du-an-vip', array('controller' => 'projects', 'action' => 'index_vip'));
//Index project bds
Router::connect('/du-an-bat-dong-san', array('controller' => 'projects', 'action' => 'index_project'));
//Project category
Router::connect('/du-an/:projectcat-:projectcat_id',
    array('controller' => 'projects', 'action' => 'index_project'),
    array(
        'pass' => array('projectcat', 'projectcat_id'),
        'projectcat' => '[a-z0-9-]+',
        'projectcat_id' => '[0-9]+',
    )
);

//Project category/province
Router::connect('/du-an/:projectcat-:projectcat_id/:provincelink-:provinceid',
    array('controller' => 'projects', 'action' => 'index_project'),
    array(
        'pass' => array('projectcat', 'projectcat_id', 'provincelink', 'provinceid'),
        'projectcat' => '[a-z0-9-]+',
        'projectcat_id' => '[0-9]+',
        'provincetlink' => '[a-z0-9-]+',
        'provinceid' => '[p][0-9]+',
    )
);
//Project category/province
Router::connect('/du-an/du-an-bat-dong-san/:provincelink-:provinceid',
    array('controller' => 'projects', 'action' => 'index_project'),
    array(
        'pass' => array('provincelink', 'provinceid'),
        'provincetlink' => '[a-z0-9-]+',
        'provinceid' => '[p][0-9]+',
    )
);
//Project category/district
Router::connect('/du-an/:projectcat-:projectcat_id/:districtlink-:districtid',
    array('controller' => 'projects', 'action' => 'index_project'),
    array(
        'pass' => array('projectcat', 'projectcat_id', 'districtlink', 'districtid'),
        'projectcat' => '[a-z0-9-]+',
        'projectcat_id' => '[0-9]+',
        'districtlink' => '[a-z0-9-]+',
        'districtid' => '[d][0-9]+',
    )
);
//Project category/province
Router::connect('/du-an/du-an-bat-dong-san/:districtlink-:districtid',
    array('controller' => 'projects', 'action' => 'index_project'),
    array(
        'pass' => array('districtlink', 'districtid'),
        'districtlink' => '[a-z0-9-]+',
        'districtid' => '[d][0-9]+',
    )
);
//Project detail vip
Router::connect('/du-an-vip/:projectcat-:projectcat_id/:projectlink-:id',
    array('controller' => 'projects', 'action' => 'view_vip'),
    array(
        'pass' => array('projectcat', 'projectcat_id', 'projectlink', 'id'),
        'projectcat' => '[a-z0-9-]+',
        'projectcat_id' => '[0-9]+',
        'projectlink' => '[a-z0-9-]+',
        'id' => '[0-9]+',
    )
);
//Project detail
Router::connect('/du-an/:projectcat-:projectcat_id/:projectlink-:id',
    array('controller' => 'projects', 'action' => 'view_project'),
    array(
        'pass' => array('projectcat', 'projectcat_id', 'projectlink', 'id'),
        'projectcat' => '[a-z0-9-]+',
        'projectcat_id' => '[0-9]+',
        'projectlink' => '[a-z0-9-]+',
        'id' => '[0-9]+',
    )
);

//About

Router::connect('/a/help', array('controller' => 'helps', 'action' => 'index'));
Router::connect('/a/gia-dich-vu-dang-tin', array('controller' => 'packets', 'action' => 'index'));
Router::connect('/a/gia-dich-vu-quang-cao', array('controller' => 'helps', 'action' => 'dichvuquangcao'));
Router::connect('/a/gioi-thieu', array('controller' => 'helps', 'action' => 'about'));
Router::connect('/a/lien-he', array('controller' => 'helps', 'action' => 'contact'));
Router::connect('/a/lich-su-hinh-thanh', array('controller' => '', 'action' => ''));
//Help
Router::connect('/help/huong-dan-dang-tin', array('controller' => 'helps', 'action' => 'huongdandangtin'));
Router::connect('/help/quan-ly-tin-dang', array('controller' => 'helps', 'action' => 'quanlytindang'));
Router::connect('/help/huong-dan-thanh-toan', array('controller' => 'helps', 'action' => 'huongdanthanhtoan'));
Router::connect('/help/dieu-khoan-su-dung', array('controller' => 'helps', 'action' => 'dieukhoansudung'));
Router::connect('/help/dieu-khoan-bao-mat', array('controller' => 'helps', 'action' => 'dieukhoanbaomat'));



//Bai viet
//Index
Router::connect('/bai-viet', array('controller' => 'posts', 'action' => 'index'));
//
Router::connect('/bai-viet/:postcat-:postcatid',
    array('controller' => 'posts', 'action' => 'index'),
    array(
        'pass' => array('postcat', 'postcatid'),
        'postcat' => '[a-z0-9-]+',
        'postcatid' => '[c][p][0-9]+'
    )
);
Router::connect('/bai-viet/:postlink-:id',
    array('controller' => 'posts', 'action' => 'view'),
    array(
        'pass' => array('postlink', 'id'),
        'postlink' => '[a-z0-9-]+',
        'id' => '[0-9-]+'
    )
);

Router::connect('/phong-thuy', array('controller' => 'posts', 'action' => 'phong_thuy'));

//Tuyen dung
Router::connect('/tuyen-dung', array('controller' => 'recruitments', 'action' => 'index'));
Router::connect('/tuyen-dung/:link',
    array('controller' => 'recruitments', 'action' => 'view'),
    array(
        'pass' => array('link'),
        'link' => '[a-z0-9-]+'
    )
);
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
//////////////////////////////////
//Front-End
//////////////////////////////////
//Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));




/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */

/////////////////////////////////////
//Back-End
/////////////////////////////////////
Router::connect('/admin', array('controller' => 'staffs', 'action' => 'login', 'prefix' => 'admin',));
Router::connect('/admin/home', array('controller' => 'staffs', 'action' => 'home', 'prefix' => 'admin',));
Router::connect('/admin/login', array('controller' => 'staffs', 'action' => 'login', 'prefix' => 'admin', 'admin' => false));
Router::connect('/admin/logout', array('controller' => 'staffs', 'action' => 'logout', 'prefix' => 'admin'));
//Members




///////////////////////////////////
CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
require CAKE . 'Config' . DS . 'routes.php';
