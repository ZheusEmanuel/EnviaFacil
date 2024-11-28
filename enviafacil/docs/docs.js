/* JAVASCRIPT DO CHAT */

function openChat(matricula, nomeAluno) {
    const chatSection = document.getElementById('chat-section');
    chatSection.style.display = 'block';
    document.getElementById('chat-input').focus();

    const chatWindow = document.getElementById('chat-window');
    chatWindow.innerHTML = `<p>Por favor, forneça feedback detalhado para o documento do aluno ${nomeAluno} (Matrícula ${matricula}):</p>`;
    loadChatMessages(matricula);
}

function loadChatMessages(matricula) {
    const chatWindow = document.getElementById('chat-window');
    const savedMessages = JSON.parse(localStorage.getItem(`chat_${matricula}`)) || [];
    chatWindow.innerHTML += savedMessages.map(msg => `<p>${msg}</p>`).join('');
}

function saveChatMessage(matricula, message) {
    const savedMessages = JSON.parse(localStorage.getItem(`chat_${matricula}`)) || [];
    savedMessages.push(`Você: ${makeLinksClickable(message)}`);
    localStorage.setItem(`chat_${matricula}`, JSON.stringify(savedMessages));
}

document.getElementById('chat-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const chatInput = document.getElementById('chat-input');
    const chatWindow = document.getElementById('chat-window');

    if (chatInput.value.trim() !== '') {
        const newMessage = document.createElement('p');
        newMessage.innerHTML = `Você: ${makeLinksClickable(chatInput.value)}`;
        chatWindow.appendChild(newMessage);

        saveChatMessage(matricula, chatInput.value);
        chatInput.value = '';
        chatInput.focus();
    }
});

function makeLinksClickable(text) {
    const urlPattern = /(\bhttps?:\/\/[^\s]+)|(www\.[^\s]+)/gi;
    return text.replace(urlPattern, url => `<a href="${url.startsWith('http') ? url : `http://${url}`}">${url}</a>`);
}

function closeChat() {
    document.getElementById('chat-section').style.display = 'none';
}

/* JAVASCRIPT DA LIXEIRA */

function toggleTrash() {
    const trashList = document.getElementById('trash-list');
    const trashBtn = document.getElementById('trash-btn');
    trashList.style.display = trashList.style.display === 'none' ? 'block' : 'none';
    trashBtn.textContent = trashList.style.display === 'block' ? 'Fechar Lixeira' : 'Lixeira';
}

function moveToTrash(matricula) {
    const rejectedDocsTable = document.getElementById('rejected-docs');
    const row = document.querySelector(`button[onclick="moveToTrash('${matricula}')"]`).closest('tr');
    const newRow = row.cloneNode(true);

    newRow.querySelector('.comment-btn').remove();
    newRow.querySelector('td:last-child').innerHTML = `
        <button class="restore-btn" onclick="restoreDocument('${matricula}')">Restaurar</button>
        <button class="delete-btn" onclick="deleteDocument('${matricula}')">Excluir</button>
    `;
    
    rejectedDocsTable.appendChild(newRow);
    row.remove();
}

function restoreDocument(matricula) {
    const documentListTable = document.querySelector('.document-list tbody');
    const row = document.querySelector(`button[onclick="restoreDocument('${matricula}')"]`).closest('tr');
    const restoredRow = row.cloneNode(true);

    restoredRow.querySelector('.restore-btn').remove();
    restoredRow.querySelector('.delete-btn').remove();
    restoredRow.querySelector('td:last-child').innerHTML = `
        <button class="accept-btn">Aceitar</button>
        <button class="reject-btn" onclick="moveToTrash('${matricula}')">Rejeitar</button>
        <button class="comment-btn" onclick="openChat('${matricula}', 'Comentário')">Comentar</button>
    `;

    documentListTable.appendChild(restoredRow);
    row.remove();
}

function deleteDocument(matricula) {
    document.querySelector(`button[onclick="deleteDocument('${matricula}')"]`).closest('tr').remove();
}
