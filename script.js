function updateTime() {
    const now = new Date();
    const timeElement = document.getElementById('time');
    const dateElement = document.getElementById('date');

    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    const date = now.toDateString();

    const currentTime = `${hours}:${minutes}:${seconds}`;
    const currentDate = `Today is ${date}`;

    timeElement.textContent = currentTime;
    dateElement.textContent = currentDate;
}

setInterval(updateTime, 1000); // Update the time every second

updateTime(); // Initial call to display the time immediately