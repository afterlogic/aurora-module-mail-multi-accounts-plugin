<?php
/**
 * @copyright Copyright (c) 2017, Afterlogic Corp.
 * @license AfterLogic Software License
 *
 * This code is licensed under AfterLogic Software License.
 * For full license statement see the LICENSE file.
 */

namespace Aurora\Modules\MailMultiAccountsPlugin;

/**
 * @package Modules
 */
class Module extends \Aurora\System\Module\AbstractModule
{
	public function init() 
	{
		$this->oMailModule = \Aurora\System\Api::GetModule('Mail');
	
		$this->subscribeEvent('Mail::CreateAccount::before', array($this, 'onBeforeCreateAccount'));
		$this->subscribeEvent('Mail::CreateAccount::after', array($this, 'onAfterCreateAccount'));
		
		$this->subscribeEvent('Mail::GetSettings::after', array($this, 'onAfterGetSettings'));
	}
	
	public function onBeforeCreateAccount($aArguments, &$mResult)
	{
		$this->oMailModule->oApiAccountsManager = $this->GetManager('accounts');
		
		return false;
	}
	
	public function onAfterCreateAccount($aArguments, &$mResult)
	{
		$this->oMailModule->oApiAccountsManager = $this->oMailModule->GetManager('accounts');
		
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
