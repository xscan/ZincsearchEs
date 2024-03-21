<?php

declare(strict_types = 1);

namespace ZincsearchEs\Endpoints\Indices;

use ZincsearchEs\Endpoints\AbstractEndpoint;
use ZincsearchEs\Common\Exceptions;

/**
 * Class Analyze
 *
 * @category ZincsearchEs
 * @package  ZincsearchEs\Endpoints\Indices
 * @author   Zachary Tong <zach@elastic.co>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 * @link     http://elastic.co
 */
class Analyze extends AbstractEndpoint
{
    /**
     * @param array $body
     *
     * @throws \ZincsearchEs\Common\Exceptions\InvalidArgumentException
     * @return $this
     */
    public function setBody($body)
    {
        if (isset($body) !== true) {
            return $this;
        }

        $this->body = $body;

        return $this;
    }

    /**
     * @return string
     */
    public function getURI()
    {
        $index = $this->index;
        $uri   = "/_analyze";

        if (isset($index) === true) {
            $uri = "/$index/_analyze";
        }

        return $uri;
    }

    /**
     * @return string[]
     */
    public function getParamWhitelist()
    {
        return array(
            'analyzer',
            'field',
            'filter',
            'index',
            'prefer_local',
            'text',
            'tokenizer',
            'format',
            'char_filter',
            'explain',
            'attributes',
            'format'
        );
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return isset($this->body) ? 'POST' : 'GET';
    }
}
