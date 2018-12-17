<?php
namespace work\view;

use work\model\Lang;
use work\model\FamilyStatus;

/* @var $user \work\model\User */
/* @var $works \work\model\Work[] */
/* @var $educations \work\model\Education[] */

?>

<div class="container">
    <div class="row profile">
        <?php if (!$user):
            echo '<div class="alert alert-danger" role="alert">' . Lang::t('User not found') . '</div>';
        else: ?>
            <div class='col-sm-4'>
                <div class="panel panel-primary">
                    <div class="panel-heading"><?= Lang::t('contact info') ?></div>
                    <div class="panel-body">
                        <dl>
                            <dt><?= Lang::t('photo') ?></dt>
                            <?php if ($user->photo) { ?>
                                <dd><img src='/assets/img/<?= $user->photo; ?>'></dd>
                            <?php } else { ?>
                                <dd><?= Lang::t('Foto not found') ?></dd>
                            <?php } ?>
                            <dt><?= Lang::t('fio') ?></dt>
                            <dd><?= implode(' ', [$user->family, $user->firstname, $user->lastname]); ?></dd>
                            <dt><?= Lang::t('birthday') ?></dt>
                            <dd><?= date('d.m.Y', strtotime($user->birthday)); ?></dd>
                            <dt><?= Lang::t('city') ?></dt>
                            <dd><?= $user->city; ?></dd>
                            <dt><?= Lang::t('status') ?></dt>
                            <dd><?= FamilyStatus::getStatuses($user->status); ?></dd>
                            <dt><?= Lang::t('phone') ?></dt>
                            <dd><?= $user->phone; ?></dd>
                            <dt><?= Lang::t('email') ?></dt>
                            <dd><?= $user->email; ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class='col-sm-4'>
                <div class="panel panel-primary">
                    <div class="panel-heading"><?= Lang::t('work info') ?></div>
                    <div class="panel-body">
                        <?php foreach ($works as $work) : ?>
                            <dl>
                                <dt><?= Lang::t('company') ?></dt>
                                <dd><?= $work->company; ?></dd>
                                <dt><?= Lang::t('position') ?></dt>
                                <dd><?= $work->position; ?></dd>
                                <dt><?= Lang::t('w_start_date') ?></dt>
                                <dd><?= date('d.m.Y', strtotime($works->w_start_date)); ?></dd>
                                <dt><?= Lang::t('w_start_date') ?></dt>
                                <dd><?= date('d.m.Y', strtotime($work->w_end_date)); ?></dd>
                            </dl>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="panel panel-primary">
                    <div class="panel-heading"><?= Lang::t('education info') ?></div>
                    <div class="panel-body">
                        <?php foreach ($educations as $education) : ?>
                            <dl>
                                <dt><?= Lang::t('institut') ?></dt>
                                <dd><?= $education->institut; ?></dd>
                                <dt><?= Lang::t('faculty') ?></dt>
                                <dd><?= $education->faculty; ?></dd>
                                <dt><?= Lang::t('e_start_date') ?></dt>
                                <dd><?= date('d.m.Y', strtotime($education->e_start_date)); ?></dd>
                                <dt><?= Lang::t('e_start_date') ?></dt>
                                <dd><?= date('d.m.Y', strtotime($education->e_end_date)); ?></dd>
                            </dl>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>
