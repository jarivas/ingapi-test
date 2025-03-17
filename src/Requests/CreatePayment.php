<?php

declare(strict_types=1);

namespace INGApi\Requests;

use INGApi\Currency;
use Carbon\Carbon;
use JsonSerializable;

class CreatePayment implements JsonSerializable
{


    public function __construct(
        private readonly float $amount,
        private readonly Currency $currency,
        private readonly string $purchasePrefix,
        private readonly string $description,
        private readonly string $callbackUrl,
        private readonly float $minutes=10,
        private readonly int $maximumAllowedPayments=1)
    {

    }//end __construct()


    /**
     * Summary of toArray
     * @return array{fixedAmount: array{value: float, currency: 'EUR'|'USD'},validUntil: string, maximumAllowedPayments: int, purchaseId: non-empty-string, description: string, returnUrl: string}
     */
    public function toArray(): array
    {
        $validUntil = Carbon::now()->addMinutes($this->minutes)->toRfc3339String(true);

        return [
            'fixedAmount'            => [
                'value'    => $this->amount,
                'currency' => $this->currency->value,
            ],
            'validUntil'             => $validUntil,
            'maximumAllowedPayments' => $this->maximumAllowedPayments,
            'purchaseId'             => uniqid($this->purchasePrefix),
            'description'            => $this->description,
            'returnUrl'              => $this->callbackUrl,
        ];

    }//end toArray()


    public function toJson(): string|false
    {
        return json_encode($this);

    }//end toJson()


    public function jsonSerialize(): mixed
    {
        return $this->toArray();

    }//end jsonSerialize()


}//end class
