<x-chats-layout>
    <x-chat-sidebar :user="$user" :activechat="$chat"/>

    <div class="ml-[400px]">
        {{$messages}}
        <div>
            
        </div>
    </div>
</x-chats-layout>


