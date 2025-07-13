<div class="relative border rounded-md" style="min-height: 150px;">
    <button
        id="copy-json"
        class="absolute top-2 right-2 z-10 bg-gray-800 text-white text-xs px-2 py-1 rounded hover:bg-gray-700"
    >
        Copy
    </button>
    <div id="json-editor" style="height: 100%; min-height: 150px;"></div>
</div>

<script src="https://www.unpkg.com/ace-builds@latest/src-noconflict/ace.js" crossorigin="anonymous"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editor = ace.edit("json-editor");
        editor.setTheme("ace/theme/tomorrow_night");
        editor.session.setMode("ace/mode/json");
        editor.setValue(JSON.stringify(@json($submission->payload), null, 4));
        editor.setReadOnly(true);
        editor.setOptions({
            fontSize: "12pt"
        });

        window.jsonEditor = editor;

        // Copy to clipboard
        document.getElementById('copy-json').addEventListener('click', () => {
            const code = editor.getValue();
            navigator.clipboard.writeText(code).then(() => {
                const btn = document.getElementById('copy-json');
                btn.textContent = "Copied!";
                setTimeout(() => btn.textContent = "Copy", 2000);
            });
        });
    });
</script>
