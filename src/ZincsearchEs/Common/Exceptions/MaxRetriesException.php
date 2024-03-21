<?php

declare(strict_types = 1);

namespace ZincsearchEs\Common\Exceptions;

/**
 * MaxRetriesException
 *
 * @category ZincsearchEs
 * @package  ZincsearchEs\Common\Exceptions
 * @author   Zachary Tong <zach@elastic.co>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 * @link     http://elastic.co
 */
class MaxRetriesException extends TransportException implements ZincsearchEsException
{
}
