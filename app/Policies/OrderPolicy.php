<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
// app/Policies/OrderPolicy.php

    public function update(User $user, Order $order) {
        // Only allow the update if the user's company ID matches the order's company ID
        return $user->company_id === $order->company_id;
    }

}
