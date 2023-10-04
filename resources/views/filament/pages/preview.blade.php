<x-filament::page>
    {{ $record->description }}

    <div class="w-full flex">
        <x-filament::input.wrapper>
            <x-filament::input.select  wire:model.live="currentLocale">
                @foreach ($locales as $locale)
                    <option value="{{ $locale }}">{{ $locale }}</option>
                @endforeach
            </x-filament::input.select>
        </x-filament::input.wrapper>
    </div>

    <div class="mt-4 w-full border border-lg bg-white" x-data="{
        init () {
            this.updatePreview(@js($preview))

            $wire.$on('filament-mail-templates::update-preview-content', (e) => {
                this.updatePreview(e.detail.content)
            })
        },
        updatePreview (content) {
            var doc = document.getElementById('preview-content').contentWindow.document

            doc.open()
            doc.write(content)
            doc.close()
        }
    }">
        <div wire:loading.flex class="w-full justify-center py-8">
            <x-filament::loading-indicator class="h-8 w-8" />
        </div>

        <div wire:loading.remove>
            <iframe
                id="preview-content"
                src="about:blank"
                class="w-full h-128"
            ></iframe>
        </div>
    </div>
</x-filament::page>
