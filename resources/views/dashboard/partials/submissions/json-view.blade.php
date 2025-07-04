<div id="json-editor" class="border rounded-md" style="height: 400px;"></div>

<script src="https://www.unpkg.com/ace-builds@latest/src-noconflict/ace.js" crossorigin="anonymous"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const initJsonEditor = () => {
            const editor = ace.edit("json-editor");
            editor.setTheme("ace/theme/monokai");
            editor.session.setMode("ace/mode/json");
            editor.setValue(JSON.stringify({!! json_encode($submission->payload) !!}, null, 4));
            editor.setReadOnly(true);
            editor.setOptions({
                fontSize: "12pt"
            });
            window.jsonEditor = editor;
        };

        initJsonEditor();
    });
</script>
