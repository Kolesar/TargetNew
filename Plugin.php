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
$gg = $this->userSession->getAll();
// // print_r($this->userSession);
// $this->logger->debug($gg);
        $this->dispatcher->addListener(AuthenticationManager::EVENT_SUCCESS, array($this, 'onLoginSuccess'));
        $this->helper->register('TargetNewHelper', '\Kanboard\Plugin\TargetNew\Helper\TargetNewHelper');
        $this->template->hook->attach('template:user:sidebar:actions', 'TargetNew:user/sidebar/actions');

// $this->logger->debug(" ==================================");
// $this->logger->debug($this->base_target);
//         if ($this->base_target == 1) {
// $this->logger->debug(" -------------------------------------------------------------------------------");
            $this->template->hook->attach('template:layout:head', 'TargetNew:layout/head');
//         }

    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }

    public function onLoginSuccess(AuthSuccessEvent $event) {
        $user_id = $this->userSession->getId();
        $user = $this->userModel->getById($user_id);

//         if(isset($user['base_target'])) {
// $this->logger->debug(" ++++++++++++++++++++++++++++");
//             $this->base_target = $user['base_target'];
//         }
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
