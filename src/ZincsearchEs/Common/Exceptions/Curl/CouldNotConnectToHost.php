<?php

declare(strict_types = 1);

namespace ZincsearchEs\Common\Exceptions\Curl;

use ZincsearchEs\Common\Exceptions\ZincsearchEsException;
use ZincsearchEs\Common\Exceptions\TransportException;

/**
 * Class CouldNotConnectToHost
 *
 * @category ZincsearchEs
 * @package  ZincsearchEs\Common\Exceptions\Curl
 * @author   Zachary Tong <zach@elastic.co>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 * @link     http://elastic.co
 */
class CouldNotConnectToHost extends TransportException implements ZincsearchEsException
{
}
