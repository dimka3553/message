<x-chats-layout>

    <x-chat-sidebar :user="$user" :activechat="$chat->id"/>


    <div class="pl-[400px] pb-[60px] relative w-full showview">
        <div class="break-words w-full">
            <div class="break-words">
                <div class="sticky top-0 w-full border-b-[1px] border-b-[#dddddd] h-[60px] bg-white flex items-center px-[16px] justify-between gap-[16px]">
                    <div class="flex items-center gap-[16px]">
                        <a href="{{route('chats.index')}}" class="back hidden">
                            <div class="flex items-center justify-center w-[40px] h-[40px] back hidden">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 11H7.83L13.42 5.41L12 4L4 12L12 20L13.41 18.59L7.83 13H20V11Z" fill="#999999"/>
                                </svg>
                            </div>
                        </a>
                        <x-chat-image :chat="$chat" :size="40"/>
                        <div class="">
                            <p class="font-bold text-[#{{substr(hash('ripemd160', $chat->id),0,6)}}]">{{$chat->name}}</p>
                            <p class="text-[13px] text-[#999999]">{{$chat->users->count()}} participants</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-center w-[40px] h-[40px] chat cursor-pointer">
                        <svg width="5" height="23" viewBox="0 0 5 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="2.5" cy="2.5" r="2.5" fill="#999"/>
                            <circle cx="2.5" cy="11.25" r="2.5" fill="#999"/>
                            <circle cx="2.5" cy="20" r="2.5" fill="#999"/>
                        </svg>
                    </div>
                </div>

               <livewire:messages :chat="$chat"/>
                <div class="fixed bottom-0 w-[100%] border-t-[1px] border-t-[#dddddd] h-[60px] bg-white bottom-message-form z-[51] " >
                    <form method="post" action="{{url('/message/save')}} " id="sendmessage">
                        @csrf
                        @method('post')
                        <input type="text" name="body" class="w-full h-[60px] border-0 !outline-0 pr-[80px] pl-[16px]" placeholder="Send Message..." autofocus required maxlength="1024">
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
        <x-chat-modal :chat="$chat" :user="$user"/>
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

<script>

    document.getElementById('sendmessage').addEventListener('submit', function(e) {
        e.preventDefault();
        document.getElementById('allmessages').removeAttribute('wire:poll');

        var form = this;
        var data = new FormData(form);
        var xhr = new XMLHttpRequest();
        form.reset();
        var messages = document.getElementById('allmessages');
        messages.innerHTML += `
        <div class="flex gap-[16px] p-[16px] break-words message">
            <div class="pt-[3.5px]">
                @if( $user->media->first()?->getUrl('avatar') !== null)

        <img src="{{$user->media->first()?->getUrl('avatar')}}" alt="user image" class="min-h-[40px] min-w-[40px] w-[40px] h-[40px] rounded-full">
                @else
        <div class="w-[40px] h-[40px] rounded-full min-h-[40px] min-w-[40px]  bg-[#{{substr(hash('ripemd160', $user->email),0,6)}}] items-center justify-center flex">
                        <p class="text-[18px] font-bold text-[#ffffff] ">{{$user->name[0]}}</p>
                    </div>
                @endif

        </div>
        <div class="w-full break-words msg-text min-w-0">
            <p class="text-[#{{substr(hash('ripemd160', $user->email),0,6)}}] font-bold ">
                    {{$user->name}} (You) <span class="text-[12px] font-normal text-[#999999]">now</span>
                </p>
                <p class="break-words w-full">
                    ${data.get('body')}
                </p>
            </div>
        </div>
        `
        window.scrollTo({
            top: document.body.scrollHeight,
            behavior: 'smooth'
        });

        xhr.open(form.method, form.action);
        xhr.send(data);
        xhr.onload = function() {
            //wait for 1 second and then add wire:poll and wire:poll.id
            setTimeout(function(){
                document.getElementById('allmessages').setAttribute('wire:poll', '');
            }, 1000);
        }
    });

</script>
