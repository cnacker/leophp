<?php

namespace app\_module\action;

use Mr\Abstracts\Action as _abstract;
use app\_module\classes\model\com_urlnk\alimama_auction_code;
use app\_module\classes\service\FastSearch;
use Ext\Url;
use Ext\PhpPdoMysql;

class _class extends _abstract implements \Mr\Interfaces\Action
{
    protected $var3 = "MyClass_var";

    //也可以在这里引用，不区分继承关系
    //use MyTrait;
    function _func()
    {
        global $Mr;
        $request = $Mr->request();
        $name = $request::get('name', 'value');
        // 5.4 无法运行以下代码
        # $name = $Mr->request()::get('name', 'value');
        # $arr = Model::all();
        echo $html = $Mr->template()->render('_skin/_default._default', ['title' => $name]);# 
        # echo "c".PHP_EOL;
    }
    
    function _func_get_()
    {
        # echo 'haha';
        echo $html = $GLOBALS['Mr']->template()->render('_skin/_class/_func_get', ['title' => 'hi']);# 
    }

    /**
     * GET 默认动作方法
     */
    public function _func_get()
    {
        global $Mr;
        $request = $Mr->request();
        $name = $request->uri;
        /**
        $fastSearch = new FastSearch();
        $fastSearch->init($request);
        $fastSearch->parse();
        exit;
        */
        $url = new Url($name);
        $uri = Url::rawDecode();
        $uri = ltrim($uri, '/');

        $split = preg_split('/\s+/', $uri, 2);
        $keyword = $query = '';
        $search_terms = '';
        if (1 < count($split)) {
            list($keyword, $search_terms) = $split;
        }

        $opt = $option = array();
        if (preg_match('/^(.*)\s+:(.*)$/', $search_terms, $matches)) {
            list($tmp, $query, $search_options) = $matches;
            $opt = preg_split('/\s+/', $search_options);
        } else {
            $query = $search_terms;
        }
        $query = $query ? : $uri;

        $config = $GLOBALS['_CONFIG']['database'];
        $mysql = new PhpPdoMysql($config);
        $keyword = addslashes($keyword);
        $sql = "SELECT * FROM `url`.`search` WHERE `search_shortcut` = '$keyword'";
        $row = $mysql->find($sql);
        if (!$row) {
            $url = "https://www.google.com/search?q=%s";
        } else {
            $url = $row->search_url;
            $query = preg_replace('/^' . $row->search_shortcut . '/', '', $query);
            if (preg_match('/^\[|\]$/', $row->search_option)) {
                $option = json_decode($row->search_option);
            } else {
                $option = explode(',', $row->search_option);
            }
        }

        $opt_len = count($opt);
        $len = count($option);
        if ($len > $opt_len) {
            foreach ($option as $key => $value) {
                $val = isset($opt[$key]) ? $opt[$key] : null;
                $opt[$key] = $val ? : $value;
            }
        } else {
            foreach ($opt as $key => $value) {
                $val = isset($option[$key]) ? $option[$key] : null;
                $opt[$key] = $value ? : $val;
            }
        }
        foreach ($opt as $key => $value) {
            $url = preg_replace("/{%$key}/", $value, $url);
        }

        $query = Url::rawEncode($query);
        $url = preg_replace("/%s/", $query, $url);
        echo $html = $GLOBALS['Mr']->template()->render('_skin/search', ['query' => $query, 'url' => $url]);
    }
}
