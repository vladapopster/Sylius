<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Component\Shipping\Calculator\Registry;

use PhpSpec\ObjectBehavior;

/**
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class NonExistingCalculatorExceptionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('custom_calculator');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Component\Shipping\Calculator\Registry\NonExistingCalculatorException');
    }

    function it_is_an_exception()
    {
        $this->shouldHaveType('Exception');
    }

    function it_is_a_invalid_argument_exception()
    {
        $this->shouldHaveType('InvalidArgumentException');
    }
}
