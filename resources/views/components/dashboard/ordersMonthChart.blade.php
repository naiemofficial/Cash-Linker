<style>
    .chart-container {
        width: 100%;
    }
    /* ApexCharts default styles might need slight adjustments for consistency */
    .apexcharts-tooltip {
        border-radius: 0.5rem !important;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
    }
</style>

<div class="chart-container">
    <h1 class="text-md font-semibold text-gray-800 text-center mt-10">Monthly Orders</h1>
    <div id="ordersMonthChart"></div>
</div>

<script>
    // Ensure the DOM is fully loaded before running the script
    document.addEventListener('DOMContentLoaded', function () {
        // Simulate the Order::all() data. In a real application, this data would come from a backend API.
        // Each object represents an order, and we are interested in the 'created_at' date.
        const orders = @json($orders);

        // Function to generate months for the last 12 months
        // This function dynamically creates a list of "YYYY-MM" strings for the past year.
        function getLast12MonthsFormatted() {
            const months = [];
            const currentDate = new Date(); // Get current date
            currentDate.setDate(1); // Set to 1st of month to avoid issues with month lengths when subtracting

            // Loop to get the last 12 months in YYYY-MM format
            for (let i = 0; i < 12; i++) {
                const year = currentDate.getFullYear();
                const month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Month is 0-indexed
                months.unshift(`${year}-${month}`); // Add to the beginning to keep chronological order
                currentDate.setMonth(currentDate.getMonth() - 1); // Go back one month
            }
            return months;
        }

        const last12MonthsYYYYMM = getLast12MonthsFormatted();

        // Initialize aggregated data structure for all 12 months, ensuring all are present
        const monthlyData = {};
        last12MonthsYYYYMM.forEach(monthYear => {
            monthlyData[monthYear] = 0; // Initialize count to 0 for each month
        });

        // Process the orders to get total counts per month
        orders.forEach(order => {
            // Extract YYYY-MM from the 'created_at' string (e.g., "2025-06")
            const monthYear = order.created_at.substring(0, 7);
            if (monthlyData.hasOwnProperty(monthYear)) { // Check if the month is within our 12-month range
                monthlyData[monthYear]++;
            }
        });

        // Prepare data for ApexCharts series and categories
        const categories = [];
        const seriesTotalOrders = [];

        last12MonthsYYYYMM.forEach(monthYear => {
            const [year, month] = monthYear.split('-');
            // Create a Date object for formatting, using the 1st of the month
            const dateForLabel = new Date(parseInt(year), parseInt(month) - 1, 1);
            // Format: "Jan 2024"
            const monthLabel = dateForLabel.toLocaleString('en-US', { month: 'short', year: 'numeric' });
            categories.push(monthLabel);
            seriesTotalOrders.push(monthlyData[monthYear]);
        });

        const options = {
            chart: {
                type: 'bar', // Bar chart type
                height: 350,
                stacked: false, // Stacking disabled as there's only one series
                toolbar: {
                    show: false // Hide toolbar for a cleaner look
                },
                zoom: {
                    enabled: false
                }
            },
            series: [{
                name: 'Total Orders', // Single series name
                data: seriesTotalOrders
            }],
            xaxis: {
                categories: categories,
                title: {
                    text: 'Month',
                    style: {
                        color: '#555',
                        fontSize: '14px',
                        fontFamily: 'Inter, sans-serif',
                        fontWeight: 600,
                    }
                },
                labels: {
                    style: {
                        colors: '#333',
                        fontSize: '12px',
                        fontFamily: 'Inter, sans-serif',
                    },
                    formatter: function (val) {
                        return val; // Categories are already formatted as "Jan 2024"
                    },
                    rotate: -45, // Rotate labels by 45 degrees
                    rotateAlways: true, // Force rotation
                    offsetY: 0, // No vertical offset needed for rotation
                }
            },
            yaxis: {
                title: {
                    text: 'Number of Orders',
                    style: {
                        color: '#555',
                        fontSize: '14px',
                        fontFamily: 'Inter, sans-serif',
                        fontWeight: 600,
                    }
                },
                labels: {
                    style: {
                        colors: '#333',
                        fontSize: '12px',
                        fontFamily: 'Inter, sans-serif',
                    },
                    formatter: function (val) {
                        return Math.round(val);
                    }
                }
            },
            tooltip: {
                theme: 'light',
                x: {
                    formatter: function (val) {
                        return val; // Categories are already formatted
                    }
                },
                y: {
                    formatter: function (val) {
                        return val + " orders"
                    }
                },
                style: {
                    fontSize: '12px',
                    fontFamily: 'Inter, sans-serif',
                }
            },
            dataLabels: {
                enabled: false // Hide data labels on bars
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            fill: {
                opacity: 1,
                colors: ['#3B82F6'] // Single color for the bars (blue)
            },
            grid: {
                borderColor: '#e0e0e0', // Lighter grid lines
                strokeDashArray: 4, // Dashed grid lines
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            responsive: [
                {
                    breakpoint: 768, // For tablets and smaller
                    options: {
                        chart: {
                            height: 300
                        },
                        xaxis: {
                            labels: {
                                rotate: -45,
                                rotateAlways: true,
                                offsetY: 0
                            }
                        }
                    }
                },
                {
                    breakpoint: 480, // For mobile devices
                    options: {
                        chart: {
                            height: 250
                        },
                        xaxis: {
                            labels: {
                                rotate: -90,
                                rotateAlways: true,
                                offsetY: 0
                            }
                        }
                    }
                }
            ]
        };

        // Render the chart
        const chart = new ApexCharts(document.querySelector("#ordersMonthChart"), options);
        chart.render();
    });
</script>
