<?php

namespace Kanboard\Plugin\TargetNew\Controller;

use Kanboard\Controller\BaseController;

/**
 * TargetNew controller
 *
 * @package  controller
 * @author   Asim Husanovic <asim.husanovic@atom.solutions>
 */
class TargetNewController extends BaseController
{
    /**
     * Display info page for GUI Settings
     *
     * @access public
     */
    public function index()
    {
        $user = $this->getUser();

        $this->response->html($this->helper->layout->user('TargetNew:TargetNew/index', array(
            'user' => $user,
            'values' => array(
                'plugin' => 'TargetNew',
                'controller' => 'TargetNewController',
                'action' => 'index',
                'user_id' => $user['id'],
                'base_target' => $user['base_target'],
            ),
        )));
    }

    /**
     * Save changes on GUI Settings
     *
     * @access public
     */
    public function save()
    {
        $user = $this->getUser();
        $values = $this->request->getValues();

        if(isset($values['base_target'])) {
            $user['base_target'] = $values['base_target'];
        } else {
            $user['base_target'] = 0;
        }
        unset($user['password']);

        list($valid, $errors) = $this->userValidator->validateModification($user);

        if ($valid) {
            if ($this->userModel->update($user)) {
                $this->flash->success(t('User GUI settings updated successfully.'));
            } else {
                $this->flash->failure(t('Unable GUI settings to update your user.'));
            }

            return $this->response->redirect($this->helper->url->to('TargetNewController', 'index', array('plugin' => 'TargetNew', 'user_id' => $user['id'])));
        }
    }
}
