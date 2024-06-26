<?php

declare(strict_types = 1);

namespace ZincsearchEs\Common\Exceptions;

/**
 * ScriptLangNotSupportedException
 *
 * @category ZincsearchEs
 * @package  ZincsearchEs\Common\Exceptions
 * @author   Zachary Tong <zach@elastic.co>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 * @link     http://elastic.co
 */
class ScriptLangNotSupportedException extends BadRequest400Exception implements ZincsearchEsException
{
}
