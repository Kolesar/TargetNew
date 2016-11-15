<?php if ($this->user->hasAccess('UserModificationController', 'show')): ?>
    <li <?= $this->app->getRouterController() === 'TargetNewController' ? 'class="active"' : '' ?>>
        <?= $this->url->link(t('Edit GUI Settings'), 'TargetNewController', 'index', array('plugin' => 'TargetNew', 'user_id' => $user['id'])) ?>
    </li>
<?php endif ?>
