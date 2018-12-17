<?php

use work\model\RegistrationForm;
use work\model\Lang;
use work\model\FamilyStatus;

/* @var $form RegistrationForm */

?>
<div class="container">
    <div class="row col-sm-8">
        <form class="form-horizontal" method="POST" action="index.php?action=reg" id="registration-form"
              enctype="multipart/form-data" onsubmit="return checkForm()">
            <div class="panel panel-primary">
                <div class="panel-heading"><?= Lang::t('contact info') ?></div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="family" class="col-sm-4 control-label"><?= Lang::t('family') ?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="family" name="family"
                                   value="<?= $form->family ?>">
                            <span id="error-family" class="help-block hidden"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="col-sm-4 control-label"><?= Lang::t('firstname') ?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="firstname" name="firstname"
                                   value="<?= $form->firstname ?>">
                            <span id="error-firstname" class="help-block hidden"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-sm-4 control-label"><?= Lang::t('lastname') ?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="lastname" name="lastname"
                                   value="<?= $form->lastname ?>">
                            <span id="error-lastname" class="help-block hidden"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="photo" class="col-sm-4 control-label"><?= Lang::t('photo') ?></label>
                        <div class="col-sm-6">
                            <input type="file" id="photo" name="photo">
                            <span id="error-" class="help-block hidden"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city" class="col-sm-4 control-label"><?= Lang::t('city') ?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="city" name="city" value="<?= $form->city ?>">
                            <span id="error-city" class="help-block hidden"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?= Lang::t('birthday') ?></label>
                        <div class='col-sm-6'>
                            <div class="row">
                                <div class="col-sm-4">
                                    <select id="day" name="day" class="form-control">
                                        <option value='0'><?= Lang::t('day') ?></option>
                                        <?php for ($i = 1; $i < 32; $i++) {
                                            $selected = $i == $form->day ? 'selected' : '';
                                            echo "<option {$selected} value='{$i}'>{$i}</option>";
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <select id="month" name="month" class="form-control">
                                        <option value='0'><?= Lang::t('month') ?></option>
                                        <?php foreach (RegistrationForm::getMonth() as $month => $value) {
                                            $selected = $month == $form->month ? 'selected' : '';
                                            echo "<option {$selected} value='{$month}'>{$value}</option>";
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <select id="year" name="year" class="form-control">
                                        <option value='0'><?= Lang::t('year') ?></option>
                                        <?php
                                        $minYear = RegistrationForm::getMinYear();
                                        for ($i = $minYear; $i > $minYear - 50; $i--) {
                                            $selected = $i == $form->year ? 'selected' : '';
                                            echo "<option {$selected} value='{$i}'>{$i}</option>";
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <span id="error-birthday" class="help-block hidden"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?= Lang::t('status') ?></label>
                        <div class="col-sm-4">
                            <select id="status" name="status" class="form-control">
                                <?php foreach (FamilyStatus::getStatuses() as $status_id => $status_name) {
                                    $selected = $status_id == $form->status ? 'selected' : '';
                                    echo "<option {$selected} value='{$status_id}'>{$status_name}</option>";
                                } ?>
                            </select>
                            <span id="error-status" class="help-block hidden"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-4 control-label"><?= Lang::t('email') ?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="email" name="email" value="<?= $form->email ?>">
                            <span id="error-email" class="help-block hidden"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-4 control-label"><?= Lang::t('phone') ?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="phone" name="phone" value="<?= $form->phone ?>">
                            <span id="error-phone" class="help-block hidden"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-4 control-label"><?= Lang::t('password') ?></label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="password" name="password" value="">
                            <span id="error-password" class="help-block hidden"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading"><?= Lang::t('work info') ?></div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="company" class="col-sm-4 control-label"><?= Lang::t('company') ?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="company" name="company"
                                   value="<?= $form->company ?>">
                            <span id="error-company" class="help-block hidden"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="position" class="col-sm-4 control-label"><?= Lang::t('position') ?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="position" name="position"
                                   value="<?= $form->position ?>">
                            <span id="error-position" class="help-block hidden"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?= Lang::t('w_start_date') ?></label>
                        <div class='col-sm-6'>
                            <div class="row">
                                <div class="col-sm-6">
                                    <select id="w_start_month" name="w_start_month" class="form-control">
                                        <option value='0'><?= Lang::t('month') ?></option>
                                        <?php foreach (RegistrationForm::getMonth() as $month => $value) {
                                            $selected = $month == $form->w_start_month ? 'selected' : '';
                                            echo "<option {$selected} value='{$month}'>{$value}</option>";
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <select id="w_start_year" name="w_start_year" class="form-control">
                                        <option value='0'><?= Lang::t('year') ?></option>
                                        <?php
                                        $minYear = date('Y');
                                        for ($i = $minYear; $i > $minYear - 50; $i--) {
                                            $selected = $i == $form->w_start_year ? 'selected' : '';
                                            echo "<option {$selected} value='{$i}'>{$i}</option>";
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <span id="error-w_start_date" class="help-block hidden"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?= Lang::t('w_end_date') ?></label>
                        <div class='col-sm-6'>
                            <div class="row">
                                <div class="col-sm-6">
                                    <select id="w_end_month" name="w_end_month" class="form-control">
                                        <option value='0'><?= Lang::t('month') ?></option>
                                        <?php foreach (RegistrationForm::getMonth() as $month => $value) {
                                            $selected = $month == $form->w_end_month ? 'selected' : '';
                                            echo "<option {$selected} value='{$month}'>{$value}</option>";
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <select id="w_end_year" name="w_end_year" class="form-control">
                                        <option value='0'><?= Lang::t('year') ?></option>
                                        <?php
                                        $minYear = date('Y');
                                        for ($i = $minYear; $i > $minYear - 50; $i--) {
                                            $selected = $i == $form->w_end_year ? 'selected' : '';
                                            echo "<option {$selected} value='{$i}'>{$i}</option>";
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <span id="error-w_end_date" class="help-block hidden"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading"><?= Lang::t('education info') ?></div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="institut" class="col-sm-4 control-label"><?= Lang::t('institut') ?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="institut" name="institut"
                                   value="<?= $form->institut ?>">
                            <span id="error-institut" class="help-block hidden"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="faculty" class="col-sm-4 control-label"><?= Lang::t('faculty') ?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="faculty" name="faculty"
                                   value="<?= $form->faculty ?>">
                            <span id="error-faculty" class="help-block hidden"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?= Lang::t('e_start_date') ?></label>
                        <div class='col-sm-6'>
                            <div class="row">
                                <div class="col-sm-6">
                                    <select id="e_start_month" name="e_start_month" class="form-control">
                                        <option value='0'><?= Lang::t('month') ?></option>
                                        <?php foreach (RegistrationForm::getMonth() as $month => $value) {
                                            $selected = $month == $form->e_start_month ? 'selected' : '';
                                            echo "<option {$selected} value='{$month}'>{$value}</option>";
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <select id="e_start_year" name="e_start_year" class="form-control">
                                        <option value='0'><?= Lang::t('year') ?></option>
                                        <?php
                                        $minYear = date('Y');
                                        for ($i = $minYear; $i > $minYear - 50; $i--) {
                                            $selected = $i == $form->e_start_year ? 'selected' : '';
                                            echo "<option {$selected} value='{$i}'>{$i}</option>";
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <span id="error-e_start_date" class="help-block hidden"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?= Lang::t('e_end_date') ?></label>
                        <div class='col-sm-6'>
                            <div class="row">
                                <div class="col-sm-6">
                                    <select id="e_end_month" name="e_end_month" class="form-control">
                                        <option value='0'><?= Lang::t('month') ?></option>
                                        <?php foreach (RegistrationForm::getMonth() as $month => $value) {
                                            $selected = $month == $form->e_end_month ? 'selected' : '';
                                            echo "<option {$selected} value='{$month}'>{$value}</option>";
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <select id="e_end_year" name="e_end_year" class="form-control">
                                        <option value='0'><?= Lang::t('year') ?></option>
                                        <?php
                                        $minYear = date('Y');
                                        for ($i = $minYear; $i > $minYear - 50; $i--) {
                                            $selected = $i == $form->e_end_year ? 'selected' : '';
                                            echo "<option {$selected} value='{$i}'>{$i}</option>";
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <span id="error-e_end_date" class="help-block hidden"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-6">
                            <button type="submit" class="btn btn-default"><?= Lang::t('Registration') ?></button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var errors = <?= json_encode($form->errors())?>;
        var hint = <?= json_encode($form->getHints()) ?>;
        var tips = <?= json_encode($form->getTips()) ?>;

        init(errors, hint, tips);
    });
</script>
