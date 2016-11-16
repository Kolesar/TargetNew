<?php

namespace Kanboard\Plugin\TargetNew;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;
use Kanboard\Core\Security\AuthenticationManager;
use Kanboard\Event\AuthSuccessEvent;

class Plugin extends Base
{
    private $base_target;

    public function initialize()
    {
        $this->dispatcher->addListener(AuthenticationManager::EVENT_SUCCESS, array($this, 'onLoginSuccess'));

        $this->helper->register('TargetNewHelper', '\Kanboard\Plugin\TargetNew\Helper\TargetNewHelper');
        $this->template->hook->attach('template:user:sidebar:actions', 'TargetNew:user/sidebar/actions');
        $this->template->hook->attach('template:layout:head', 'TargetNew:layout/head');
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }

    public function onLoginSuccess(AuthSuccessEvent $event) {
        $user_id = $this->userSession->getId();
        $user = $this->userModel->getById($user_id);
    }

    public function getClasses()
    {
        return array(
            'Plugin\TargetNew\Model' => array(
                'TargetNew',
            )
        );
    }

    public function getPluginName()
    {
        return 'TargetNew';
    }

    public function getPluginDescription()
    {
        return t('Open all links on Kanboard in new tab');
    }

    public function getPluginAuthor()
    {
        return 'Asim Husanović <asim.husanovic@atom.solutions>';
    }

    public function getPluginVersion()
    {
        return '1.0.0';
    }
}
