<x-filament::page>
    {{ $record->description }}

    <div class="w-full flex">
        <div class="
            fi-input-wrp
            rounded-lg shadow-sm bg-white
            ring-1 ring-gray-950/10
            transition duration-75
            focus-within:ring-2 focus-within:ring-primary-600
            dark:bg-white/5
            dark:ring-white/20 dark:focus-within:ring-primary-500 fi-fo-select"
        >
            <select
                class="
                    fi-select-input
                    block py-1.5 pe-8 ps-3
                    text-base text-gray-950
                    border-none bg-transparent
                    transition duration-75
                    focus:ring-0
                    disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] dark:text-white dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)]
                    sm:text-sm sm:leading-6 [&_optgroup]:bg-white [&_optgroup]:dark:bg-gray-900 [&_option]:bg-white [&_option]:dark:bg-gray-900"
                wire:model.live="currentLocale"
            >
                @foreach ($locales as $locale)
                    <option value="{{ $locale }}">{{ $locale }}</option>
                @endforeach
            </select>
        </div>
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
