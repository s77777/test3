<?php


class Index extends Page {

    private $IndexPageData;

    function initialize()
    {
        $this->IndexPageData=$this->getClassData(get_class($this));
        $id=$this->getParams()[0];
        if (empty($id)) $id=$_SESSION['id'];
        $this->IndexPageData['data']= $this->getDataUser($id);
        $this->initPageData($this->IndexPageData);
    }

    function getDataUser($id)
    {
        $sql='SELECT * FROM users WHERE id=?';
        return $this->db->GetRow($sql,[$id]);
    }

    function updateDataUser()
    {
        $this->SetViewDisable();
        if ($_SESSION['secret']==md5('$21@a0'.$_COOKIE['PHPSESSID'])) {
            $data=$this->getPostData();
            $set=[];
            foreach ($data as $key=>$val) {
                $set[]=$key.'=:'.$key;
            }
            $sql='UPDATE users SET '.implode(',',$set).' WHERE id=:id';
            $this->db->InsertUpdateData($sql,$data);
            header('Location:'.SERVER_NAME.'/'.LANG.'/Index/index/'.$data['id']);
        } else {
            header('Location:'.SERVER_NAME.'/'.LANG.'/Auth/loginform');
        }

    }

    function error()
    {
        $this->initialize();
    }
}
