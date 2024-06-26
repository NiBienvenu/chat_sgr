<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use App\Models\User;
use Livewire\Component;

class ChatMain extends Component
{
    public $auth_id;
    public $conversations;
    public $receiverInstance;
    public $name;
    public $selectedConversation;
    public $receiver;
    public $messages=[];
    public $paginateVar = 10;
    public $height;


    public function mount()
    {

        $this->auth_id = auth()->id();
        $this->conversations = Conversation::where('sender_id', $this->auth_id)
            ->orWhere('receiver_id', $this->auth_id)->orderBy('last_time_message', 'DESC')->get();

        # code...
    }

    public function render()
    {

        return view('livewire.chat.chat-main');
    }
    public function chatUserSelected(Conversation $conversation,$receiverId)
     {

      $this->selectedConversation= $conversation;

     }
}