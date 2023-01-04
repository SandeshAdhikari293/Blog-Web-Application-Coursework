<div>
    <div class="flex bg-white shadow-lg rounded-lg mx-4 md:mx-auto my-8 max-w-md md:max-w-2xl">
        <div class="flex items-start px-4 py-6">
            @if($post->image != "")
                <img width="200" height = "200" src="{{ url('image/'. $post->image) }}" alt="">
            @endif
            <div class="">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900 -mt-1"> <a href=" {{route('posts.show', ['id' => $post->id, 'page' => 1]) }}">{{$post->title}}</a></h2>
                    <small class="text-sm text-gray-700">22h ago</small>
                </div>
                <p class="text-gray-700"> </p>
                <p class="mt-3 text-gray-700 text-sm">
                    {{$post->content}}
                </p>
                <div class="mt-4 flex items-center">
                    <div class="flex mr-2 text-gray-700 text-sm mr-3">
                        <svg fill="none" viewBox="0 0 24 24"  class="w-4 h-4 mr-1" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <span>{{$upvotes}}</span>
                    </div>
                    <div class="flex mr-2 text-gray-700 text-sm mr-8">
                        <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4 mr-1" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                        </svg>
                        <span>{{count($post->comments)}}</span>
                    </div>
                    <button type="submit" wire:click="upvote" id="btn-submit" name="btn-submit" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 btn-submit">Upvote</button>

                    <div class="flex mr-2 text-gray-700 text-sm mr-4">
                        <span> <a href= "{{route('users.show', ['id' => $post->user->id, 'ppage' => 1, 'cpage' => 1])}}">posted by {{$post->user->name}} </a></span>
                    </div>

                    @if(auth()->user()->is_admin || auth()->user()->id == $post->user->id)

                    <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><a href = "{{route('posts.edit', ['id' => $post->id])}}">Edit post</button>

                        <form class= "flex justify-right" method="DELETE" action="{{ route('posts.destroy', ['id' => $post->id]) }}">
                            @csrf
                                <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><a>Delete post</button>
                        </form>

                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="block bg-gray shadow-lg">

        <br>
        <h1 class="flex justify-center mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">View <span class="text-blue-600 dark:text-blue-500">Comments</span></h1>
        <br>
                    
        @php
            $count = 0;
        @endphp
        @foreach($post->comments as $comment)
            @if($count < $page * $comment_per_page && $count > ($page * $comment_per_page) - ($comment_per_page + 1) )
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
                                @if(auth()->user()->is_admin || auth()->user()->id == $post->user->id)
                                    <button type="button" class="text-white bg-orange-700 hover:bg-orange-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><a href = "{{route('comments.edit', ['id' => $comment->id])}}">Edit comment</button>
                                    <form class= "flex justify-center" method="DELETE" action="{{ route('comments.destroy', ['c_id' => $comment->id, 'p_id' => $comment->post->id]) }}">
                                        <button type="submit" id="btn-submit" name="btn-submit" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete comment</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
            @endif
            @php
                $count = $count + 1;
            @endphp
        @endforeach
        
        @if($page > 1)

            <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l" wire:click="prev_page">Prev Page</button>
        @endif

        @if($page < count($post->comments) / $comment_per_page)
            <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r" wire:click="next_page">Next Page</button>
        @endif

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

</div>
