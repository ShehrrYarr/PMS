<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\DiscountCalculator;
use Tests\TestCase;

class DiscountCalculatorTest extends TestCase
{
    public function test_no_discount_type_returns_zero(): void
    {
        $calculator = new DiscountCalculator;

        $this->assertSame('0.00', $calculator->amount('1000.00', null, '50'));
    }

    public function test_no_discount_value_returns_zero(): void
    {
        $calculator = new DiscountCalculator;

        $this->assertSame('0.00', $calculator->amount('1000.00', 'flat', null));
    }

    public function test_a_flat_discount_returns_the_value_as_is(): void
    {
        $calculator = new DiscountCalculator;

        $this->assertSame('150.00', $calculator->amount('1000.00', 'flat', '150.00'));
    }

    public function test_a_percentage_discount_computes_the_pkr_amount(): void
    {
        $calculator = new DiscountCalculator;

        $this->assertSame('100.00', $calculator->amount('1000.00', 'percentage', '10'));
    }

    /**
     * bcdiv truncates rather than rounds — 15.50% of 3333.00 is mathematically
     * 516.615, which must truncate to 516.61, not round to 516.62.
     */
    public function test_a_percentage_discount_truncates_rather_than_rounds(): void
    {
        $calculator = new DiscountCalculator;

        $this->assertSame('516.61', $calculator->amount('3333.00', 'percentage', '15.50'));
    }

    public function test_a_full_percentage_discount_equals_the_whole_subtotal(): void
    {
        $calculator = new DiscountCalculator;

        $this->assertSame('1000.00', $calculator->amount('1000.00', 'percentage', '100'));
    }
}
