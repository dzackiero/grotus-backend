<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case BCA = "BCA";
    case BRI = "BRI";
    case BNI = "BNI";
    case Mandiri = "Mandiri";
    case COD = "Cash On Delivery";
    case GoPay = "Gopay";
    case OVO = "OVO";

}
