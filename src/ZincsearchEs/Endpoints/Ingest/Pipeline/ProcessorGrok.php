<?php

declare(strict_types = 1);

namespace ZincsearchEs\Endpoints\Ingest\Pipeline;

use ZincsearchEs\Common\Exceptions;
use ZincsearchEs\Endpoints\AbstractEndpoint;

/**
 * Class ProcessorGrok
 *
 * @category ZincsearchEs
 * @package  ZincsearchEs\Endpoints\Ingest
 * @author   Zachary Tong <zach@elastic.co>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 * @link     http://elastic.co
 */
class ProcessorGrok extends AbstractEndpoint
{
    /**
     * @throws \ZincsearchEs\Common\Exceptions\RuntimeException
     * @return string
     */
    public function getURI()
    {
        return "/_ingest/processor/grok";
    }

    /**
     * @return string[]
     */
    public function getParamWhitelist()
    {
        return [];
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'GET';
    }
}
