<?php

namespace Kanboard\Plugin\TargetNew\Helper;

use Kanboard\Core\Base;

class TargetNewHelper extends Base
{
    public function isActive()
    {
        $user = $this->userSession->getAll();

        if(isset($user['base_target']) &&
            $user['base_target'] == 1) {
            return true;
        }
    }
}
