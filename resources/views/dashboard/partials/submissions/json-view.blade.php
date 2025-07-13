<div class="relative border rounded-md">
    <button
        id="copy-json"
        class="absolute top-2 right-2 z-10 bg-gray-800 text-white text-xs px-2 py-1 rounded hover:bg-gray-700"
    >
        Copy
    </button>
    <div id="json-editor"></div>
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
            fontSize: "12pt",
            maxLines: Infinity,
            autoScrollEditorIntoView: true,
            wrap: true
        });

        // Auto-resize function
        const updateEditorHeight = function() {
            // Get the number of lines
            const lineCount = editor.session.getLength();
            // Calculate height based on line count and font size (approx. 20px per line)
            const newHeight = Math.max(400, lineCount * 20);
            document.getElementById('json-editor').style.height = newHeight + 'px';
            editor.resize();
        };

        // Initial height adjustment
        updateEditorHeight();

        // Update height when content changes
        editor.session.on('change', updateEditorHeight);

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
