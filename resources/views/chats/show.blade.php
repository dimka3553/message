<x-chats-layout>

    <x-chat-sidebar :user="$user" :activechat="$chat->id"/>


    <div class="pl-[400px] pb-[60px] relative w-full showview">
        <div class="break-words w-full">
            <div class="break-words">
                <div class="sticky top-0 w-full border-b-[1px] border-b-[#dddddd] h-[60px] bg-white flex items-center px-[16px]  gap-[16px]">
                    <a href="{{route('chats.index')}}">
                        <div class="flex items-center justify-center w-[40px] h-[40px] back hidden">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 11H7.83L13.42 5.41L12 4L4 12L12 20L13.41 18.59L7.83 13H20V11Z" fill="#999999"/>
                            </svg>
                        </div>
                    </a>
                    <div>
                        <p class="font-bold text-[#{{substr(hash('ripemd160', $chat->id),0,6)}}]">{{$chat->name}}</p>
                        <p class="text-[13px] text-[#999999]">{{$chat->users->count()}} participants</p>
                    </div>
                </div>
                @foreach($chat->messages as $message)
                    <x-message :message="$message" :user="$user"/>

                @endforeach
                <div class="fixed bottom-0 w-[100%] border-t-[1px] border-t-[#dddddd] h-[60px] bg-white bottom-message-form z-[51] " >
                    <form method="post" action="{{url('/message/save')}} ">
                        @csrf
                        @method('post')
                        <input type="text" name="body" class="w-full h-[60px] border-0" placeholder="Send Message..." autofocus required maxlength="1024">
                        <input type="hidden" name="chat_id" value="{{$chat->id}}">
                        <button class="absolute mt-[10px] right-[16px] z-[52] rounded-full bg-[#0066ff] w-[40px] h-[40px] text-white pl-[16px]" type="submit">
                            <svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 17L9 9L1 1" stroke="white" stroke-width="2"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-chats-layout>

<script>
    function scrollToBottom() {
        window.scrollTo(0,document.body.scrollHeight);
    }
    scrollToBottom();
</script>


<style>
    @media(max-width: 950px) {
        .sidebar {
            display: none;
        }
        .showview {
            padding-left: 0;
        }
        .bottom-message-form{
            max-width: 100%;
            left: 0;
        }
        .back {
            display: flex;
        }
    }
</style>
