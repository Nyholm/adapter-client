<?php

/*
 * This file is part of the Http Adapter Client package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Http\Adapter\AutoDiscovery;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait HttpClientTemplate
{
    /**
     * {@inheritdoc}
     */
    public function get($uri, array $headers = [], array $options = [])
    {
        return $this->send('GET', $uri, $headers, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function head($uri, array $headers = [], array $options = [])
    {
        return $this->send('HEAD', $uri, $headers, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function trace($uri, array $headers = [], array $options = [])
    {
        return $this->send('TRACE', $uri, $headers, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function post($uri, array $headers = [], $data = [], array $files = [], array $options = [])
    {
        return $this->send('POST', $uri, $headers, $data, $files, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function put($uri, array $headers = [], $data = [], array $files = [], array $options = [])
    {
        return $this->send('PUT', $uri, $headers, $data, $files, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function patch($uri, array $headers = [], $data = [], array $files = [], array $options = [])
    {
        return $this->send('PATCH', $uri, $headers, $data, $files, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($uri, array $headers = [], $data = [], array $files = [], array $options = [])
    {
        return $this->send('DELETE', $uri, $headers, $data, $files, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function options($uri, array $headers = [], $data = [], array $files = [], array $options = [])
    {
        return $this->send('OPTIONS', $uri, $headers, $data, $files, $options);
    }

    /**
     * {@inheritdoc}
     */
    abstract public function send($method, $uri, array $headers = [], $data = [], array $files = [], array $options = []);
}
