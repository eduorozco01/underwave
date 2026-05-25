<x-app-layout>
    <div class="py-12 bg-uw-bg min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 text-uw-text">

            <a href="{{ route('dashboard') }}"
                class="inline-block mb-6 font-mono text-sm hover:text-uw-accent bg-uw-border text-uw-bg px-4 py-1 border-2 border-uw-border">
                << RETURN_TO_FEED </a>

                    <div class="bg-uw-card border-4 border-uw-border shadow-brutal overflow-hidden">
                        <div class="bg-uw-border text-uw-bg p-4 font-mono text-xs flex justify-between">
                            <span>FILE_TYPE: {{ strtoupper($post->category) }}</span>
                            <span>CREATED_AT: {{ $post->created_at->format('d.m.Y // H:i') }}</span>
                        </div>

                        <div class="p-10">
                            <h1 class="font-serif text-6xl uppercase leading-none mb-8 border-b-4 border-uw-border pb-4">
                                {{ $post->title }}
                            </h1>
                            @if($post->image_path)
                                <div class="mb-8 border-4 border-uw-border shadow-brutal-sm">
                                    <img src="{{ asset('storage/' . $post->image_path) }}"
                                        alt="Cartel de {{ $post->title }}" class="w-full max-h-[500px] object-cover">
                                </div>
                            @endif

                            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                                <div class="md:col-span-1 font-mono text-sm space-y-4">
                                    <div class="border-2 border-uw-border p-3 bg-uw-accent/20">
                                        <p class="font-bold border-b border-uw-border mb-1">AUTHOR</p>
                                        <div class="flex items-center gap-3 mt-2">
                                            @if($post->user->avatar_path)
                                                <img src="{{ $post->user->avatar_path }}" alt="Avatar" class="w-8 h-8 border-2 border-uw-border bg-uw-card">
                                            @endif
                                            <p><a href="{{ route('users.show', $post->user) }}" class="hover:text-uw-accent hover:underline">{{ $post->user->name }}</a></p>
                                        </div>
                                    </div>
                                    <div class="border-2 border-uw-border p-3">
                                        <p class="font-bold border-b border-uw-border mb-1">BUDGET</p>
                                        <p>{{ $post->price_range }}</p>
                                    </div>
                                </div>

                                <div class="md:col-span-3">
                                    <p class="font-mono text-lg leading-relaxed whitespace-pre-line">
                                        {{ $post->content }}
                                    </p>
                                </div>
                            </div>@if(Auth::id() === $post->user_id)

                                <div class="mt-12 border-t-4 border-uw-border pt-6 flex gap-4">

                                    <a href="{{ route('posts.edit', $post) }}"
                                        class="bg-uw-accent text-black px-6 py-2 border-4 border-uw-border font-mono font-bold hover:bg-uw-border hover:text-uw-bg transition-none shadow-brutal-sm active:translate-x-1 active:translate-y-1">
                                        [~] EDIT_RECORD
                                    </a>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                        onsubmit="return confirm('WARNING: ¿Purgar este registro permanentemente de UnderWave?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-white px-6 py-2 border-4 border-uw-border font-mono font-bold hover:bg-uw-border hover:text-red-500 transition-none shadow-brutal-sm active:translate-x-1 active:translate-y-1">
                                            [X] PURGE_RECORD
                                        </button>
                                    </form>
                                </div>
                            @endif
                            <div class="mt-16 border-t-8 border-uw-border pt-8">
                                <h3 class="font-serif text-3xl uppercase mb-6 flex items-center gap-4">
                                    <span
                                        class="bg-uw-border text-uw-bg px-3 py-1 text-sm font-mono align-middle">{{ $post->comments->count() }}</span>
                                    USER_FEEDBACK
                                </h3>

                                <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-10">
                                    @csrf
                                    <div class="flex flex-col border-4 border-uw-border shadow-brutal-sm">
                                        <textarea name="content" rows="3" placeholder="WRITE_YOUR_TRANSMISSION_HERE..."
                                            class="w-full p-4 font-mono outline-none border-b-4 border-uw-border bg-uw-card text-uw-text resize-none focus:bg-uw-accent/20"></textarea>
                                        <div class="bg-uw-bg p-2 flex justify-end">
                                            <button type="submit"
                                                class="bg-uw-border text-uw-bg px-6 py-2 font-mono font-bold hover:bg-uw-accent hover:text-black transition-none uppercase text-sm">
                                                TRANSMIT >>
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <div class="space-y-6">
                                    @foreach($post->comments()->latest()->get() as $comment)
                                        <div
                                            class="border-2 border-uw-border p-4 {{ $comment->user_id === Auth::id() ? 'bg-uw-accent/20' : 'bg-uw-card' }}">
                                            <div
                                                class="flex justify-between items-center border-b-2 border-uw-border pb-2 mb-3 font-mono text-xs">
                                                <div class="flex items-center gap-2">
                                                    @if($comment->user->avatar_path)
                                                        <img src="{{ $comment->user->avatar_path }}" alt="Avatar" class="w-5 h-5 border border-uw-border bg-uw-card">
                                                    @endif
                                                    <span class="font-bold uppercase">ID_USR: {{ $comment->user->name }}</span>
                                                </div>
                                                <span class="opacity-50">T:
                                                    {{ $comment->created_at->format('H:i // d.m.y') }}</span>
                                            </div>
                                            <p class="font-mono text-sm leading-relaxed">
                                                {{ $comment->content }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div
                            class="bg-uw-accent p-2 border-t-4 border-uw-border font-mono text-[10px] text-center text-black uppercase tracking-[0.2em]">
                            System_UnderWave // Digital_Underground_Archive
                        </div>
                    </div>

        </div>
    </div>
</x-app-layout>