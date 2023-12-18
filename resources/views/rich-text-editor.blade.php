<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rich Text Editor</title>
    <style>
        #editor {
            border: 1px solid #ccc;
            padding: 10px;
            min-height: 200px;
            font-family: sans-serif;
        }

        #editor * {
            margin: 0
        }

        button {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div id="toolbar">
        <div id="alignmentButtons">
            <button onclick="setAlignment('Left')">Aligner à gauche</button>
            <button onclick="setAlignment('Center')">Centrer</button>
            <button onclick="setAlignment('Right')">Aligner à droite</button>
        </div>
        <div id="headingButtons">
            <button onclick="setHeading('H1')">H1</button>
            <button onclick="setHeading('H2')">H2</button>
            <button onclick="setHeading('H3')">H3</button>
            <button onclick="setHeading('H4')">H4</button>
            <button onclick="setHeading('H5')">H5</button>
            <button onclick="setHeading('H6')">H6</button>
        </div>
        <div id="listButtons">
            <button onclick="insertList('UnorderedList')">Liste non ordonnée</button>
            <button onclick="insertList('OrderedList')">Liste ordonnée</button>
        </div>
        <div id="fontSizeButtons">
            <button onclick="changeFontSize(1)">Taille 1</button>
            <button onclick="changeFontSize(2)">Taille 2</button>
            <button onclick="changeFontSize(3)">Taille 3</button>
            <button onclick="changeFontSize(4)">Taille 4</button>
            <button onclick="changeFontSize(5)">Taille 5</button>
            <button onclick="changeFontSize(6)">Taille 6</button>
            <button onclick="changeFontSize(7)">Taille 7</button>
        </div>
    </div>
    <div id="editor" contenteditable="true"></div>
    <button onclick="generateJSON()">Générer JSON</button>



    <script>
        function generateJSON() {
            const editorContent = document.getElementById('editor').innerHTML;
            const jsonOutput = convertToJSON(editorContent);
            console.log(jsonOutput);
        }

        function convertToJSON(htmlContent) {
            const jsonOutput = {
                content: htmlContent
            };
            return jsonOutput;
        }

        function updateToolbar() {
            const selection = window.getSelection();
            const range = selection.getRangeAt(0);
            const parentNode = range.commonAncestorContainer.parentNode;

            // Check if the selected node is a heading, list item, or text
            const isHeading = /^H[1-6]$/.test(parentNode.tagName);
            const isListItem = /^(OL|UL)$/.test(parentNode.tagName);
            const isText = selection.toString().trim() !== '';

            // Disable heading and list buttons if the selection is inside a heading or list item
            document.getElementById('headingButtons').disabled = isHeading || isListItem;

            // Disable alignment buttons if the selection is inside a heading or list item
            document.getElementById('alignmentButtons').disabled = isHeading || isListItem;

            // Disable font size buttons if the selection is not text
            document.getElementById('fontSizeButtons').disabled = !isText;
        }

        function setAlignment(alignment) {
            document.execCommand('justify' + alignment, false, null);
        }

        function setHeading(heading) {
            document.execCommand('formatBlock', false, heading);
        }

        function insertList(listType) {
            document.execCommand('insert' + listType, false, null);
        }

        function changeFontSize(size) {
            document.execCommand('fontSize', false, size);
        }

        document.getElementById('editor').addEventListener('input', function() {
            updateToolbar();
        });
    </script>
</body>

</html>
