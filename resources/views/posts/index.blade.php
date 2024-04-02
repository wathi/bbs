<x-app-layout>
  <div class="max-w-6xl mx-auto p-4">

    <div class="grid grid-cols-5 gap-2">
      @foreach ($posts as $post)

      <a href="{{ route('posts.show', ['post' => $post]) }}"  class="p-4 border-solid border-2 border-gray-300">
          <div class="text-gray-800">{{ $post->title }}</div>
      </a>
      @endforeach
    </div>

    {{ $posts->links() }}

    @if(Auth::check())
    <form method="POST" action="{{ route('posts.store') }}"  class="max-w-2xl mx-auto">
      @csrf
      <div class="block mb-2">
        <label for="title">Title</label>
        <input
          type="text" 
          name="title"
          placeholder="{{ __('Title') }}"
          class="w-full p-4">
        @error('title')
        <div class="text-red-500">{{ $message }}</div>
        @enderror
      </div>


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
  <div>
</x-app-layout>  