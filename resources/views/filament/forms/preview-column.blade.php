<div class="mt-4 w-full border border-lg bg-white" x-data="{
    init () {
        var doc = document.getElementById('preview-content').contentWindow.document

        doc.open()
        doc.write(@js($record->content))
        doc.close()
    }
}">
    <iframe
        id="preview-content"
        src="about:blank"
        class="w-full h-128"
    ></iframe>
</div>
