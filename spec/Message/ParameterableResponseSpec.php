<?php

namespace spec\Http\Adapter\Message;

use Psr\Http\Message\ResponseInterface;
use PhpSpec\ObjectBehavior;

class ParameterableResponseSpec extends ObjectBehavior
{
    function let(ResponseInterface $response)
    {
        $this->beConstructedWith($response);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Http\Adapter\Message\ParameterableResponse');
    }

    function it_is_a_response()
    {
        $this->shouldImplement('Psr\Http\Message\ResponseInterface');
    }

    function it_is_a_parameterable_message()
    {
        $this->shouldImplement('Http\Client\Message\Parameterable');
    }
}
