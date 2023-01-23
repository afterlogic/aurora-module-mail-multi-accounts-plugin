<?php
/**
 * This code is licensed under Afterlogic Software License.
 * For full statements of the license see LICENSE file.
 */

namespace Aurora\Modules\MailMultiAccountsPlugin;

/**
 * @license https://afterlogic.com/products/common-licensing Afterlogic Software License
 * @copyright Copyright (c) 2023, Afterlogic Corp.
 */
class Manager extends \Aurora\Modules\Mail\Managers\Accounts\Manager
{
	/**
	 * @param \Aurora\Modules\Mail\Models\MailAccount $oAccount
	 *
	 * @return bool
	 */
	public function createAccount (\Aurora\Modules\Mail\Models\MailAccount &$oAccount)
	{
		$bResult = false;

		if ($oAccount->validate())
		{
			if (!$this->isExists($oAccount))
			{
				if (!$oAccount->save())
				{
					throw new \Aurora\System\Exceptions\ManagerException(\Aurora\System\Exceptions\Errs::UserManager_AccountCreateFailed);
				}
			}
			else
			{
				throw new \Aurora\System\Exceptions\ApiException(\Aurora\System\Notifications::AccountExists);
			}
		}

		$bResult = true;

		return $bResult;
	}
}
