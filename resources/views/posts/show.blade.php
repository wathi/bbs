<x-app-layout>
  <div class="max-w-6xl mx-auto p-4">
    <div class="font-bold text-3xl mb-4">{{ $post->title }}</div>
    <div class="mb-4"> 
      {{ $post->content }}
    </div>
    <div class="">
    @foreach ($postReplies as $postReply)
    <div class="border-solid border-2 border-indigo-600 mb-2">
      <div class="">{{$postReply->content}}</div>
      <div class="">{{$postReply->user_id}}</div>
    </div>
    @endforeach
  </div>
  </div>
  
  @if(Auth::check())
  <form method="POST" action="{{ route('posts.storeReply', $post) }}"  class="max-w-2xl mx-auto">
    @csrf
    <div class="block mb-2">
      <label for="content">Content</label>
      <textarea   
          name="content"
          placeholder="{{ __('What\'s on your mind?') }}"
          class="w-full h-40 p-4"
      ></textarea>
      @error('content')
        <div class="text-red-500">{{ $message }}</div>
      @enderror
    </div>
    
    <x-primary-button class="block">
      {{ __('Post') }}
    </x-primary-button>
    </form>
  @endif
</x-app-layout>