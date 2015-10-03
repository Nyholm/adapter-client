<?php

/*
 * This file is part of the Http Adapter package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Http\Adapter\AutoDiscovery;

use Http\Adapter\HttpAdapter;
use Http\Discovery\HttpAdapterDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\MessageFactory;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class Client implements HttpAdapter
{
    use HttpClientTemplate;

    /**
     * @var HttpAdapter
     */
    private $adapter;

    /**
     * @var MessageFactory
     */
    private $messageFactory;

    /**
     * @param HttpAdapter|null    $adapter
     * @param MessageFactory|null $messageFactory
     */
    public function __construct(HttpAdapter $adapter = null, MessageFactory $messageFactory = null)
    {
        $this->adapter = $adapter;
        $this->messageFactory = $messageFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function send($method, $uri, array $headers = [], $data = [], array $files = [], array $options = [])
    {
        if ($data instanceof StreamInterface && !empty($files)) {
            throw new \InvalidArgumentException('A data instance of Psr\Http\Message\StreamInterface and $files parameters should not be passed together.');
        }

        $request = $this->getMessageFactory()->createRequest(
            $method,
            $uri,
            isset($options['protocolVersion']) ? $options['protocolVersion'] : '1.1',
            $headers,
            $data
        );

        return $this->sendRequest($request);
    }

    /**
     * {@inheritdoc}
     */
    public function sendRequest(RequestInterface $request, array $options = [])
    {
        return $this->getAdapter()->sendRequest($request, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function sendRequests(array $requests, array $options = [])
    {
        return $this->getAdapter()->sendRequests($requests, $options);

    }

    /**
     * @return HttpAdapter
     */
    public function getAdapter()
    {
        if ($this->adapter === null) {
            $this->adapter = HttpAdapterDiscovery::find();
        }

        return $this->adapter;
    }

    /**
     * @return MessageFactory
     */
    public function getMessageFactory()
    {
        if ($this->messageFactory === null) {
            $this->messageFactory = MessageFactoryDiscovery::find();
        }

        return $this->messageFactory;
    }

    /**
     * @param MessageFactory $messageFactory
     *
     * @return Client
     */
    public function setMessageFactory(MessageFactory$messageFactory)
    {
        $this->messageFactory = $messageFactory;

        return $this;
    }

    /**
     * @param HttpAdapter $adapter
     *
     * @return Client
     */
    public function setAdapter(HttpAdapter $adapter)
    {
        $this->adapter = $adapter;

        return $this;
    }

    public function getName()
    {
        return 'auto-discovery-adapter';
    }
}
