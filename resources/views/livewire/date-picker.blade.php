<div
    x-data="{ month:@entangle('Month') }"
    class="p-4 bg-white rounded-xl shadow-md">
    <div class="flex justify-between p-3 border-b">
        <x-heroicon-o-chevron-left class="w-9 h-9 text-gray-800 cursor-pointer"
                                   wire:click="decrementYear"
        />
        <span class="text-3xl font-bold">{{$Year}}</span>
        <x-heroicon-o-chevron-right class="w-9 h-9 text-gray-800 cursor-pointer"
                                    wire:click="incrementYear"
        />
    </div>
    <div class="grid grid-cols-4 grid-rows-3 gap-8 text-center p-3 font-black text-xl">
        @foreach(range(1, 12) as $month)
            <span aria-label="{{$month}}"
                  :class="{'bg-[#93DD00] text-white': month === {{$month}}}"
                  wire:click="updateMonth({{$month}})"
                  class="cursor-pointer flex items-center justify-center w-16 h-16 border rounded-full border-[#93DD00] hover:bg-[#93DD00] hover:text-white hover:shadow-md transition-all">

            {{DateTime::createFromFormat('!m', $month)->format('M')}}
        </span>
        @endforeach

    </div>
    <h3 class=" font-black text-xl text-center">
        {{DateTime::createFromFormat('!m', $this->Month)->format('F')}}/{{$Year}}
    </h3>
</div>
