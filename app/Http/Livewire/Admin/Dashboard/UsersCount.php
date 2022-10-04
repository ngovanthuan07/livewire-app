<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\User;
use Livewire\Component;

class UsersCount extends Component
{
    public $usersCount;

    public function mount() {
        $this->getUsersCount();
    }

    public function getUsersCount($option = 'TODAY') {
        $this->usersCount = User::query()
            -> whereBetween('created_at', $this->getDateRange($option))
            -> count();
    }

    public function getDateRange($option):array {
        switch ($option) {
            case 'TODAY':
                return [now()->today(), now()];
            case 'MTD':
                return [now()->firstOfMonth(), now()];
            case 'YTD':
                return  [now()->firstOfYear(), now()];
            default:
                return [now()->subDays($option), now()];
        }
    }

    public function render()
    {
        return view('livewire.admin.dashboard.users-count');
    }
}
