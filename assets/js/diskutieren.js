var moment = require("moment");
var duration = require("moment-duration-format")


window.calendar = function () {
    return {
        month: '',
        year: '',
        no_of_days: [],
        blankdays: [],
        days: ['Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa', 'So'],
        month_names: ['Jänner', 'Feber', 'März', 'April', 'Main', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'],

        events: [
            {
                event_date: new Date(2020, 11, 10),
                event_title: "April Fool's Day",
                event_theme: 'blue',
                event_time: '16:00'
            },

            {
                event_date: new Date(2020, 11, 10),
                event_title: "Birthday",
                event_theme: 'red',
                event_time: '16:00'
            },

            {
                event_date: new Date(2020, 11, 16),
                event_title: "Upcoming Event",
                event_theme: 'green',
                event_time: '16:00'
            }
        ],
        event_title: '',
        event_date: '',
        event_theme: 'blue',

        themes: [
            {
                value: "blue",
                label: "Blue Theme"
            },
            {
                value: "red",
                label: "Red Theme"
            },
            {
                value: "yellow",
                label: "Yellow Theme"
            },
            {
                value: "green",
                label: "Green Theme"
            },
            {
                value: "purple",
                label: "Purple Theme"
            }
        ],

        openEventModal: false,

        initDate() {
            let today = new Date();
            this.month = today.getMonth();
            this.year = today.getFullYear();
            this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();


            setTimeout(() => {
                this.events.push(
                    {
                        event_date: new Date(2020, 11, 1),
                        event_title: "Upcoming Event",
                        event_theme: 'green',
                        event_time: '16:00'
                    }
                )
            }, 3000)

        },

        isToday(date) {
            const today = new Date();
            const d = new Date(this.year, this.month, date);

            return today.toDateString() === d.toDateString() ? true : false;
        },

        showEventModal(date) {
            // open the modal
            this.openEventModal = true;
            this.event_date = new Date(this.year, this.month, date).toDateString();
        },

        addEvent() {
            if (this.event_title == '') {
                return;
            }

            this.events.push({
                event_date: this.event_date,
                event_title: this.event_title,
                event_theme: this.event_theme
            });

            console.log(this.events);

            // clear the form data
            this.event_title = '';
            this.event_date = '';
            this.event_theme = 'blue';

            //close the modal
            this.openEventModal = false;
        },
        prevMonth() {
            if (this.month > 0) {
                this.month--;
            } else {
                this.year--;
                this.month = 11;
            }
        },
        nextMonth() {

            if (this.month < 11) {
                this.month++
            } else {
                this.year++;
                this.month = 0;
            }


        },
        getNoOfDays() {
            let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

            // find where to start calendar day of week
            let dayOfWeek = new Date(this.year, this.month).getDay();
            dayOfWeek--;
            if (dayOfWeek < 0) dayOfWeek = 6;

            let blankdaysArray = [];
            for (var i = 1; i <= dayOfWeek; i++) {
                blankdaysArray.push(i);
            }

            let daysArray = [];
            for (var i = 1; i <= daysInMonth; i++) {
                daysArray.push(i);
            }

            this.blankdays = blankdaysArray;
            this.no_of_days = daysArray;
        }
    }
}


window.counter = function (datetime) {
    return {
        end: datetime,
        counts: '',
        days: '',
        hours: '',
        minutes: '',
        seconds: '',
        count() {


            setInterval(() => {
                const zeroPad = (num, places) => String(num).padStart(places, '0')
                var diff = moment().diff(moment(this.end), 'seconds') * -1;
                this.days = zeroPad(parseInt(diff / (60 * 60 * 24)), 2);
                this.hours = zeroPad(parseInt((diff - (this.days * 60 * 60 * 24)) / (60 * 60)),2);
                this.minutes = zeroPad(parseInt((diff - ((this.days * 60 * 60 * 24) + (this.hours * 60 * 60))) / 60),2);
                this.seconds = zeroPad(parseInt((diff - ((this.days * 60 * 60 * 24) + (this.hours * 60 * 60) + (this.minutes * 60)))),2);
            }, 1000)
        }
    }
}