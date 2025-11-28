<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\ActivityStatus;
use App\Enums\Roles;
use App\Enums\TicketStatus;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

final class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): View
    {
        $agentRoleId = Role::where('name', Roles::AGENT->value)->value('id');
        $customerRoleId = Role::where('name', Roles::CUSTOMER->value)->value('id');

        return view('dashboard.admin.analytics', [
            'totalCustomers' => User::where('role_id', $customerRoleId)->count(),
            'totalAgents' => User::where('role_id', $agentRoleId)->count(),
            'onlineCustomers' => User::where('status', ActivityStatus::ONLINE->value)->count(),
            'onlineAgents' => User::where('status', ActivityStatus::ONLINE->value)->count(),
            'totalTickets' => Ticket::count(),
            'openTickets' => Ticket::where('status', TicketStatus::OPEN->value)->count(),
            'inProgressTickets' => Ticket::where('status', TicketStatus::IN_PROGRESS->value)->count(),
            'resolvedTickets' => Ticket::where('status', TicketStatus::RESOLVED->value)->count(),
            'closedTickets' => Ticket::where('status', TicketStatus::CLOSED->value)->count(),
            'agentTotalTickets' => Ticket::where('agent_id', Auth::id())->count(),
            'agentTotalResolvedTickets' => Ticket::where('agent_id', Auth::id())
                ->where('status', TicketStatus::RESOLVED->value)
                ->count(),
        ]);
    }
}
