setTimeout(function() {
    var messages = document.querySelectorAll('.message');
    messages.forEach(function(message) {
        message.remove();
    });
}, 3000);