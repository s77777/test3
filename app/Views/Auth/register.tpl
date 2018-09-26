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
      <h3><?php echo $PageData['HeadrRegister'];?></h3>
      <hr/>
      <form action="/<?php echo LANG;?>/Auth/adduser" method="post">
        <div class="form-group">
          <label><?php echo $PageData['email'];?></label>
          <input type="email" name="email" class="form-control" required placeholder="<?php echo $PageData['pemail'];?>">
        </div>
          <input type="hidden" name="register_token" value="<?php echo $PageData['register_token'];?>">
        <div class="form-group">
          <label><?php echo $PageData['psw'];?></label>
          <input type="password" name="psw" class="form-control" required placeholder="<?php echo $PageData['psw'];?>">
        </div>
        <div class="form-group">
          <label><?php echo $PageData['psw2'];?></label>
          <input type="password" name="psw2" class="form-control" required placeholder="<?php echo $PageData['psw2'];?>">
        </div>
          <button type="button" class="btn btn-primary"><?php echo $PageData['register'];?></button>
      </form>
    </div>
  </div>
</div>
<!-- Scripts -->
<?php include_once(APP_PATH_VIEWS .'Jscript.tpl');?>
<script>
    var arrMsg=<?php echo json_encode($PageData['error']);?>;
    var Class='<?php echo $PageData['Class'];?>';
    var locale='<?php echo LANG;?>';
</script>
<script src="/assets/js/register.js"></script>
</body>
</html>


