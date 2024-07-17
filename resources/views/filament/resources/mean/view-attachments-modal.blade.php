<!-- resources/views/filament/resources/mean/view-attachments-modal.blade.php -->
<div>
    @if ($mean->meanAttachments->isEmpty())
        <p class="text-gray-500">Não há documentos anexados a este veículo</p>
    @endif
    @foreach ($mean->meanAttachments as $attachment)
        <a href="{{ \Storage::url($attachment->file) }}" target="_blank">
            <div class="border border-b-2 flex justify-between py-2 px-6 rounded-full hover:bg-gray-100">
                <h4 class="text-md font-medium text-gray-700">{{ $attachment->title }}</h4>
                <p target="_blank" class="text-blue-500 hover:text-blue-700 hover:underline">
                    Ver Anexo
                </p>
            </div>
        </a>
    @endforeach
</div>
