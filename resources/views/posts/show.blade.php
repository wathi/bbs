<x-app-layout>
  <div class="max-w-6xl mx-auto p-4 border-solid border-1 border-red-300">
    <div class="mb-4">    
      <div class="font-bold text-3xl mb-4">{{ $post->title }}</div>
      <div class="flex border-b-4 mb-4"> 
        <div class="flex-1">{{ $post->user->name }}</div>
        <div class="flex-1">Reply</div>
        <div class="flex-1">Like</div>
      </div>  
      <div class="">{{ $post->content }}</div> 
    </div>

      <div class="">
      @foreach ($postReplies as $key => $postReply)
      <div class="flex border-b-4">
        <div class="flex-1">{{ $key + 1 }}</div>
        <div class="flex-1">{{ $postReply->user->name }}</div>
        <div class="flex-1">Like</div>
        <div class="flex-1">Reply</div>
      </div> 
        <div class="">{{ $postReply->content }}</div>
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