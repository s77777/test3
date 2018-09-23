<!DOCTYPE HTML>
<html lang="<?php echo LANG;?>">
<head>
<title><?php echo $PageData['Title'];?></title>
<?php include_once(APP_PATH_VIEWS .'HeadMeta.tpl');?>
<meta http-equiv="Cache-Control" content="no-cache" />
</head>
<body>
<?php include_once(APP_PATH_VIEWS .'Headr.tpl');?>
<div class="container col-sm-6">
  <div class="div-center">
    <div class="content">
      <h3><?php echo $PageData['Headr'];?></h3>
      <hr/>
      <form action="/<?php echo LANG;?>/Auth/login" method="post">
        <div class="form-group">
          <label><?php echo $PageData['email'];?></label>
          <input type="email" name="email" class="form-control" required placeholder="<?php echo $PageData['pemail'];?>">
        </div>
          <input type="hidden" name="loginform_token" value="<?php echo $PageData['loginform_token'];?>">
        <div class="form-group">
          <label><?php echo $PageData['psw'];?></label>
          <input type="password" name="psw" class="form-control" required placeholder="<?php echo $PageData['psw'];?>">
        </div>
        <button type="submit" class="btn btn-primary"><?php echo $PageData['Headr'];?></button>
        <hr/>
        <a href="/<?php echo LANG;?>/Auth/register" class="btn btn-link"><?php echo $PageData['singup'];?></a>
      </form>
    </div>
  </div>
</div>
<!-- Scripts -->
<?php include_once(APP_PATH_VIEWS .'Jscript.tpl');?>
</body>
</html>

