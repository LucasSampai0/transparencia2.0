<div>
    @if($attachments)
        <h2>Detalhes dos Anexos</h2>
        @foreach($attachments as $attachment)
            <p>Nome: {{ $attachment->title }}</p>
        @endforeach
    @endif
</div>
