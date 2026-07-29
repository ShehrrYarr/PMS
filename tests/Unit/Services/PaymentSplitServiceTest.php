<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Exceptions\UnbalancedPaymentSplitException;
use App\Services\PaymentSplitService;
use Tests\TestCase;

class PaymentSplitServiceTest extends TestCase
{
    public function test_it_passes_when_payment_lines_sum_to_the_total(): void
    {
        $service = new PaymentSplitService;

        $service->assertBalanced(
            [['amount' => '500.00'], ['amount' => '250.00'], ['amount' => '250.00']],
            '1000.00',
        );

        $this->assertTrue(true);
    }

    public function test_it_throws_when_payment_lines_sum_short_of_the_total(): void
    {
        $service = new PaymentSplitService;

        $this->expectException(UnbalancedPaymentSplitException::class);

        $service->assertBalanced(
            [['amount' => '500.00'], ['amount' => '250.00']],
            '1000.00',
        );
    }

    public function test_it_throws_when_payment_lines_sum_over_the_total(): void
    {
        $service = new PaymentSplitService;

        $this->expectException(UnbalancedPaymentSplitException::class);

        $service->assertBalanced(
            [['amount' => '600.00'], ['amount' => '500.00']],
            '1000.00',
        );
    }

    public function test_it_uses_decimal_safe_comparison_not_floating_point(): void
    {
        $service = new PaymentSplitService;

        // 0.1 + 0.2 famously != 0.3 in binary floating point; bcmath must
        // get this right since rules.md §2 rule 3 forbids float comparison.
        $service->assertBalanced(
            [['amount' => '0.10'], ['amount' => '0.20']],
            '0.30',
        );

        $this->assertTrue(true);
    }
}
