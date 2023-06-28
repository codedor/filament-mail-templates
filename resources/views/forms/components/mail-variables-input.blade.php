<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-action="$getHintAction()"
    :hint-color="$getHintColor()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
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

            $wire.dispatchFormEvent('filament-mail-templates-input::copyNotification', '{{ $getStatePath() }}', key)
        },
        addToContent (key) {
            $wire.dispatchFormEvent('filament-mail-templates-input::addToContent', '{{ $getStatePath() }}', key)
        },
    }">
        <div class="flex flex-col gap-2 border p-4">
            @foreach ($getMailVariables() as $key)
                <div class="flex gap-8 items-center">
                    <div class="flex gap-2">
                        <x-filament-support::icon-button
                            icon="heroicon-o-clipboard"
                            x-on:click="copyToClipboard('{{ $key }}')"
                        />

                        <x-filament-support::icon-button
                            icon="heroicon-o-plus"
                            x-on:click="addToContent('{{ $key }}')"
                        />
                    </div>

                    <p>{{ $key }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-dynamic-component>
