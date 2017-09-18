<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16.09.2017
 * Time: 23:11
 */

namespace Leocata\M1\Tests;

use Leocata\M1\Api;

class ApiTest extends \PHPUnit_Framework_TestCase
{

}

$bot = new Api('token');
$bot::connect();
