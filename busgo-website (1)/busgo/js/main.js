// ===== DARK MODE =====
function toggleDark() {
    document.body.classList.toggle('dark-mode');
    const btn = document.getElementById('darkToggle');
    if (document.body.classList.contains('dark-mode')) {
        btn.textContent = '☀️ Light Mode';
        localStorage.setItem('theme', 'dark');
    } else {
        btn.textContent = '🌙 Dark Mode';
        localStorage.setItem('theme', 'light');
    }
}

// Load saved theme
window.addEventListener('DOMContentLoaded', () => {
    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark-mode');
        const btn = document.getElementById('darkToggle');
        if (btn) btn.textContent = '☀️ Light Mode';
    }
});

// ===== SEARCH BUSES =====
function searchBuses() {
    const from = document.getElementById('fromCity')?.value.trim();
    const to = document.getElementById('toCity')?.value.trim();
    const date = document.getElementById('travelDate')?.value;

    if (!from || !to) {
        alert('Please enter both From and To cities.');
        return;
    }
    if (!date) {
        alert('Please select a travel date.');
        return;
    }

    // Scroll to bus listings
    document.getElementById('busContainer')?.scrollIntoView({ behavior: 'smooth' });
}

// ===== SEAT BOOKING =====
let selectedSeats = [];
const bookedSeats = [3, 7, 11, 15, 19];

function initSeats(totalSeats, pricePerSeat) {
    const layout = document.getElementById('seatLayout');
    if (!layout) return;

    for (let i = 1; i <= totalSeats; i++) {
        const seat = document.createElement('div');
        seat.classList.add('seat');
        seat.textContent = i;
        seat.dataset.seat = i;

        if (bookedSeats.includes(i)) {
            seat.classList.add('booked');
        } else {
            seat.addEventListener('click', () => toggleSeat(seat, i, pricePerSeat));
        }

        layout.appendChild(seat);
    }
}

function toggleSeat(el, seatNum, price) {
    if (el.classList.contains('selected')) {
        el.classList.remove('selected');
        selectedSeats = selectedSeats.filter(s => s !== seatNum);
    } else {
        el.classList.add('selected');
        selectedSeats.push(seatNum);
    }
    updateTotal(price);
}

function updateTotal(price) {
    const totalEl = document.getElementById('totalAmount');
    if (!totalEl) return;
    const count = selectedSeats.length;
    if (count === 0) {
        totalEl.textContent = 'No seats selected';
    } else {
        totalEl.textContent = `${count} seat${count > 1 ? 's' : ''} selected — ₹${count * price}`;
    }
}

function confirmBooking() {
    if (selectedSeats.length === 0) {
        alert('Please select at least one seat.');
        return;
    }
    const params = new URLSearchParams(window.location.search);
    const bus = params.get('bus') || 'Bus';
    alert(`✅ Booking confirmed!\nBus: ${bus}\nSeats: ${selectedSeats.join(', ')}\nThank you for choosing BusGo!`);
    selectedSeats = [];
    document.querySelectorAll('.seat.selected').forEach(s => s.classList.remove('selected'));
    updateTotal(350);
}

// ===== LOGIN / REGISTER =====
function handleLogin(e) {
    e.preventDefault();
    const email = document.getElementById('loginEmail')?.value;
    const pass = document.getElementById('loginPass')?.value;
    if (email && pass) {
        alert(`Welcome back! Logged in as ${email}`);
    }
}

function handleRegister(e) {
    e.preventDefault();
    const name = document.getElementById('regName')?.value;
    const email = document.getElementById('regEmail')?.value;
    if (name && email) {
        alert(`Account created for ${name}! Please login.`);
        window.location.href = 'login.html';
    }
}

// ===== CONTACT FORM =====
function handleContact(e) {
    e.preventDefault();
    alert('✅ Your message has been sent! We will get back to you within 24 hours.');
    e.target.reset();
}
