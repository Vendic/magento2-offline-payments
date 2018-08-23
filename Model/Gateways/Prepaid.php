<?php
declare(strict_types=1);

/**
 * @author Tjitse (Vendic)
 * Created on 23-08-18 09:32
 */

namespace Vendic\OfflinePayments\Model\Gateways;

use Vendic\OfflinePayments\Model\Method;

class Prepaid extends Method
{
    protected $_code = 'prepaid';
}