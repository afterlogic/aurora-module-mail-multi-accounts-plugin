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
     * @param int $iUserId
     *
     * @return bool
     */
    public function canCreate($iUserId)
    {
        return true;
    }
}
