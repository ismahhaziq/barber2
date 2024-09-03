
        const intro = introJs();

        intro.setOptions({
            steps: [
                {
                    intro: 'Welcome admin! Let\'s take a tour!'
                },
                {
                    element: '#step-one',
                    intro: 'This is your analytics dashboard where you can see the report of appointment.',
                    position: 'right',
                },
                {
                    element: '#step-one-one',
                    intro: 'This is total of ongoing appoinment.',
                    position: 'right',
                },
                {
                    element: '#step-two',
                    intro: 'These our services provided.',
                    position: 'bottom',
                },
                {
                    element: '#step-three',
                    intro: 'Here you can contact us if you encounter any problem.'
                },
                {
                    intro: 'That\'s all! Please enjoy our system!'
                },
            ],

            showProgress: true,
            showBullets: false
        })

        intro.setOptions({ 
            skipLabel: 'Exit',
            nextLabel: '>',
            prevLabel: '<',
        });

        intro.start();
        intro.refresh();