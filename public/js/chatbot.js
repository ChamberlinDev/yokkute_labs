(function () {
    function removeExistingChatbot() {
        var existingPanel = document.querySelector('.chatbot-panel');
        var existingLauncher = document.querySelector('.chatbot-launcher');

        if (existingPanel) {
            existingPanel.remove();
        }

        if (existingLauncher) {
            existingLauncher.remove();
        }
    }

    function createChatbot() {
        removeExistingChatbot();

        var launcher = document.createElement('button');
        launcher.className = 'chatbot-launcher';
        launcher.setAttribute('type', 'button');
        launcher.setAttribute('aria-label', 'Ouvrir Edouard');
        launcher.innerHTML = '<i class="bi bi-chat-dots-fill chatbot-launcher-icon" aria-hidden="true"></i><span class="chatbot-launcher-fallback" aria-hidden="true">E</span>';

        var panel = document.createElement('section');
        panel.className = 'chatbot-panel';
        panel.setAttribute('aria-label', 'Assistant Edouard');

        panel.innerHTML = '' +
            '<header class="chatbot-header">' +
                '<div>' +
                    '<p class="chatbot-title">Edouard</p>' +
                    '<p class="chatbot-status">En ligne • FR/EN/ES/IT/AR</p>' +
                '</div>' +
                '<button class="chatbot-close" type="button" aria-label="Fermer le chatbot">✕</button>' +
            '</header>' +
            '<div class="chatbot-body">' +
                '<div class="chatbot-messages" id="chatbotMessages"></div>' +
                '<div class="chatbot-quick-actions" id="chatbotQuickActions"></div>' +
                '<form class="chatbot-form" id="chatbotForm">' +
                    '<input class="chatbot-input" id="chatbotInput" type="text" placeholder="Ex: Je veux un audit numérique" autocomplete="off" />' +
                    '<button class="chatbot-submit" type="submit">Envoyer</button>' +
                '</form>' +
                '<p class="chatbot-disclaimer">Pour un devis précis, utilisez la page Contact.</p>' +
            '</div>';

        document.body.appendChild(panel);
        document.body.appendChild(launcher);

        var closeBtn = panel.querySelector('.chatbot-close');
        var messages = panel.querySelector('#chatbotMessages');
        var quickActions = panel.querySelector('#chatbotQuickActions');
        var form = panel.querySelector('#chatbotForm');
        var input = panel.querySelector('#chatbotInput');
        var submitButton = panel.querySelector('.chatbot-submit');

        var storageKey = 'yokkute_chatbot_history_v1';
        var storageTimestampKey = 'yokkute_chatbot_history_updated_at_v1';
        var storage = window.sessionStorage;
        var lifetimeMeta = document.querySelector('meta[name="chatbot-session-lifetime-minutes"]');
        var sessionLifetimeMinutes = lifetimeMeta ? parseInt(lifetimeMeta.getAttribute('content') || '120', 10) : 120;
        var sessionLifetimeMs = Math.max(isNaN(sessionLifetimeMinutes) ? 120 : sessionLifetimeMinutes, 1) * 60 * 1000;

        var quickPrompts = [
            'Quels services proposez-vous ?',
            'Je veux un audit numérique',
            'Comment vous contacter ?',
            'Avez-vous des solutions IA ?'
        ];

        function hasUserMessages() {
            return !!messages.querySelector('.chatbot-message.user');
        }

        function updateQuickActionsVisibility() {
            if (hasUserMessages()) {
                quickActions.classList.add('is-hidden');
            } else {
                quickActions.classList.remove('is-hidden');
            }
        }

        var chatHistory = [];
        var requestInFlight = false;

        function getCsrfToken() {
            var tokenMeta = document.querySelector('meta[name="csrf-token"]');
            return tokenMeta ? tokenMeta.getAttribute('content') || '' : '';
        }

        function setInputEnabled(isEnabled) {
            input.disabled = !isEnabled;
            submitButton.disabled = !isEnabled;
        }

        function touchHistoryTimestamp() {
            try {
                storage.setItem(storageTimestampKey, String(Date.now()));
            } catch (e) {
                // ignore storage issues
            }
        }

        function clearPersistedHistory() {
            try {
                storage.removeItem(storageKey);
                storage.removeItem(storageTimestampKey);
            } catch (e) {
                // ignore storage issues
            }
        }

        function resetHistoryIfExpired() {
            try {
                var updatedAtRaw = storage.getItem(storageTimestampKey);
                if (!updatedAtRaw) {
                    return;
                }

                var updatedAt = parseInt(updatedAtRaw, 10);
                if (isNaN(updatedAt)) {
                    clearPersistedHistory();
                    return;
                }

                if (Date.now() - updatedAt > sessionLifetimeMs) {
                    clearPersistedHistory();
                }
            } catch (e) {
                // ignore storage issues
            }
        }

        function isPageReloadNavigation() {
            try {
                if (window.performance && typeof window.performance.getEntriesByType === 'function') {
                    var navEntries = window.performance.getEntriesByType('navigation');
                    if (Array.isArray(navEntries) && navEntries.length > 0) {
                        return navEntries[0].type === 'reload';
                    }
                }

                if (window.performance && window.performance.navigation) {
                    return window.performance.navigation.type === 1;
                }
            } catch (e) {
                // ignore detection issues
            }

            return false;
        }

        function persistHistory() {
            try {
                storage.setItem(storageKey, JSON.stringify(chatHistory.slice(-12)));
                touchHistoryTimestamp();
            } catch (e) {
                // ignore storage issues
            }
        }

        function addMessage(content, role) {
            var bubble = document.createElement('div');
            bubble.className = 'chatbot-message ' + role;
            bubble.textContent = content;
            messages.appendChild(bubble);

            if (role === 'user' || role === 'bot') {
                chatHistory.push({
                    role: role === 'user' ? 'user' : 'assistant',
                    content: content
                });
                persistHistory();
            }

            messages.scrollTop = messages.scrollHeight;
            updateQuickActionsVisibility();
        }

        function addTypingMessage() {
            var bubble = document.createElement('div');
            bubble.className = 'chatbot-message bot';
            bubble.textContent = '...';
            messages.appendChild(bubble);
            messages.scrollTop = messages.scrollHeight;
            return bubble;
        }

        function renderQuickActions() {
            quickActions.innerHTML = '';
            quickPrompts.forEach(function (prompt) {
                var chip = document.createElement('button');
                chip.className = 'chatbot-chip';
                chip.type = 'button';
                chip.textContent = prompt;
                chip.addEventListener('click', function () {
                    handleUserMessage(prompt);
                });
                quickActions.appendChild(chip);
            });
            updateQuickActionsVisibility();
        }

        async function requestBotReply(userMessage) {
            var controller = typeof AbortController !== 'undefined' ? new AbortController() : null;
            var timeoutId = null;

            if (controller) {
                timeoutId = window.setTimeout(function () {
                    controller.abort();
                }, 12000);
            }

            var response;
            try {
                response = await fetch('/chatbot/message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken()
                },
                signal: controller ? controller.signal : undefined,
                body: JSON.stringify({
                    message: userMessage,
                    history: chatHistory.slice(-8)
                })
            });

            } catch (error) {
                if (timeoutId) {
                    window.clearTimeout(timeoutId);
                }

                if (error && error.name === 'AbortError') {
                    throw new Error('chatbot_timeout');
                }

                throw new Error('chatbot_network_error');
            }

            if (timeoutId) {
                window.clearTimeout(timeoutId);
            }

            if (!response.ok) {
                if (response.status === 429) {
                    throw new Error('chatbot_rate_limited');
                }

                if (response.status === 419) {
                    throw new Error('chatbot_session_expired');
                }

                if (response.status >= 500) {
                    throw new Error('chatbot_server_error');
                }

                throw new Error('chatbot_request_failed');
            }

            var payload = await response.json();
            if (!payload || typeof payload.reply !== 'string' || payload.reply.trim() === '') {
                throw new Error('chatbot_invalid_payload');
            }

            return payload.reply.trim();
        }

        async function fetchBotReply(userMessage) {
            try {
                return await requestBotReply(userMessage);
            } catch (error) {
                var transientCodes = ['chatbot_network_error', 'chatbot_timeout', 'chatbot_server_error', 'chatbot_session_expired'];
                var shouldRetry = error && transientCodes.indexOf(error.message) !== -1;

                if (!shouldRetry) {
                    throw error;
                }

                await new Promise(function (resolve) {
                    window.setTimeout(resolve, 500);
                });

                return requestBotReply(userMessage);
            }
        }

        async function handleUserMessage(text) {
            var message = (text || '').trim();
            if (!message || requestInFlight) {
                return;
            }

            requestInFlight = true;
            setInputEnabled(false);

            addMessage(message, 'user');
            input.value = '';
            quickActions.classList.add('is-hidden');

            var typingBubble = addTypingMessage();

            try {
                var botReply = await fetchBotReply(message);
                typingBubble.remove();
                addMessage(botReply, 'bot');
            } catch (error) {
                typingBubble.remove();
                if (error && error.message === 'chatbot_rate_limited') {
                    addMessage('Vous envoyez des messages tres rapidement. Merci d\'attendre quelques secondes puis de reessayer.', 'bot');
                } else if (error && error.message === 'chatbot_session_expired') {
                    addMessage('Votre session a expire. Rechargez la page puis reessayez.', 'bot');
                } else {
                    addMessage('Je rencontre un souci technique temporaire. Merci de reessayer, ou contactez-nous via /contact.', 'bot');
                }
            } finally {
                requestInFlight = false;
                setInputEnabled(true);
            }
        }

        function initializeConversation() {
            var restored = [];

            if (isPageReloadNavigation()) {
                clearPersistedHistory();
            }

            resetHistoryIfExpired();

            try {
                restored = JSON.parse(storage.getItem(storageKey) || '[]');
            } catch (e) {
                restored = [];
            }

            if (Array.isArray(restored) && restored.length > 0) {
                chatHistory = restored.filter(function (item) {
                    return item && (item.role === 'user' || item.role === 'assistant') && typeof item.content === 'string' && item.content.trim() !== '';
                }).slice(-12);

                touchHistoryTimestamp();

                chatHistory.forEach(function (item) {
                    var bubble = document.createElement('div');
                    bubble.className = 'chatbot-message ' + (item.role === 'user' ? 'user' : 'bot');
                    bubble.textContent = item.content;
                    messages.appendChild(bubble);
                });

                messages.scrollTop = messages.scrollHeight;
                updateQuickActionsVisibility();
                return;
            }

            addMessage('Bonjour, je suis Edouard. Je peux vous aider en francais, english, espanol, italiano ou arabe. Decrivez votre besoin.', 'bot');
            updateQuickActionsVisibility();
        }

        function openChat() {
            panel.classList.add('is-open');
            launcher.setAttribute('aria-expanded', 'true');
            document.body.classList.add('chatbot-open');
            launcher.style.opacity = '0';
            launcher.style.pointerEvents = 'none';
            updatePanelHeightForViewport();
            input.focus();
        }

        function closeChat() {
            panel.classList.remove('is-open');
            launcher.setAttribute('aria-expanded', 'false');
            document.body.classList.remove('chatbot-open');
            launcher.style.opacity = '';
            launcher.style.pointerEvents = '';
            panel.style.height = '';
            panel.style.maxHeight = '';
        }

        function isMobileViewport() {
            return window.matchMedia('(max-width: 640px)').matches;
        }

        function updatePanelHeightForViewport() {
            if (!isMobileViewport() || !panel.classList.contains('is-open')) {
                return;
            }

            var viewportHeight = window.visualViewport ? window.visualViewport.height : window.innerHeight;
            var computedHeight = Math.floor(viewportHeight * 0.62);
            computedHeight = Math.max(260, Math.min(500, computedHeight));
            panel.style.height = computedHeight + 'px';
            panel.style.maxHeight = computedHeight + 'px';
            messages.scrollTop = messages.scrollHeight;
        }

        launcher.addEventListener('click', function () {
            if (panel.classList.contains('is-open')) {
                closeChat();
            } else {
                openChat();
            }
        });

        closeBtn.addEventListener('click', closeChat);

        form.addEventListener('submit', function (event) {
            event.preventDefault();
            handleUserMessage(input.value);
        });

        if (window.__yokkuteChatbotEscapeHandler) {
            document.removeEventListener('keydown', window.__yokkuteChatbotEscapeHandler);
        }

        window.__yokkuteChatbotEscapeHandler = function (event) {
            if (event.key === 'Escape') {
                closeChat();
            }
        };

        document.addEventListener('keydown', window.__yokkuteChatbotEscapeHandler);

        if (window.__yokkuteChatbotOutsideClickHandler) {
            document.removeEventListener('click', window.__yokkuteChatbotOutsideClickHandler);
        }

        window.__yokkuteChatbotOutsideClickHandler = function (event) {
            if (!panel.classList.contains('is-open')) {
                return;
            }

            var target = event.target;
            if (!(target instanceof Element)) {
                return;
            }

            if (panel.contains(target) || launcher.contains(target)) {
                return;
            }

            closeChat();
        };

        document.addEventListener('click', window.__yokkuteChatbotOutsideClickHandler);

        if (window.__yokkuteChatbotResizeHandler) {
            window.removeEventListener('resize', window.__yokkuteChatbotResizeHandler);
            if (window.visualViewport) {
                window.visualViewport.removeEventListener('resize', window.__yokkuteChatbotResizeHandler);
            }
        }

        window.__yokkuteChatbotResizeHandler = function () {
            updatePanelHeightForViewport();
        };

        window.addEventListener('resize', window.__yokkuteChatbotResizeHandler);
        if (window.visualViewport) {
            window.visualViewport.addEventListener('resize', window.__yokkuteChatbotResizeHandler);
        }

        renderQuickActions();
        initializeConversation();
    }

    document.addEventListener('DOMContentLoaded', createChatbot, { once: true });
    document.addEventListener('turbo:load', createChatbot);
})();
