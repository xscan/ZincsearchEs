<?php

declare(strict_types = 1);

namespace ZincsearchEs\Endpoints\Indices\Mapping;

use ZincsearchEs\Endpoints\AbstractEndpoint;
use ZincsearchEs\Common\Exceptions;

/**
 * Class Put
 *
 * @category ZincsearchEs
 * @package  ZincsearchEs\Endpoints\Indices\Mapping
 * @author   Zachary Tong <zach@elastic.co>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 * @link     http://elastic.co
 */
class Put extends AbstractEndpoint
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
     * @throws \ZincsearchEs\Common\Exceptions\RuntimeException
     * @return string
     */
    public function getURI()
    {
        $index = $this->index ?? null;
        $type = $this->type ?? null;

        if (null === $index && $type === $index) {
            throw new Exceptions\RuntimeException(
                'type or index are required for Put'
            );
        }
        $uri = '';
        if (null !== $index) {
            $uri = "/$index";
        }
        $uri .= '/_mapping';
        if (null !== $type) {
            $uri .= "/$type";
        }

        return $uri;
    }

    /**
     * @return string[]
     */
    public function getParamWhitelist()
    {
        return array(
            'ignore_conflicts',
            'timeout',
            'master_timeout',
            'ignore_unavailable',
            'allow_no_indices',
            'expand_wildcards',
            'update_all_types',
            'include_type_name'
        );
    }

    /**
     * @return array
     * @throws \ZincsearchEs\Common\Exceptions\RuntimeException
     */
    public function getBody()
    {
        if (isset($this->body) !== true) {
            throw new Exceptions\RuntimeException('Body is required for Put Mapping');
        }

        return $this->body;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'PUT';
    }
}
