<?php

class Auth extends Page {

    private $AuthPageData;

    function initialize()
    {
        $this->AuthPageData=$this->getClassData(get_class($this));
        $this->initPageData($this->AuthPageData);
    }

    function loginform()
    {
        $token=$this->getNameToken('loginform_token');
        $this->setPageData('loginform_token', $token);
        $this->initialize();
    }

    function login()
    {
        if (!$this->validNameToken('loginform_token')){
            header("HTTP/1.0 404 Not Found");
            exit();
        }
        $user=$this->validUser($this->getPostData());
        if (!$user) {
            header('Location:'.SERVER_NAME.'/'.LANG.'/Auth/register');
        } else {
            $_SESSION['secret']=md5('$21@a0'.session_id());
            $_SESSION['id']=$user['id'];
            header('Location:'.SERVER_NAME.'/'.LANG.'/Index/index/'.$user['id']);
        }
    }

    function register()
    {
        $token=$this->getNameToken('register_token');
        $this->setPageData('register_token', $token);
        $this->initialize();
    }

    function getEmailAjax(){
        $this->SetViewDisable();
        $data=$this->getPostDataJson();
        $res=$this->existsEmail($data['email']);
        $data=[];
        if (!$res) {
            $data['success']=true;
        } else {
            $data['success']=false;
        }
        return $data;
    }

    function adduser()
    {
        $this->SetViewDisable();
        $data=$this->getPostData();
        if ($this->validNameToken('register_token'))
        {
            $data['psw']=hash('sha256',$data['psw']);
            $sql='INSERT users(email,psw) VALUES (?,?)';
            $res=$this->db->InsertUpdateData($sql,array($data['email'],$data['psw']));
            if ($res) {
                $_SESSION['secret']=md5('$21@a0'.session_id());
                $_SESSION['id']=$res->lastid;
                header('Location:'.SERVER_NAME.'/'.LANG.'/Index/index/'.$res->lastid);
            }
        }
    }

    private function validUser($data)
    {
        $data['psw']=hash('sha256',$data['psw']);
        $sql='SELECT * FROM users WHERE email=:email and psw=:psw';
        return $this->db->GetRow($sql, ['email'=>$data['email'],'psw'=>$data['psw']]);
    }

    private function existsEmail($email)
    {
        $sql='SELECT * FROM users WHERE email=?';
        return $this->db->GetRow($sql,array($email));
    }
}