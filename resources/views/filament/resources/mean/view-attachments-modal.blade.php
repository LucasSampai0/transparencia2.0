<!-- resources/views/filament/resources/mean/view-attachments-modal.blade.php -->
<div>
    <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Documentos</h3>
    <div>
        @foreach ($mean->meanAttachments as $attachment)
            <a href="{{ \Storage::url($attachment->file) }}">
            <div class="flex justify-between py-2 px-1 hover:bg-gray-100">
                <h4 class="text-md font-medium text-gray-700">{{ $attachment->title }}</h4>
                <p target="_blank" class="text-blue-500 hover:text-blue-700 hover:underline">
                    Ver Anexo
                </p>
            </div>
            </a>
        @endforeach
    </div>
</div>
