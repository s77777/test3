<!DOCTYPE HTML>
<html lang="<?php echo LANG;?>">
<head>
<title><?php echo $PageData['Title'];?></title>
<?php include_once(APP_PATH_VIEWS .'HeadMeta.tpl');?>
</head>
<body>
<?php include_once(APP_PATH_VIEWS .'Headr.tpl');?>
<div class="container col-sm-6">
    <div class="div-center">
      <h3><?php echo $PageData['Title'];?></h3>
      <hr/>
       <form action="/<?php echo LANG;?>/Index/updateDataUser" method="post">
        <input type="hidden" name="id" value="<?php echo $PageData['data']['id'];?>"/>
        <div class="form-group">
          <label><?php echo $PageData['email'];?></label>
          <input type="email" class="form-control" placeholder="" value="<?php echo $PageData['data']['email'];?>" name="email" required/>
        </div>
        <div class="form-group">
          <label><?php echo $PageData['fname'];?></label>
          <input type="text" name="fname" class="form-control" placeholder="" value="<?php echo $PageData['data']['fname'];?>" required/>
        </div>
        <div class="form-group">
          <label><?php echo $PageData['lname'];?></label>
          <input type="text" name="lname" class="form-control" placeholder="" value="<?php echo $PageData['data']['lname'];?>" required/>
        </div>
        <div class="form-group">
          <label><?php echo $PageData['age'];?></label>
          <input type="text" name="age" class="form-control" placeholder="" onblur="validate.age(this)" value="<?php echo $PageData['data']['age'];?>" required/>
        </div>
        <div class="form-group">
          <label><?php echo $PageData['sex'];?></label>
          <select class="form-control" name="sex">
            <option <?php echo ($PageData['data']['sex']==0?'selected':'');?> value="0"><?php echo $PageData['non'];?></option>
            <option <?php echo ($PageData['data']['sex']==1?'selected':'');?> value="1"><?php echo $PageData['man'];?></option>
            <option <?php echo ($PageData['data']['sex']==2?'selected':'');?>  value="2"><?php echo $PageData['woman'];?></option>
          </select>
        </div>
        <input type="hidden" name="foto" value="<?php echo $PageData['data']['foto'];?>"/>
        <button type="submit" class="btn btn-primary"><?php echo $PageData['save'];?></button>
      </form>
        <div id="uploadfile" class="form-group mt-3">
            <label><?php echo $PageData['foto'];?></label>
            <div class="card-body">
                <img id="userfoto" class="card-img-top" src="/download/<?php echo ($PageData['data']['foto']!=''?$PageData['data']['foto']:'nofoto.png');?>">
                <form class="was-validated">
                    <div class="custom-file">
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="hidden" name="id" value="<?php echo $PageData['data']['id'];?>"/>
                            <input type="file" name="file" class="custom-file-input" value="" required />
                            <label class="custom-file-label"><?php echo $PageData['nofoto'];?></label>
                            <div class="invalid-feedback"><?php echo $PageData['filenotsel'];?></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="form-group mx-3">
                <button class="btn btn-primary" type="buttom" name="Upload"><?php echo $PageData['uploadfile'];?></button>
            </div>
        </div>
    </div>
</div>
<!-- Scripts -->
<?php include_once(APP_PATH_VIEWS .'Jscript.tpl');?>
<script>
    var arrMsg=<?php echo json_encode($PageData['errorjs']);?>;
    var Class='<?php echo $PageData['Class'];?>';
    var locale='<?php echo LANG;?>';
</script>
<script src="/assets/js/Index.js"></script>
</body>
</html>
