<?php
/**
 * @title          Various Class
 * @desc           MISC (Miscellaneous Functions) Class.
 *                 Some various useful methods.
 *
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2017, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / Framework / Util
 */

namespace PH7\Framework\Util;

defined('PH7') or exit('Restricted access');

use PH7\Framework\Ip\Ip;
use PH7\Framework\Navigation\Browser;
use PH7\Framework\Str\Str;

class Various
{
    const MAX_LENGTH = 40;

    /**
     * Generate Random.
     *
     * @param string|null $sStr
     * @param int $iLength Default is 40 Characters.
     *
     * @return string
     */
    public static function genRnd($sStr = null, $iLength = self::MAX_LENGTH)
    {
        $sStr = (!empty($sStr)) ? (string)$sStr : '';
        $sChars = hash('whirlpool', hash('whirlpool', uniqid(mt_rand(), true) . $sStr . Ip::get() . time()) . hash('sha512', (new Browser)->getUserAgent() . microtime(true) * 9999));
        return self::padStr($sChars, $iLength);
    }

    /**
     * Padding String.
     *
     * @param string $sStr
     * @param int $iLength
     *
     * @return string
     */
    public static function padStr($sStr, $iLength = self::MAX_LENGTH)
    {
        $iLength = (int)$iLength;
        return ((new Str)->length($sStr) >= $iLength) ? substr($sStr, 0, $iLength) : str_pad($sStr, $iLength, $sStr);
    }

    /**
     * Generate Random Word.
     *
     * @param int $iLength
     *
     * @return string
     */
    public static function genRndWord($iLength)
    {
        $sWord = '';
        $aSpecialChars = ['-', '_', '~', '|', '%', '^', '!', '$', '#', '@', '?'];
        $aKeys = array_merge(range(0, 9), range('a', 'z'), $aSpecialChars);

        for ($i = 0; $i < $iLength; $i++) {
            $sWord .= $aKeys[array_rand($aKeys)];
        }

        return $sWord;
    }
}
