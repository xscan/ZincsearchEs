<?php

declare(strict_types = 1);

namespace ZincsearchEs\Common\Exceptions;

/**
 * RoutingMissingException, thrown on when a routing value is required but
 * not provided
 *
 * @category ZincsearchEs
 * @package  ZincsearchEs\Common\Exceptions
 * @author   Zachary Tong <zach@elastic.co>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 * @link     http://elastic.co
 */
class RoutingMissingException extends ServerErrorResponseException implements ZincsearchEsException
{
}
