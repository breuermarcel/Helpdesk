<script>
    const form = document.querySelector(".typing-area"),
        chat_id = form.querySelector(".chat_id").value,
        inputField = form.querySelector(".input-field"),
        sendBtn = form.querySelector("button"),
        chatBox = document.querySelector(".chat-box");

    form.onsubmit = (e) => {
        e.preventDefault();
    }

    inputField.focus();
    inputField.onkeyup = () => {
        if (inputField.value != "") {
            sendBtn.classList.add("active");
        } else {
            sendBtn.classList.remove("active");
        }
    }

    sendBtn.onclick = () => {
        let xhr = new XMLHttpRequest();
        let csrf = document.querySelector('meta[name="csrf-token"]').content;
        xhr.open("POST", "{{ route('helpdesk.chat.createMessage') }}", true);
        xhr.setRequestHeader('X-CSRF-TOKEN', csrf);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    inputField.value = "";
                    scrollToBottom();
                }
            }
        }
        let formData = new FormData(form);
        xhr.send(formData);
    }
    chatBox.onmouseenter = () => {
        chatBox.classList.add("active");
    }

    chatBox.onmouseleave = () => {
        chatBox.classList.remove("active");
    }

    //setInterval(() => {
        let xhr = new XMLHttpRequest();
        let csrf = document.querySelector('meta[name="csrf-token"]').content;
        xhr.open("POST", "{{ route('helpdesk.chat.getMessage') }}", true);
        xhr.setRequestHeader('X-CSRF-TOKEN', csrf);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    chatBox.innerHTML = data;
                    if (!chatBox.classList.contains("active")) {
                        scrollToBottom();
                    }
                }
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send('chat_id='+chat_id);
    //}, 500);

    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }
</script>
