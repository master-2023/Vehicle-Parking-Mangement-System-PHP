<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portfolio Chatbot</title>
  <link rel="stylesheet">
  <style>
    :root {
  --primary-color: #4caf50;
  --secondary-color: #ffffff;
  --bot-bg-color: #e0f7fa;
  --user-bg-color: #d1c4e9;
}

body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f5f5f5;
}

.chatbot-container {
  width: 90%;
  max-width: 400px;
  background: #ffffff;
  border-radius: 8px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

#chat {
  flex: 1;
  padding: 16px;
  overflow-y: auto;
}

.bubble {
  margin: 8px 0;
  padding: 12px;
  border-radius: 16px;
  animation: animateBubble 0.3s ease;
}

.bot {
  background-color: var(--bot-bg-color);
  align-self: flex-start;
}

.user {
  background-color: var(--user-bg-color);
  align-self: flex-end;
}

form {
  display: flex;
  padding: 16px;
  border-top: 1px solid #ddd;
  background-color: #fff;
}

input {
  flex: 1;
  padding: 8px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  outline: none;
}

button {
  background-color: var(--primary-color);
  color: var(--secondary-color);
  border: none;
  padding: 8px 12px;
  margin-left: 8px;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.2s;
}

button:hover {
  background-color: #43a047;
}

@keyframes animateBubble {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

    </style>
</head>
<body>
  <div class="chatbot-container">
    <div id="chat">
      <div class="bubble bot">Hi, I’m Navvy, your personal guide! Type 'help' to see what I can do.</div>
    </div>
    <form id="user-input">
      <input type="text" id="input" placeholder="Type something..." required autocomplete="off">
      <button type="submit">Send</button>
    </form>
  </div>
  <script>
    const chat = document.getElementById('chat');
const form = document.getElementById('user-input');
const inputField = document.getElementById('input');

// Possible user commands
const possibleInput = {
  help: "You can ask me about: 'best work', 'about', or 'contact'.",
  "best work": "Check out my portfolio here: <a href='https://example.com'>My Work</a>",
  about: "I am a creative developer building unique web experiences.",
  contact: "Reach me at: <a href='mailto:email@example.com'>email@example.com</a>"
};

// Reaction commands for fun interactions
const reactionInput = {
  "rick roll": "Never gonna give you up! <a href='https://youtu.be/dQw4w9WgXcQ'>🎵</a>"
};

// Append a chat bubble
function createBubble(message, isBot = true) {
  const bubble = document.createElement('div');
  bubble.classList.add('bubble', isBot ? 'bot' : 'user');
  bubble.innerHTML = message;
  chat.appendChild(bubble);
  chat.scrollTop = chat.scrollHeight;
}

// Check user input
function checkInput(e) {
  e.preventDefault();
  const userInput = inputField.value.trim().toLowerCase();
  createBubble(inputField.value, false); // Show user's input
  inputField.value = ''; // Clear the input field

  // Match user input with commands
  setTimeout(() => {
    if (possibleInput[userInput]) {
      createBubble(possibleInput[userInput]);
    } else if (reactionInput[userInput]) {
      createBubble(reactionInput[userInput]);
    } else {
      createBubble("Unknown command. Type 'help' to see available options.");
    }
  }, 500); // Simulate bot typing delay
}

// Event listener for form submission
form.addEventListener('submit', checkInput);

  </script>
</body>
</html>
