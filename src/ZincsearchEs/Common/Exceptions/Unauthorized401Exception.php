<?php

declare(strict_types = 1);

namespace ZincsearchEs\Common\Exceptions;

/**
 * Unauthorized401Exception, thrown on 401 unauthorized http error
 *
 * @category ZincsearchEs
 * @package  ZincsearchEs\Common\Exceptions
 * @author   Zachary Tong <zach@elastic.co>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 * @link     http://elastic.co
 */
class Unauthorized401Exception extends \Exception implements ZincsearchEsException
{
}
