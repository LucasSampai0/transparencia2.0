<div
    x-data="{ month:@entangle('Month') }"
    class="p-4 bg-white dark:bg-gray-800 rounded-xl">
    <div class="flex justify-between pb-2 border-b">
        <x-heroicon-o-chevron-left class="w-9 h-9 text-gray-800 dark:text-white cursor-pointer"
                                   wire:click="decrementYear"
        />
        <span class="text-3xl font-bold">{{$Year}}</span>
        <x-heroicon-o-chevron-right class="w-9 h-9 text-gray-800 dark:text-white cursor-pointer"
                                    wire:click="incrementYear"
        />
    </div>
    <div class="grid grid-cols-4 grid-rows-3 gap-4 pt-2 text-center font-black justify-items-center">
        @foreach(range(1, 12) as $month)
            <span aria-label="{{$month}}"
                  :class="{'bg-[#93DD00] text-white': month === {{$month}}}"
                  wire:click="updateMonth({{$month}})"
                  class="cursor-pointer flex items-center justify-center w-16 h-16 border rounded-full border-[#93DD00] hover:bg-[#93DD00] hover:text-white hover:shadow-md transition-all">

            {{DateTime::createFromFormat('!m', $month)->format('M')}}
        </span>
        @endforeach

    </div>
    <h3 class="font-black text-xl text-center pt-4 text-gray-800 dark:text-white">
        {{DateTime::createFromFormat('!m', $this->Month)->format('F')}}/{{$Year}}
    </h3>
</div>
