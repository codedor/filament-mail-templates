<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div x-data="{
        state: $wire.entangle('{{ $getStatePath() }}').defer,
        copyToClipboard (key) {
            {{-- navigator.clipboard.writeText(key) does not work on http:// --}}
            const textArea = document.createElement('textarea')
            textArea.value = '\{\{ ' + key  + ' \}\}'
            document.body.appendChild(textArea)
            textArea.focus()
            textArea.select()
            document.execCommand('copy')
            document.body.removeChild(textArea)

            $wire.dispatchFormEvent(
                'filament-mail-templates-input::copyNotification',
                '{{ $getStatePath() }}',
                key
            )
        },
    }">
        <div class="flex flex-col gap-2 border p-4">
            @foreach ($getMailVariables() as $key)
                <div class="flex gap-4 items-center">
                    <x-filament::icon-button
                        icon="heroicon-o-clipboard"
                        x-on:click="copyToClipboard('{{ $key }}')"
                    />

                    <p>{{ $key }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-dynamic-component>
