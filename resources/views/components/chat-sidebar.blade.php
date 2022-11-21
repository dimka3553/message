@props(['user', 'activechat'])



<div class="fixed top-0 left-0 h-full w-full max-w-[400px] bg-[#ffffff] border-r-[#ddd] border-r-[1px] z-50 pb-[76px] sidebar">
    <div class="overflow-auto allchats">
        <div class="sticky top-0 left-0 w-full h-[60px] flex items-center gap-[16px] px-[16px] bg-white z-[51]">
            <div class="createchat w-[40px] min-h-[40px] min-w-[40px] h-[40px] flex items-center justify-center cursor-pointer">
                <svg class=" cursor-pointer" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g>
                        <path d="M1 8H15M8 15V1" stroke="#0066FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                </svg>
            </div>


            <input type="text" placeholder="Search" class="bg-[#f4f6f6] h-[40px] w-full outline-0 border-0 rounded-[10px]">
        </div>
        @foreach($user->chats as $chat)

            @if("$chat->id" == "$activechat")
                <x-sidebar-chat :chat="$chat" active="true"/>
            @else
                <x-sidebar-chat :chat="$chat" active="false"/>
            @endif
        @endforeach
    </div>


    <div class="w-full max-w-[400px] bg-[#f4f6f6] fixed bottom-0 left-0 h-[76px]  border-r-[#ddd] border-r-[1px] flex gap-[16px] px-[16px] items-center justify-between">
        <div class="flex items-center gap-[16px]">
            <x-user-image :user="$user"/>

            <div>
                <p class="text-[18px] font-bold">{{$user->name}}</p>
                <p class="text-[14px] text-[#0066ff] font-bold">{{'@'}}{{$user->username}}</p>
            </div>
        </div>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 15C12.7956 15 13.5587 14.6839 14.1213 14.1213C14.6839 13.5587 15 12.7956 15 12C15 11.2044 14.6839 10.4413 14.1213 9.87868C13.5587 9.31607 12.7956 9 12 9C11.2044 9 10.4413 9.31607 9.87868 9.87868C9.31607 10.4413 9 11.2044 9 12C9 12.7956 9.31607 13.5587 9.87868 14.1213C10.4413 14.6839 11.2044 15 12 15V15Z" stroke="#666666" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M2 12.88V11.12C2 10.08 2.85 9.22 3.9 9.22C5.71 9.22 6.45 7.94 5.54 6.37C5.02 5.47 5.33 4.3 6.24 3.78L7.97 2.79C8.76 2.32 9.78 2.6 10.25 3.39L10.36 3.58C11.26 5.15 12.74 5.15 13.65 3.58L13.76 3.39C14.23 2.6 15.25 2.32 16.04 2.79L17.77 3.78C18.68 4.3 18.99 5.47 18.47 6.37C17.56 7.94 18.3 9.22 20.11 9.22C21.15 9.22 22.01 10.07 22.01 11.12V12.88C22.01 13.92 21.16 14.78 20.11 14.78C18.3 14.78 17.56 16.06 18.47 17.63C18.99 18.54 18.68 19.7 17.77 20.22L16.04 21.21C15.25 21.68 14.23 21.4 13.76 20.61L13.65 20.42C12.75 18.85 11.27 18.85 10.36 20.42L10.25 20.61C9.78 21.4 8.76 21.68 7.97 21.21L6.24 20.22C5.8041 19.969 5.48558 19.5553 5.35435 19.0698C5.22311 18.5842 5.28988 18.0664 5.54 17.63C6.45 16.06 5.71 14.78 3.9 14.78C2.85 14.78 2 13.92 2 12.88V12.88Z" stroke="#666666" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-dropdown-link :href="route('logout')"
                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-dropdown-link>
        </form>
    </div>
</div>

<x-create-chat-modal />

<script>
    const createchat = document.querySelector('.createchat');
    const createchatmodal = document.querySelector('.createchatmodal');
    const createchatmodalclose = document.querySelector('.createchatmodalclose');
    const createchatmodaloverlay = document.querySelector('.createchatmodaloverlay');

    createchat.addEventListener('click', () => {
        createchatmodal.classList.add('active');
        createchatmodaloverlay.classList.add('active');
    });

    createchatmodalclose.addEventListener('click', () => {
        createchatmodal.classList.remove('active');
        createchatmodaloverlay.classList.remove('active');

    });
    createchatmodaloverlay.addEventListener('click', () => {
        createchatmodal.classList.remove('active');
        createchatmodaloverlay.classList.remove('active');
    });

</script>
