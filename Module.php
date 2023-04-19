<?php
/**
 * This code is licensed under Afterlogic Software License.
 * For full statements of the license see LICENSE file.
 */

namespace Aurora\Modules\MailMultiAccountsPlugin;

use Aurora\Modules\Mail\Module as MailModule;

/**
 * @license https://afterlogic.com/products/common-licensing Afterlogic Software License
 * @copyright Copyright (c) 2023, Afterlogic Corp.
 *
 * @package Modules
 */
class Module extends \Aurora\System\Module\AbstractLicensedModule
{
    public function init()
    {
        $this->subscribeEvent('Mail::CreateAccount::before', array($this, 'onBeforeCreateAccount'));
        $this->subscribeEvent('Mail::CreateAccount::after', array($this, 'onAfterCreateAccount'));

        $this->subscribeEvent('Mail::GetSettings::after', array($this, 'onAfterGetSettings'));
    }

    /**
     *
     * @return Module
     */
    public static function Decorator()
    {
        return parent::Decorator();
    }

    /**
     *
     * @return Settings
     */
    public function getModuleSettings()
    {
        return $this->oModuleSettings;
    }

    public function onBeforeCreateAccount($aArguments, &$mResult)
    {
        MailModule::getInstance()->setAccountsManager(new Manager($this));

        return false;
    }

    public function onAfterCreateAccount($aArguments, &$mResult)
    {
        MailModule::getInstance()->setAccountsManager(new Manager($this));

        return false;
    }

    /**
     *
     * @param array $aArguments
     * @param mixed $mResult
     */
    public function onAfterGetSettings($aArguments, &$mResult)
    {
        $mResult['AllowMultiAccounts'] = true;

        return false;
    }
}
