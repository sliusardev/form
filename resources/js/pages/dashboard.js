import Chart from "chart.js/auto";

document.addEventListener('DOMContentLoaded', function() {
    sidebarToggle();
    mainChart();
});

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
});

function sidebarToggle() {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebarToggle');
    const toggleSidebarBtn = document.getElementById('sidebarCollapse');

    function toggleSidebar() {
        sidebar.classList.toggle('hidden');
        sidebar.classList.toggle('xl:hidden');
    }

    toggleBtn.addEventListener('click', toggleSidebar);
    toggleSidebarBtn.addEventListener('click', toggleSidebar);
}

function mainChart() {
    const ctx = document.getElementById('submissionChart');
    if (ctx) {
        // Use real data from backend if available
        const labels = window.submissionChartLabels || ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        const data = window.submissionChartCounts || [0, 0, 0, 0, 0, 0, 0];

        const submissionChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Submissions',
                    data: data,
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
}
