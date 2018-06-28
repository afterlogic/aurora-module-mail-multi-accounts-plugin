<?php
/**
 * This code is licensed under AfterLogic Software License.
 * For full statements of the license see LICENSE file.
 */

namespace Aurora\Modules\MailMultiAccountsPlugin;

/**
 * @license https://afterlogic.com/products/common-licensing AfterLogic Software License
 * @copyright Copyright (c) 2018, Afterlogic Corp.
 *
 * @package Modules
 */
class Module extends \Aurora\System\Module\AbstractLicensedModule
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
		$this->oMailModule->oApiAccountsManager = new Manager($this);
		
		return false;
	}
	
	public function onAfterCreateAccount($aArguments, &$mResult)
	{
		$this->oMailModule->oApiAccountsManager = new Manager($this);
		
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
	}
}
