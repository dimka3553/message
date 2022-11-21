<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SidebarChats extends Component
{
    public $activechat;
    public $user;
    public function render()
    {
        return view('livewire.sidebar-chats');
    }
}
