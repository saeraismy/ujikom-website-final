<div id="agenda" class="events_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="news_taital">
                    <i class="fas fa-calendar me-2"></i>
                    Agenda Sekolah
                </h1>
            </div>
        </div>

        <div class="calendar-container">
            <div class="calendar-header">
                <button class="btn btn-link" id="prevMonth"><i class="fas fa-chevron-left"></i></button>
                <h2 id="monthDisplay"></h2>
                <button class="btn btn-link" id="nextMonth"><i class="fas fa-chevron-right"></i></button>
            </div>

            <div class="calendar-grid">
                <div class="calendar-days">
                    <div>Minggu</div>
                    <div>Senin</div>
                    <div>Selasa</div>
                    <div>Rabu</div>
                    <div>Kamis</div>
                    <div>Jumat</div>
                    <div>Sabtu</div>
                </div>
                <div id="calendarBody" class="calendar-dates">
                    <!-- Calendar dates will be inserted here by JavaScript -->
                </div>
            </div>
        </div>

        <!-- Modal -->
        @foreach($agenda as $item)
            <div class="modal fade" id="agendaModal{{ $item['id'] }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="row">
                                @if(isset($item['gallery']) && isset($item['gallery']['images']) && count($item['gallery']['images']) > 0)
                                    <div class="col-md-5">
                                        <div class="modal-img">
                                            <img src="{{ asset('images/' . $item['gallery']['images'][0]['file']) }}"
                                                alt="{{ $item['gallery']['images'][0]['judul'] }}"
                                                class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                @else
                                    <div class="col-md-12">
                                @endif
                                        <h5 class="modal-content-title">{{ $item['judul'] }}</h5>
                                        <div class="agenda-details mb-3">
                                            <p class="agenda-date-info">
                                                <i class="fas fa-calendar-alt me-2"></i>
                                                {{ \Carbon\Carbon::parse($item['tanggal'])->isoFormat('dddd, D MMMM Y') }}
                                            </p>
                                        </div>
                                        <div class="modal-content-scroll">
                                            <p>{{ $item['isi'] }}</p>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('styles')
<style>
/* Calendar Container */
.calendar-container {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.1);
    padding: 20px;
    margin-top: 20px;
    width: 100%;
}

/* Calendar Header */
.calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    margin-bottom: 20px;
    background: #f8f9fa;
    border-radius: 8px;
}

#monthDisplay {
    font-size: 1.5rem;
    font-weight: bold;
    margin: 0;
    color: #120a78;
}

/* Calendar Grid */
.calendar-grid {
    width: 100%;
    background: #fff;
    border: 1px solid #dee2e6;
    border-radius: 8px;
}

/* Calendar Days Header */
.calendar-days {
    display: grid !important;
    grid-template-columns: repeat(7, 1fr) !important;
    background: #120a78;
    color: white;
    padding: 10px 0;
    text-align: center;
    font-weight: bold;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

.calendar-days > div {
    padding: 10px;
    font-size: 0.9rem;
}

/* Calendar Dates Grid */
.calendar-dates {
    display: grid !important;
    grid-template-columns: repeat(7, 1fr) !important;
    gap: 1px;
    background: #dee2e6;
    padding: 1px;
}

/* Calendar Date Cells */
.calendar-date {
    aspect-ratio: 1;
    background: white;
    padding: 8px;
    min-height: 100px;
    position: relative;
    display: flex;
    flex-direction: column;
}

.calendar-date:hover {
    background: #f8f9fa;
}

.calendar-date.has-event {
    background: #e3f2fd;
    cursor: pointer;
}

.calendar-date.has-event:hover {
    background: #bbdefb;
}

/* Date Number */
.date-number {
    position: absolute;
    top: 5px;
    left: 5px;
    font-size: 14px;
    font-weight: bold;
    color: #666;
}

/* Event Preview */
.event-preview {
    font-size: 12px;
    padding-top: 25px;
    margin-top: 5px;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    color: #120a78;
}

/* Event Dot */
.event-dot {
    width: 8px;
    height: 8px;
    background-color: #120a78;
    border-radius: 50%;
    position: absolute;
    bottom: 5px;
    left: 50%;
    transform: translateX(-50%);
}

/* Navigation Buttons */
#prevMonth, #nextMonth {
    background: #120a78;
    border: none;
    color: white;
    padding: 8px 15px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

#prevMonth:hover, #nextMonth:hover {
    background: #f64646;
}

/* Responsive Design */
@media (max-width: 768px) {
    .calendar-days > div {
        font-size: 0.8rem;
        padding: 5px;
    }

    .calendar-date {
        min-height: 80px;
    }

    .event-preview {
        font-size: 10px;
        -webkit-line-clamp: 1;
    }
}

/* Empty Cells */
.calendar-date:empty {
    background: #f8f9fa;
}

/* Modal Styles */
.modal-content {
    border: none;
    border-radius: 10px;
    overflow: hidden;
}

.modal-body {
    padding: 30px;
    position: relative;
}

.modal-body .close {
    position: absolute;
    right: 20px;
    top: 20px;
    z-index: 1;
    color: #333;
    opacity: 0.5;
    font-size: 1.5rem;
}

.modal-body .close:hover {
    opacity: 1;
}

.modal-content-title {
    color: #120a78;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 1px solid #eee;
}

.agenda-date-info {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 15px;
}

.agenda-date-info i {
    color: #120a78;
}

.modal-content-scroll {
    max-height: 300px;
    overflow-y: auto;
    padding-right: 10px;
}

.modal-footer {
    border-top: 1px solid #dee2e6;
    padding: 15px;
}

.btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background-color: #5a6268;
    border-color: #545b62;
}

/* Responsive Modal */
@media (max-width: 768px) {
    .modal-content-scroll {
        max-height: 200px;
    }

    .modal-img {
        margin-bottom: 15px;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const agendaData = @json($agenda);
    let currentDate = new Date();

    function renderCalendar(date) {
        const firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
        const lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
        const startingDay = firstDay.getDay();

        document.getElementById('monthDisplay').textContent =
            new Intl.DateTimeFormat('id-ID', { month: 'long', year: 'numeric' }).format(date);

        const calendarBody = document.getElementById('calendarBody');
        calendarBody.innerHTML = '';

        // Add empty cells for days before the first day of the month
        for(let i = 0; i < startingDay; i++) {
            calendarBody.appendChild(createDateCell(''));
        }

        // Add cells for each day of the month
        for(let day = 1; day <= lastDay.getDate(); day++) {
            const currentDateString = `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const events = agendaData.filter(event => event.tanggal === currentDateString);

            const cell = createDateCell(day, events);
            calendarBody.appendChild(cell);
        }
    }

    function createDateCell(day, events = []) {
        const cell = document.createElement('div');
        cell.className = 'calendar-date' + (events.length > 0 ? ' has-event' : '');

        if(day) {
            cell.innerHTML = `
                <span class="date-number">${day}</span>
                ${events.length > 0 ? `
                    <div class="event-preview">${events[0].judul}</div>
                    <div class="event-dot"></div>
                ` : ''}
            `;

            if(events.length > 0) {
                cell.addEventListener('click', () => {
                    $('#agendaModal' + events[0].id).modal('show');
                });
            }
        }

        return cell;
    }

    document.getElementById('prevMonth').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar(currentDate);
    });

    document.getElementById('nextMonth').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar(currentDate);
    });

    renderCalendar(currentDate);
});

// Tambahkan ini untuk memastikan modal berfungsi
$(document).ready(function() {
    // Inisialisasi modal Bootstrap
    $('.modal').modal({
        show: false
    });

    // Debug untuk memeriksa data agenda
    console.log('Agenda Data:', @json($agenda));
});
</script>
@endpush
