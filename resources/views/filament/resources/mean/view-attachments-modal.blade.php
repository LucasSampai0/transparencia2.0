<div class="grid grid-cols-1 gap-y-4">
    @if ($mean->meanAttachments->isEmpty())
        <p class="text-gray-500">Não há documentos anexados a este veículo</p>
    @endif
    @foreach ($mean->meanAttachments as $attachment)
        <a href="{{ asset('storage/attachments/' . $attachment->file) }}" target="_blank">
            <div class="border border-b-2 flex justify-between py-2.5 px-6 rounded-xl hover:bg-gray-100">
                <h4 class="font-medium text-gray-700">{{ $attachment->title }}</h4>
                <p target="_blank" class="text-blue-500 hover:text-blue-700 hover:underline">
                    Ver Anexo
                </p>
            </div>
        </a>
    @endforeach
</div>

