<div>
    @auth
        @if (auth()->id() !== $user->id)
            @if (!$isFollowing)
                <button
                    wire:click="follow"
                    wire:loading.attr="disabled"
                    type="button"
                    class="w-full md:w-auto bg-blue-500 text-white px-5 py-2 rounded-lg text-sm hover:bg-blue-600 transition"
                >
                    <span wire:loading.remove wire:target="follow">
                        <i class="fa-solid fa-heart"></i>
                        Follow
                    </span>

                    <span wire:loading wire:target="follow">
                        Loading...
                    </span>
                </button>

            @else
                <button
                    wire:click="unfollow"
                    wire:loading.attr="disabled"
                    type="button"
                    class="w-full md:w-auto bg-gray-400 text-white px-5 py-2 rounded-lg text-sm hover:bg-gray-500 transition"
                >
                    <span wire:loading.remove wire:target="unfollow">
                        <i class="fa-solid fa-door-open"></i>
                        Unfollow
                    </span>

                    <span wire:loading wire:target="unfollow">
                        Loading...
                    </span>
                </button>

            @endif

        @endif

    @endauth
</div>
