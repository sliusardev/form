import Chart from "chart.js/auto";

document.addEventListener('DOMContentLoaded', () => {
    sidebarToggle();
    mainChart();
});

function sidebarToggle() {
    const sidebar = document.getElementById('sidebar');
    const toggles = document.querySelectorAll('#sidebarToggle, #sidebarCollapse');

    function toggleSidebar() {
        sidebar.classList.toggle('xl:hidden');
        document.getElementById('sidebar').classList.toggle('hidden');
    }

    toggles.forEach(btn => {
        btn?.addEventListener('click', toggleSidebar);
    });
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
