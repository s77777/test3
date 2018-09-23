<?php
/*
 @main class
*/

class Page {

    protected   $args = array();
    protected   $view=APP_PATH_VIEWS;
    protected   $LangPath=APP_PATH_LOCALE;
    protected   $params;
    protected   $db;
    public      $PageData=array();
    protected   $settings=array();
    public      $ViewTemplate=true;
    protected   $Class;
    protected   $action;

    function __construct($db,$params=null)
    {
        $this->db=$db;
        $this->params=$params;
        $this->args=$this->getUri();
        $this->lang=$this->args['lang'];
        $this->isLogin();
    }

    function getContent()
    {
        $this->Class=$this->args['class'];
        $this->method=(($this->args['method']=='index')?'initialize':$this->args['method']);
        $Class = new $this->Class($this->db,$this->args['params']);
        if (in_array($this->method,get_class_methods($this->Class)))
        {
            $data = $Class->{$this->method}();
            if ($Class->GetViewTemplate()){
                $PageData=$Class->getPageData();
                $PageData['fLang']=include(APP_PATH_LOCALE.'lang.php');
                $PageData['Class'] =  $this->Class;
                $PageData['method']=$this->method;
                require_once $this->view.$this->Class.'/'.$this->method.'.tpl';
            } else {
                header('Content-Type:application/json');
                echo json_encode($data);
            }
        }
        else
        {
            header('Location:'.SERVER_NAME.'/'.LANG.'/Index/error');
        }
    }

    function getParams()
    {
      return $this->params;
    }

    protected function forward($uri)
    {
        $uriParts = explode('/', trim($uri, '/\\'));
        $params = array_slice($uriParts, 3);
        return array(
                    'lang'=>(empty($uriParts[0]))?'':$uriParts[0],
                    'class' => (empty($uriParts[1]))?'Index':$uriParts[1],
                    'method' => (!empty($uriParts[2]))?$uriParts[2]:'initialize',
                    'params' => (!empty($params))?$params:null,
                );
    }

    protected function getUri()
    {
        $route = $_GET['_url'];
        return $this->forward(str_replace('.','',$route));
    }

    function setPageData($name,$value)
    {
        $this->PageData[$name] = $value;
    }

    function initPageData($data)
    {
         foreach ($data as $key => $value) {
            $this->setPageData($key, $value);
        }
    }

    function getPageData()
    {
      return $this->PageData;
    }

    function SetViewDisable()
    {
        $this->ViewTemplate=false;
    }

    function GetViewTemplate()
    {
        return $this->ViewTemplate;
    }

    function getClassData($classname)
    {
        return include($this->LangPath.$this->lang.'/'.$classname.'PageData.php');
    }

    function getLangArg()
    {
        return $this->args['lang'];
    }

    function getPostDataJson()
    {
        $str = file_get_contents('php://input');
        $data=json_decode($str,true);
        return $data;
    }

    function getPostData()
    {
        $_POST = array_map(function($value){
            if(is_string($value)){
                return htmlspecialchars($value,ENT_QUOTES, "UTF-8");
            }
            return $value;
        }, $_POST);
        return $_POST;
    }

    private function isLogin()
    {
        $allowed_method=array('register','login','loginform','adduser','getEmailAjax');
        $allowed_class=array('Auth');
        if (in_array($this->args['class'],$allowed_class) &&
                (in_array($this->args['method'],$allowed_method)))
        {
            return true;
        } else if (empty($_SESSION['secret'])) {
            $this->args['class']='Auth';
            $this->args['method']='loginform';
        } else {
            return true;
        }
    }

    function getNameToken($name)
    {
      	$token = md5(uniqid(microtime(), true));
      	$_SESSION[$name] = $token;
       	return $token;
    }

    function validNameToken($name)
    {
        if(empty($_SESSION[$name])) {
            return false;
        }
        if(empty($_POST[$name])) {
            return false;
        }
        if ($_SESSION[$name] !== $_POST[$name]) {
            return false;
        }
        return true;
    }

}
