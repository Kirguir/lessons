<?php

use Work\Model\Lang;

/* @var $form LoginForm */

?>
<div class="container">
    <div class="row col-sm-6">
        <form class="form-horizontal" method="POST" action="index.php?action=login" id="registration-form"
              enctype="multipart/form-data" onsubmit="return checkForm()">
            <div class="panel panel-primary">
                <div class="panel-heading"><?= Lang::t('login info') ?></div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label"><?= Lang::t('email') ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" name="email" value="<?= $form->email ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label"><?= Lang::t('password') ?></label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary"><?= Lang::t('login') ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var errors = '<?= json_encode($form->errors())?>';
        var hint = <?= json_encode($form->getHints()) ?>;
        var tips = <?= json_encode($form->getTips()) ?>;

        init(errors, hint, tips);
    });
</script>