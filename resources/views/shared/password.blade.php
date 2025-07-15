@php
  $id = hash('crc32', microtime());
  $requiredStr = !isset($required) || $required ? 'required' : '';
@endphp
<div class="{{$class??''}}">
  <label for="{{$name}}" class="block font-medium text-sm/6 text-gray-900">{{$label}}</label>
  <div class="mt-2">
    <div class="relative w-full password-field">
      <div class="absolute inset-y-0 right-0 flex items-center px-2">
        <input class="hidden js-password-toggle" id="toggle-{{$id}}" type="checkbox"/>
        <label
            class="bg-gray-300 hover:bg-gray-400/75 rounded px-2 py-1 text-xs text-gray-500 cursor-pointer js-password-label"
            for="toggle-{{$id}}">show</label>
      </div>
      <input id="{{$name}}" type="password" name="{{$name}}" {{$requiredStr}} autocomplete="off"
             placeholder="{{$label}}" value="{{$value??''}}"
             class="block leading-tight w-full px-3 py-1.5 bg-white rounded-md outline-1 outline-gray-300 text-base text-gray-900 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 -outline-offset-1 placeholder:text-gray-400 js-password"/>
    </div>
  </div>
  @error($name)
  <p id="{{$name}}-error" class="mt-2 text-sm text-red-600">{{ $message }}</p>
  @enderror
  @if(isset($description))
    <p id="{{$name}}-description" class="mt-2 text-sm text-gray-500">{{$description}}</p>
  @endif
</div>
