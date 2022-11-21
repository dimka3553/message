<div wire:poll>
    @foreach($user->chats as $chat)

        @if("$chat->id" == "$activechat")
            <x-sidebar-chat :chat="$chat" active="true"/>
        @else
            <x-sidebar-chat :chat="$chat" active="false"/>
        @endif
    @endforeach
</div>
