<x-app-layout>

    <div class="p-6 bg-white dark:bg-gray-800 w-3/6 mx-auto">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('All Comments') }}</h3>

        @foreach($comments as $comment)
            <div class="border p-4 mt-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <strong>{{ $comment->user_name }}</strong> commented on <strong>{{ $comment->blog_title }}</strong>:
                </p>
                <p class="mt-2 text-gray-800 dark:text-white">{{ $comment->comment_body }}</p>

                <!-- Display replies (if any) under the same comment card -->
                @if($comment->reply_body)
                    <div class="ml-6 mt-4 p-2 border-l-4 border-gray-300 dark:border-gray-600">
                        <p class="text-sm text-gray-500 dark:text-gray-400"><strong>Reply:</strong></p>
                        <p class="text-gray-700 dark:text-gray-300">{{ $comment->reply_body }}</p>
                    </div>
                @endif

                <!-- Delete Button with Confirmation -->
                <form method="POST" action="{{ route('comments.destroy', $comment->comment_id) }}" class="mt-4"
                      onsubmit="return confirm('Are you sure you want to delete this comment?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900 dark:hover:text-red-400">
                        {{ __('Delete Comment') }}
                    </button>
                </form>
            </div>
        @endforeach

        <!-- Display pagination links -->
        <div class="mt-6">
            {{ $comments->links() }}
        </div>
    </div>
</x-app-layout>
