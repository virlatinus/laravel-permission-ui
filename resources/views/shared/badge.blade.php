<span class="inline-flex items-center gap-x-0.5 rounded-md px-2 py-1 text-sm font-medium ring-1 ring-inset"
      style="background-color:color(from {{$color}} srgb r g b / 0.05);color:color(from {{$color}} srgb r g b / 0.9);--tw-ring-color:color(from {{$color}} srgb r g b / 0.6);">
    {{$name}}
    <a role="button" class="group relative -mr-1 size-3.5 rounded-xs"
            onmouseover="this.style.backgroundColor='color(from {{$color}} srgb r g b / 0.3)';this.querySelector('svg').style.stroke='color(from {{$color}} srgb r g b / 0.6)'"
            onmouseout="this.style.backgroundColor='transparent';this.querySelector('svg').style.stroke='color(from {{$color}} srgb r g b / 0.4)'"
    href="{{$link}}">
      <span class="sr-only">Remove</span>
      <svg viewBox="0 0 14 14" class="size-3.5"
           style="stroke: color(from {{$color}} srgb r g b / 0.4)">
        <path d="M4 4l6 6m0-6l-6 6"/>
      </svg>
      <span class="absolute -inset-1"></span>
    </a>
</span>
