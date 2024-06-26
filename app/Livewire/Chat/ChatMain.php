<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
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
    public $paginateVar = 10;
    public $height;


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
      $this->loadmore();
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
    function loadmore()
    {

        $this->paginateVar = $this->paginateVar + 10;
        $this->messages_count = Message::where('conversation_id', $this->selectedConversation->id)->count();

        $this->messages = Message::with('sender')->where('conversation_id',  $this->selectedConversation->id)
            ->skip($this->messages_count -  $this->paginateVar)
            ->take($this->paginateVar)->get();

        $height = $this->height;
    }
}