// const root = new Vue({
//     el: '#root',
//     data: {
//         message: 'Hello World',
//         user: 'Sanya'
//     }
// });

const game = new Vue({
    el: '#game',
    data: {
        result: 'Давай начнем',
        count: 0,
        seconds: 10,
        isStart: false,
        win: 0,
        intervalId: null
    },

    methods: {
        onClick() {
            this.count++;
        },

        startGame() {
            this.isStart = true;
            this.result = 'Игра началась';
            this.wins = this.seconds * 3;

            this.intervalId = setInterval(() => {
                if (this.seconds === 0) {
                    if (this.count >= this.wins) {
                        this.result = `Ура! Вы выиграли ${this.wins}`
                    } else {
                        this.result = `Вы лузер ${this.wins}`
                    }

                    clearInterval(this.intervalId);
                } else {
                    this.seconds--;
                }
            }, 1000)
        },

        restartGame() {
            this.result = 'Игра началась';
            this.count = 0;
            this.seconds = 10;
            this.isStart = false;

            clearInterval(this.intervalId);
        }
    }
});