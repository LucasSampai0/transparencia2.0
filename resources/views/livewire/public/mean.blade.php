@section('title', 'Relação de veículos - ' . $client->name)

<div class="p-4 lg:p-8">
    <livewire:public.mean-tables :client="$client" :categories="$categories"/>
</div>
