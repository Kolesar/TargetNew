<div class="page-header">
    <h2><?= t('Base target') ?></h2>
</div>

<form method="post" action="<?= $this->url->href('TargetNewController', 'save', array('plugin' => 'TargetNew', 'user_id' => $user['id'])) ?>" autocomplete="off" class="form-inline">
    <?= $this->form->csrf() ?>
    <?= $this->form->hidden('plugin', $values) ?>
    <?= $this->form->hidden('controller', $values) ?>
    <?= $this->form->hidden('action', $values) ?>
    <?= $this->form->hidden('user_id', $values) ?>

    <?= $this->form->checkbox('base_target', t('Open all links in new tab'), 1, $values['base_target'] == 1) ?><br><br>

    <input type="submit" value="<?= t('Save') ?>" class="btn btn-blue"/>
</form>
