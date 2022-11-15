@props(['chat', 'active'])

<a href={{route('chats.show', $chat->id)}}>
    <div class="flex h-[60px] w-full items-center gap-[16px] px-[16px] relative hover:bg-[#f4f6f6] transition-[0.2s] cursor-pointer @if($active == "true")!bg-[#0066ffaa]@endif">

        <x-chat-image :chat="$chat" />
        <div class="relative truncate text-[#999999] @if($active == "true")!text-[#ffffff]@endif">
            <p class="font-bold text-[16px] text-[#000000] @if($active == "true")!text-[#ffffff]@endif">{{$chat->name}}</p>
            <span class="text-[#999999] text-[13px] truncate @if($active == "true")!text-[#ffffff]@endif"><span class="font-bold text-[#{{substr(hash('ripemd160', $chat->lastMessage()->sender->email),0,6)}}] @if($active == "true")!text-[#ffffff]@endif">{{$chat->lastMessage()->sender->name}}: </span>{{$chat->lastMessage()->body}}</span>
        </div>
    </div>
</a>

