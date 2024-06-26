<?php

namespace App\Livewire\Chat;

use Livewire\Component;

class ChatMain extends Component
{
    public $selectedConversation;
    public $messages=[];
    public function render()
    {
        return view('livewire.chat.chat-main');
    }
}