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
    public $selectedConversationId;


    public $listeners= ['chatUserSelected'];


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
      $this->selectedConversationId = $conversation->id;
      $this->receiverInstance= User::find($receiverId);
     }
     public function getChatUserInstance(Conversation $conversation, $request)
    {

        $this->auth_id = auth()->id();
        if ($conversation->sender_id == $this->auth_id) {
            $this->receiverInstance = User::firstWhere('id', $conversation->receiver_id);

        } else {
            $this->receiverInstance = User::firstWhere('id', $conversation->sender_id);
        }

        if (isset($request)) {

            return $this->receiverInstance->$request;

        }
    }
}
