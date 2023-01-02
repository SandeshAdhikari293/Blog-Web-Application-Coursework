<div>

    @foreach($post->comments as $comment)
        <div class="flex bg-white shadow-lg rounded-lg mx-4 md:mx-auto my-4 max-w-md md:max-w-2xl ">
            <div class="flex items-start px-4 py-6">
                <div class="">
                    <p class="text-lg font-semibold text-gray-900 -mt-1">
                        {{$comment->text}}
                    </p>
                    <div class="mt-4 flex items-center">
                         <div class="flex mr-2 text-gray-700 text-sm mr-4">
                            <span> <a href= "{{route('users.show', ['id' => $post->user->id, 'ppage' => 1, 'cpage' => 1])}}">posted by {{$comment->user->name}} </a></span>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
    @endforeach
    <br>
    <div class="flex justify-center">
        <div class ="block w-1/2 p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Add a comment to this post?</label>
                 <textarea wire:model = "input" type ="text" name="comment" id="comment" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your comment..">{{ old('content') }}</textarea>
                <br>
                <div class="flex justify-between">
                    <button type="submit" wire:click="post" id="btn-submit" name="btn-submit" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 btn-submit">Post comment</button>
                </div>
        </div>
    </div>

</div>
