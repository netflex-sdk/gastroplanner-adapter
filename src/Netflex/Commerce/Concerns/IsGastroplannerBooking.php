<?php

namespace Netflex\Commerce\Concerns;

use DateTimeInterface;

use Netflex\Commerce\Order;
use Netflex\Customers\Customer;

use Gastroplanner\Contracts\GastroplannerBooking;
use Gastroplanner\Contracts\GastroplannerCustomer;
use Gastroplanner\Facades\Gastroplanner;

trait IsGastroplannerBooking
{
    public static function bootIsGastroplannerBooking()
    {
        assert_trait_class_compatiblity(IsGastroplannerBooking::class, static::class, Order::class);
        assert_trait_interface_compatiblity(IsGastroplannerBooking::class, static::class, GastroplannerBooking::class);
    }

    public function getId(): int
    {
        /** @var Order $this */
        return (int) $this->data->gastroplannerBookingId ?? 0;
    }

    public function createGastroplannerBooking(DateTimeInterface $date, $seatingTime, $numberOfGuests, $enquiry = false, ?string $note = null): bool
    {
        /** @var Order $this */

        /** @var Customer|null $customer */
        $customer = Customer::find($this->customer_id);

        if (!($customer instanceof GastroplannerCustomer)) {
            $customer = null;
        }

        $time = $date->format('H:i');

        $booking = Gastroplanner::createBooking($date, $time, (int) $seatingTime, (int) $numberOfGuests, $customer, null, (bool) $enquiry, null, false, true, $note);

        if ($booking) {
            $this->addData('gastroplannerBookingId', $booking->getId());
            return true;
        }

        return false;
    }

    public function cancelGastroplannerBooking(): bool
    {
        /** @var GastroplannerBooking $this */

        if ($this->getId()) {
            return Gastroplanner::cancelBooking($this);
        }

        return false;
    }
}
