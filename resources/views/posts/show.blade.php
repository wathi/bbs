<x-app-layout>
  <div class="max-w-6xl mx-auto p-4 border-solid border-1 border-red-300">
    <div class="mb-10">    
      <div class="flex">
        <div class="flex-1 font-bold text-3xl mb-4">{{ $post->title }}</div>
        <div class="flex-1"><i class="fa-regular fa-star fa-lg"></i></div>
      </div>
      <div class="flex border-b-4 mb-4"> 
        <div class="flex-1">{{ $post->user->name }}</div>
        <div class="flex-1"><i class="fa-solid fa-reply"></i> Reply</div>
      </div>  
      <div class="">{{ $post->content }}</div> 
    </div>

      <div class="">
      @foreach ($postReplies as $postReply)
      <div class="mb-10">
        <div class="flex border-b-4 mb-2">
          <div class="flex-1">{{ $postReply->user->name }}</div> 


          <div>
            @if(Auth::user()->likedPostReply($postReply))
            <form method="POST" action="{{ route('postreplies.unlike', $postReply->id) }}"  class="max-w-2xl mx-auto">
              @csrf
              <button type="submit"><i class="fa-solid fa-heart"></i> Unlike  {{$postReply->like()->count()}}</button>
            </form>
            @else
            <form method="POST" action="{{ route('postreplies.like', $postReply->id) }}"  class="max-w-2xl mx-auto">
              @csrf
              <button type="submit"><i class="fa-regular fa-heart"></i> Like {{$postReply->like()->count()}}</button>
            </form>
            @endif
          </div>

          <div class="flex-1"><i class="fa-solid fa-reply"></i> Reply</div>
        </div> 
        <div class="">{{ $postReply->content }}</div>
      </div>
        @endforeach

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