<?php

declare(strict_types = 1);

namespace ZincsearchEs\Endpoints;

use ZincsearchEs\Common\Exceptions;

/**
 * Class UpdateByQuery
 *
 * @category ZincsearchEs
 * @package ZincsearchEs\Endpoints *
 * @author   Zachary Tong <zachary.tong@ZincsearchEs.com>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 * @link     http://ZincsearchEs.org
 */
class UpdateByQuery extends AbstractEndpoint
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

        if (is_array($body) !== true) {
            throw new Exceptions\InvalidArgumentException(
                'Body must be an array'
            );
        }
        $this->body = $body;

        return $this;
    }


    /**
     * @throws \ZincsearchEs\Common\Exceptions\BadMethodCallException
     * @return string
     */
    public function getURI()
    {
        if (!$this->index) {
            throw new Exceptions\RuntimeException(
                'index is required for UpdateByQuery'
            );
        }

        $uri = "/{$this->index}/_update_by_query";
        if ($this->type) {
            $uri = "/{$this->index}/{$this->type}/_update_by_query";
        }

        return $uri;
    }


    /**
     * @return string[]
     */
    public function getParamWhitelist()
    {
        return [
            'analyzer',
            'analyze_wildcard',
            'default_operator',
            'df',
            'explain',
            'fields',
            'fielddata_fields',
            'from',
            'ignore_unavailable',
            'allow_no_indices',
            'conflicts',
            'expand_wildcards',
            'lenient',
            'lowercase_expanded_terms',
            'preference',
            'q',
            'routing',
            'scroll',
            'search_type',
            'search_timeout',
            'size',
            'sort',
            '_source',
            '_source_include',
            '_source_includes',
            '_source_exclude',
            '_source_excludes',
            'terminate_after',
            'stats',
            'suggest_field',
            'suggest_mode',
            'suggest_size',
            'suggest_text',
            'timeout',
            'track_scores',
            'version',
            'version_type',
            'request_cache',
            'request_per_second',
            'slices',
            'refresh',
            'consistency',
            'scroll_size',
            'wait_for_completion',
            'wait_for_active_shards',
            'pipeline'
        ];
    }


    /**
     * @return string
     */
    public function getMethod()
    {
        return 'POST';
    }
}
