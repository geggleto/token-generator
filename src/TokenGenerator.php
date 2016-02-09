<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-02-09
 * Time: 11:50 AM
 */

namespace Geggleto\Security;


class TokenGenerator
{
    protected $token_length;

    public function __construct($token_length = 32)
    {
        $this->token_length = $token_length;
    }

    /**
     * @return string
     */
    public function getToken() {
        try {
            $string = random_bytes($this->token_length);

            return bin2hex($string);
        } catch (\TypeError $e) {
            // Well, it's an integer, so this IS unexpected.
            die("An unexpected error has occurred");
        } catch (\Error $e) {
            // This is also unexpected because 32 is a reasonable integer.
            die("An unexpected error has occurred");
        } catch (\Exception $e) {
            // If you get this message, the CSPRNG failed hard.
            die("Could not generate a random string. Is our OS secure?");
        }
    }
}