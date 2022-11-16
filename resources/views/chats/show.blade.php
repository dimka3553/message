<x-chats-layout>
    <x-chat-sidebar :user="$user" :activechat="$chat->id"/>

    <div class="ml-[400px] ">
        <div class="sticky top-0 w-full border-b-[1px] border-b-[#dddddd] h-[60px]">

        </div>
        @foreach($messages as $message)

            <x-message :message="$message" :user="$user" :users="$users"/>

        @endforeach
        <div class="fixed bottom-0 w-full border-t-[1px] border-t-[#dddddd] h-[60px]" >

        </div>
    </div>
</x-chats-layout>


