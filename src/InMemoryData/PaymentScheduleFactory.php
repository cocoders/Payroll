<?php

namespace InMemoryData;

use Entity\Employee\PaymentScheduleFactory as BaseFactory;

class PaymentScheduleFactory implements BaseFactory
{
    public function make($classification)
    {
        switch ($classification) {
            case 'monthly':
                return new MonthlySchedule();
            case 'weekly':
                return new WeeklySchedule();
            case 'biweekly':
                return new BiweeklySchedule();
        }
    }
}
