<?php

namespace App\Enums;

enum TransactionStatus: string
{
    case WAITING_PAYMENT = "Waiting For Payment";
    case SHIPPED = "Shipped";
    case COMPLETED = "Completed";
}
