<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Messages extends Component
{
    public $chat;



    public function render()
    {
        return view('livewire.messages');
    }

}
