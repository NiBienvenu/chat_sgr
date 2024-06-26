<div>
    <div class="container-fluid">
        <div class="container-fluid row">
            <div class="col-4">
                <div class="row">
                    <div class="col-md-9 col-lg-10 chat-window">
                        <header class="px-3 py-2 bg-white border-bottom chat-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="font-weight-bold mb-0">Chats</h5>
                                <button class="btn">
                                    <svg class="bi bi-three-dots-vertical" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                                    </svg>
                                </button>
                            </div>

                        </header>
                        <main class="p-2 chat-main">
                            <ul class="list-unstyled">
                                @if (count($conversations) > 0)
                                    @foreach ($conversations as $conversation)
                                    {{-- <li class="chatlist_item d-flex p-2 my-2 mx-1 rounded bg-light cursor-pointer" style="width: 95%;" wire:key='{{$conversation->id}}' wire:click="chatUserSelected({{$conversation}}, {{$this->getChatUserInstance($conversation, $name = 'id')}})"> --}}
                                    <li class="chatlist_item d-flex p-2 my-2 mx-1 rounded bg-light cursor-pointer"
                                    style="width: 96%;"
                                    wire:key='{{$conversation->id}}'
                                    wire:click="chatUserSelected({{ $conversation }},{{$this->getChatUserInstance($conversation, $name = 'id') }})"
                                    :class="{ 'bg-primary text-white': $selectedConversationId === {{ $conversation->id }} }">
                                    {{-- <li iclass="py-3 hover-bg-light rounded-2xl transition flex gap-4 cursor-pointer px-2" wire:click="$emit('chatUserSelected', {{$conversation}},{{$this->getChatUserInstance($conversation, $name = 'id') }})"> --}}
                                        <a href="#"class="shrink-0">
                                            <img src="https://ui-avatars.com/api/?name={{$this->getChatUserInstance($conversation, $name = 'name')}}" class="img-fluid rounded-circle">
                                        </a>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center">
                                                {{ $this->getChatUserInstance($conversation, $name = 'name') }}
                                                <span class="text-muted" style="font-size: 13px;">
                                                    {{ $conversation->messages->last()?->created_at->shortAbsoluteDiffForHumans() }}
                                                </span>
                                                </div>
                                            <div class="d-flex gap-2 align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                                                    <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"/>
                                                    <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"/>
                                                </svg>
                                                <p class="mb-0 text-truncate">
                                                    @if (strlen($conversation->messages->last()->body) > 25)
                                                    {{ substr($conversation->messages->last()->body, 0, 25) . '...' }}
                                                @else
                                                    {{ $conversation->messages->last()->body }}
                                                @endif
                                                </p>
                                                @if (true)
                                                <span class="badge bg-primary text-white">1</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                </svg>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li><a class="dropdown-item" href="#">View Profile</a></li>
                                                <li><a class="dropdown-item" href="#">Delete</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                 @endforeach
                                  @else
                                        <div class=" text-center">
                                            vous n'avez pas de conversations
                                        </div>
                                  @endif
                            </ul>
                        </main>
                    </div>
                </div>
            </div>
           <div class="col-8">
            <div class="">
                @if ($selectedConversation)
                    <div class="chatbox-header d-flex  p-2  bg-white">

                        <div class="img-container me-3">
                            <img src="https://ui-avatars.com/api/?name={{ $receiverInstance->name }}" alt="" class="rounded-circle">
                        </div>

                        <div class="name flex-grow-1 h4 mt-3">
                            {{ $receiverInstance->name }}
                        </div>

                    </div>

                    {{ $selectedConversation }}
                    <div class="chatbox-body p-3 overflow-auto" style="height: calc(100vh - 220px);">
                        @foreach ($messages as $message)
                            <div class="msg-body {{ auth()->id() == $message->sender_id ? 'bg-primary text-white align-self-end' : 'bg-light text-dark' }} p-2 mb-2 rounded" style="width:80%; max-width: max-content;">
                                <div class="msg-body-footer d-flex justify-content-between mt-1">
                                    <div class="date small text-muted">
                                        {{ $message->created_at->format('h:i a') }}
                                    </div>

                                    <div class="read small text-muted">
                                        @php
                                            if($message->user->id === auth()->id()){
                                                if($message->read == 0){
                                                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2 status-tick" viewBox="0 0 16 16"><path d="M13.854 4.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 0 1 .708-.708l3.146 3.147 6.646-6.647a.5.5 0 0 1 .708 0z"/></svg>';
                                                } else {
                                                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-all text-primary" viewBox="0 0 16 16"><path d="M7.854 4.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 0 1 .708-.708l3.146 3.147 6.646-6.647a.5.5 0 0 1 .708 0z"/><path d="M11.854 4.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 0 1 .708-.708l3.146 3.147 6.646-6.647a.5.5 0 0 1 .708 0z"/></svg>';
                                                }
                                            }
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <footer class="shrink-0 z-10 bg-white inset-x-0 border-top">
                        <div class="p-2 border-t">
                            <form
                                x-data="{body:@entangle('body').defer}"
                                @submit.prevent="$wire.sendMessage"
                                method="POST" autocapitalize="off">
                                @csrf

                                <input type="hidden" autocomplete="false" style="display:none">

                                <div class="row">
                                    <div class="col-10">
                                        <input
                                            x-model="body"
                                            type="text"
                                            autocomplete="off"
                                            autofocus
                                            placeholder="Write your message here"
                                            maxlength="1700"
                                            class="form-control bg-light border-0"
                                        >
                                    </div>
                                    <div class="col-2">
                                        <button x-bind:disabled="!body.trim()" class="btn btn-primary w-100" type='submit'>Send</button>
                                    </div>
                                </div>
                            </form>

                            @error('body')
                            <p class="text-danger"> {{$message}} </p>
                            @enderror
                        </div>
                    </footer>

                @else
                    <div class="fs-4 text-center text-primary mt-5">
                        Aucune conversation sélectionnée
                    </div>
                @endif


            </div>

           </div>
        </div>
    </div>

    .

</div>
