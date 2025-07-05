import Chart from "chart.js/auto";

document.addEventListener('alpine:init', () => {
    Alpine.data('tabs', () => ({
        activeTab: null,
        init() {
            // Set the first tab as active by default
            this.activeTab = this.$el.querySelector('[data-tab]').dataset.tab;
        },
        setActiveTab(tabId) {
            this.activeTab = tabId;
        },
        isActive(tabId) {
            return this.activeTab === tabId;
        }
    }));


    const ctx = document.getElementById('submissionChart');
    if (ctx) {
        const submissionChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Submissions',
                    data: [12, 19, 3, 5, 2, 3, 7],
                    borderColor: 'rgba(59, 130, 246, 1)',
                    tension: 0.4,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
});
