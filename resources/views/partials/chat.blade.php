<div class="bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
        <h2 class="text-lg font-semibold text-gray-800">Conversation</h2>
    </div>

    <div id="messages-container" class="h-96 overflow-y-auto p-6 space-y-4 bg-gray-50">
        @forelse($messages as $message)
            @php $isMe = $message->sender_id === auth()->id(); @endphp

            <div class="message-item flex {{ $isMe ? 'justify-end' : 'justify-start' }}"
                data-message-id="{{ $message->_id }}">

                @if($isMe)
                    {{-- MY message: [bubble] [avatar] --}}
                    <div class="flex items-end gap-2">
                        <div class="max-w-xs lg:max-w-md">
                            <div class="px-4 py-2 rounded-lg bg-blue-600 text-white">
                                <p class="text-sm break-words">{{ $message->message }}</p>
                            </div>
                            <div class="flex items-center mt-1 space-x-2 text-xs text-gray-500 justify-end">
                                <span>{{ $message->created_at->format('h:i A') }}</span>
                                <span>•</span>
                                <span>{{ $message->is_seen ? 'Seen' : 'Sent' }}</span>
                            </div>
                        </div>
                        <div class="flex-shrink-0 w-8 h-8 rounded-full
                                    {{ $message->role->value === \App\Enums\Roles::CUSTOMER->value ? 'bg-blue-500' : ($message->role->value === \App\Enums\Roles::AGENT->value ? 'bg-green-500' : 'bg-purple-500') }}
                                    flex items-center justify-center text-white text-sm font-semibold">
                            {{ strtoupper(substr($message->role->value, 0, 1)) }}
                        </div>
                    </div>
                @else
                    {{-- OTHER message: [avatar] [bubble] --}}
                    <div class="flex items-end gap-2">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full
                                    {{ $message->role->value === \App\Enums\Roles::CUSTOMER->value ? 'bg-blue-500' : ($message->role->value === \App\Enums\Roles::AGENT->value ? 'bg-green-500' : 'bg-purple-500') }}
                                    flex items-center justify-center text-white text-sm font-semibold">
                            {{ strtoupper(substr($message->role->value, 0, 1)) }}
                        </div>
                        <div class="max-w-xs lg:max-w-md">
                            <div class="px-4 py-2 rounded-lg bg-white border border-gray-200 text-gray-800">
                                <p class="text-sm break-words">{{ $message->message }}</p>
                            </div>
                            <div class="flex items-center mt-1 space-x-2 text-xs text-gray-500 justify-start">
                                <span>{{ $message->created_at->format('h:i A') }}</span>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        @empty
            <div class="flex items-center justify-center h-full">
                <div class="text-center text-gray-500">
                    <i class="fas fa-comments text-4xl mb-2"></i>
                    <p>No messages yet. Start the conversation!</p>
                </div>
            </div>
        @endforelse
    </div>

    @if(!auth()->user()->isAdmin() && !in_array($ticket->status->value, [\App\Enums\TicketStatus::CLOSED->value, \App\Enums\TicketStatus::RESOLVED->value]))
        <form id="chat-form-{{ $ticket->id }}" class="chat-form px-6 py-4 border-t border-gray-200 bg-white">
            @csrf
            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <div class="flex space-x-3">
                <textarea name="message"
                    class="message-input flex-1 resize-none rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    rows="2" placeholder="Type your message..." maxlength="5000"></textarea>
                <button type="button"
                    class="send-btn px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors flex items-center justify-center"
                    onclick="sendChatMessage('{{ $ticket->id }}')">
                    <i class="fas fa-paper-plane mr-2"></i>
                    Send
                </button>
            </div>
            <div class="error-msg mt-2 text-red-600 text-sm hidden"></div>
        </form>
    @else
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            <p class="text-sm text-gray-600 text-center">
                <i class="fas fa-eye mr-2"></i>
                Ticket is Closed or Resolved, You are viewing this conversation in read-only mode.
            </p>
        </div>
    @endif
</div>


<script>
    function sendChatMessage(ticketId) {
        var form = document.getElementById('chat-form-' + ticketId);
        var messageInput = form.querySelector('.message-input');
        var sendBtn = form.querySelector('.send-btn');
        var errorMsg = form.querySelector('.error-msg');
        var container = document.getElementById('messages-container');
        var userId = parseInt(form.querySelector('input[name="user_id"]').value);

        var message = messageInput.value.trim();

        if (!message) {
            alert('Please type a message');
            return;
        }

        sendBtn.disabled = true;
        sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
        messageInput.disabled = true;
        errorMsg.classList.add('hidden');

        const url = "{{ auth()->user()->isAgent() ? route('dashboard.agent.message.post', ':ticketId') : route('message.post', ':ticketId') }}".replace(':ticketId', ticketId);
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ message: message })
        })
            .then(function (response) { return response.json(); })
            .then(function (data) {
                if (data.success) {
                    messageInput.value = '';
                    appendMessage(data.message, userId);
                    container.scrollTop = container.scrollHeight;
                } else {
                    errorMsg.textContent = data.error || 'Failed to send';
                    errorMsg.classList.remove('hidden');
                }
            })
            .catch(function (error) {
                console.error('Error:', error);
                errorMsg.textContent = 'Error sending message';
                errorMsg.classList.remove('hidden');
            })
            .finally(function () {
                sendBtn.disabled = false;
                sendBtn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i> Send';
                messageInput.disabled = false;
            });
    }

    function appendMessage(message, currentUserId) {
        var container = document.getElementById('messages-container');

        if (document.querySelector('[data-message-id="' + message.id + '"]')) return;

        var isMe = message.sender_id === currentUserId;

        var roleColors = { customer: 'bg-blue-500', agent: 'bg-green-500', admin: 'bg-purple-500' };
        var avatarColor = roleColors[message.role] || 'bg-gray-500';
        var avatarLetter = message.role.charAt(0).toUpperCase();

        var avatar = '<div class="flex-shrink-0 w-8 h-8 rounded-full ' + avatarColor + ' flex items-center justify-center text-white text-sm font-semibold">' + avatarLetter + '</div>';

        var bubble = '<div class="max-w-xs lg:max-w-md">'
            + '<div class="px-4 py-2 rounded-lg ' + (isMe ? 'bg-blue-600 text-white' : 'bg-white border border-gray-200 text-gray-800') + '">'
            + '<p class="text-sm break-words">' + escapeHtml(message.message) + '</p>'
            + '</div>'
            + '<div class="flex items-center mt-1 space-x-2 text-xs text-gray-500 ' + (isMe ? 'justify-end' : 'justify-start') + '">'
            + '<span>Just now</span>'
            + '</div>'
            + '</div>';

        var msgDiv = document.createElement('div');
        msgDiv.className = 'message-item flex ' + (isMe ? 'justify-end' : 'justify-start');
        msgDiv.setAttribute('data-message-id', message.id);

        var inner = document.createElement('div');
        inner.className = 'flex items-end gap-2';
        // KEY: avatar goes AFTER bubble for "me", BEFORE for others
        inner.innerHTML = isMe ? (bubble + avatar) : (avatar + bubble);

        msgDiv.appendChild(inner);
        container.appendChild(msgDiv);
    }

    function escapeHtml(text) {
        var div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    document.addEventListener('DOMContentLoaded', function () {
        var form = document.querySelector('.chat-form');
        if (form && typeof window.pusher !== 'undefined') {
            var ticketId = form.querySelector('input[name="ticket_id"]').value;
            var userId = parseInt(form.querySelector('input[name="user_id"]').value);
            var channelName = 'private-ticket.' + ticketId;
            var channel = window.pusher.subscribe(channelName);

            channel.bind('pusher:subscription_succeeded', function (members) {
                console.log('%c✅ Pusher subscription succeeded!', 'color: green; font-weight: bold', members);
            });
            channel.bind('pusher:subscription_error', function (status) {
                console.log('%c❌ Pusher subscription error:', 'color: red; font-weight: bold', status);
            });
            channel.bind('message.sent', function (data) {
                appendMessage(data.message, userId);
                var container = document.getElementById('messages-container');
                container.scrollTop = container.scrollHeight;
            });
        }

        var container = document.getElementById('messages-container');
        if (container) container.scrollTop = container.scrollHeight;
    });
</script>