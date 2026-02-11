{{-- Comment Template --}}
<div class="flex justify-between items-start">
    <div class="flex-1">
        <p class="font-semibold text-gray-800 flex items-center gap-1">
            {{ $comment->user->name }}
            @if($comment->user->is_admin)
                <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span class="text-xs text-blue-600 font-medium">ادمین</span>
            @endif
        </p>
        <p class="text-gray-700 mt-1 leading-relaxed {{ $depth > 0 ? 'text-sm' : '' }}">{{ $comment->body }}</p>
        <p class="text-xs text-gray-400 mt-2">{{ $comment->created_at->diffForHumans() }}</p>
    </div>

    @if(auth()->check() && auth()->user()->is_admin)
        <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
            @csrf @method('DELETE')
            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium"
                    onclick="return confirm('حذف؟')">
                حذف
            </button>
        </form>
    @endif
</div>

<!-- لایک و دیسلایک -->
<div class="flex gap-6 mt-4 text-sm">
    @auth
        @php $userLike = $comment->userLike @endphp
        <form action="{{ route('comments.like', $comment) }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="flex items-center gap-1 font-medium transition
                {{ $userLike?->type === 'like' ? 'text-green-700' : 'text-gray-600 hover:text-green-700' }}">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
                </svg>
                <span>{{ $comment->likes_count }}</span>
            </button>
        </form>

        <form action="{{ route('comments.dislike', $comment) }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="flex items-center gap-1 font-medium transition
                {{ $userLike?->type === 'dislike' ? 'text-red-700' : 'text-gray-600 hover:text-red-700' }}">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.105-1.79l-.05-.025A4 4 0 0011.055 2H5.64a2 2 0 00-1.962 1.608l1.2-6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.4-1.866a4 4 0 00.8-2.4z"/>
                </svg>
                <span>{{ $comment->dislikes_count }}</span>
            </button>
        </form>
    @else
        <span class="text-green-600">{{ $comment->likes_count }}</span>
        <span class="text-red-600 ml-4">{{ $comment->dislikes_count }}</span>
    @endauth
</div>

<!-- فرم پاسخ -->
@auth
<div class="mt-5">
    <form action="{{ route('comments.reply', [$product, $comment]) }}" method="POST">
        @csrf
        <textarea name="body" rows="{{ $depth > 1 ? 1 : 2 }}" class="w-full border {{ $depth > 0 ? 'border-indigo-200 text-xs' : 'border-gray-300' }} rounded-lg p-3 focus:ring-2 focus:ring-indigo-500" placeholder="پاسخ شما..."></textarea>
        <button type="submit" class="mt-2 bg-indigo-600 text-white px-4 py-1.5 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
            ارسال پاسخ
        </button>
    </form>
</div>
@endauth

<!-- پاسخ‌های تودرتو -->
@foreach($comment->replies as $reply)
    <div class="mt-5 ml-8 p-4 bg-indigo-50 border-l-4 border-indigo-500 rounded-r-lg">
        @include('products.partials.comment', ['comment' => $reply, 'product' => $product, 'depth' => $depth + 1])
    </div>
@endforeach