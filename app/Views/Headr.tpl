<!-- Header -->
<script type="text/javascript">
    var locale = "<?php echo LANG ?>";
    var Class = "<?php echo $PageData['Class'];?>";
</script>
<div class="panel-body my-4 mr-4">
 <div class="btn-group float-right" role="group">
     <a href="/<?=LANG?>/Auth/logout" class="btn btn-secondary"><?php echo $PageData['Main']['logout'];?></a>
    <button id="btnlang" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <?php echo (!empty($PageData['fLang']['langs'][LANG])?$PageData['fLang']['langs'][LANG]:'English')?>
    </button>
    <div class="dropdown-menu" aria-labelledby="btnlang">
        <?php foreach($PageData['fLang']['langs'] as $key=>$value) {?>
            <a href="" class="dropdown-item" rel="<?php echo $key;?>"><?php echo $value;?></a>
        <?php }?>
    </div>
  </div>
</div>
