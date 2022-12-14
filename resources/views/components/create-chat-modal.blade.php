<div class="createchatmodal modal">

    <div class="flex items-center justify-between h-[60px]">
        <p class="text-[20px] font-bold">Create chat</p>
        <div class="createchatmodalclose h-10 w-10 flex justify-center items-center cursor-pointer">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.0810547" y="14.701" width="20.676" height="1.83787" transform="rotate(-45 0.0810547 14.701)" fill="#999999"/>
                <rect x="1.2998" width="20.676" height="1.83787" transform="rotate(45 1.2998 0)" fill="#999999"/>
            </svg>
        </div>
    </div>
    <form action="{{route('chats.store')}}" method="POST">
        @method('POST')
        @csrf
        <div class="flex flex-col gap-[16px]">
            <input type="text" name="name" placeholder="Chat name" class="border-[1px] h-[40px] pl-[16px] border-[#dddddd] rounded-[8px] h-[40px]" required>
            <input type="text" name="users" placeholder="Users" class="h-[40px] pl-[16px] border-[1px] border-[#dddddd] rounded-[8px] h-[40px]">
            <div class="suggestions"></div>
            <div class="flex justify-end">
                <button type="submit" class="bg-[white] text-[#0066ff] border-[#0066ff] border-[1px] rounded-[8px] p-[8px] px-[16px]">Create</button>
            </div>
        </div>
    </form>

</div>

<div class="createchatmodaloverlay modaloverlay"></div>

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
