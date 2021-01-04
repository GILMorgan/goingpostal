document.addEventListener("DOMContentLoaded", function(){
    let options = {
        modules: {
          toolbar: [
            ['bold', 'italic', 'underline'],
            ['image', 'code-block']
          ]
        },
        placeholder: 'Ecrivez votre message',
        theme: 'snow'
    };

    let to = document.querySelector("input[name='to']");
    let subject = document.querySelector("input[name='subject']");
    let saveButton = document.querySelector("button[data-action='save']");
    let editor = new Quill(".content", options);

    saveButton.addEventListener('click', function() {
        saveContent(saveButton.dataset.route);
    });

    function saveContent(route) {
        let httpRequest = new XMLHttpRequest();
        let content = editor.getContents().ops[0].insert;

        httpRequest.onreadystatechange = function() {
            if (httpRequest.status === 200) {

            }
        }

        httpRequest.open('POST', route, true);
        httpRequest.setRequestHeader("Content-Type", "application/json");
        httpRequest.send(JSON.stringify({
            content: content,
            to: to.value,
            subject: subject.value
        }));
    }
});