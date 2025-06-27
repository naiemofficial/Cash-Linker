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
    <h1 class="text-md font-semibold text-gray-800 text-center mt-10">Daily Orders</h1>
    <div id="ordersDateChart"></div>
</div>

<script>
    // Ensure the DOM is fully loaded before running the script
    document.addEventListener('DOMContentLoaded', function () {
        // Simulate the Order::all() data. In a real application, this data would come from a backend API.
        // Each object represents an order, and we are interested in the 'created_at' date.
        const orders = @json($orders);

        // Function to generate dates for the last 30 days in YYYY-MM-DD format
        // This ensures all days in the range are included in the chart categories,
        // even if there are no orders for a specific day.
        function getLast30DaysYYYYMMDD() {
            const dates = [];
            const today = new Date();
            today.setHours(0, 0, 0, 0); // Normalize to the start of today for consistent date calculations

            // Loop from 29 days ago up to today (inclusive of 30 days total)
            for (let i = 29; i >= 0; i--) {
                const d = new Date(today);
                d.setDate(today.getDate() - i); // Subtract 'i' days from today
                const year = d.getFullYear();
                const month = String(d.getMonth() + 1).padStart(2, '0');
                const day = String(d.getDate()).padStart(2, '0');
                dates.push(`${year}-${month}-${day}`);
            }
            return dates;
        }

        const last30DaysYYYYMMDD = getLast30DaysYYYYMMDD();

        // Initialize aggregated data structure for all 30 days
        // Each day starts with 0 orders.
        const dailyOrderCounts = {};
        last30DaysYYYYMMDD.forEach(dateStr => {
            dailyOrderCounts[dateStr] = 0;
        });

        // Process the provided orders to aggregate counts by date
        orders.forEach(order => {
            // Extract just the date part (YYYY-MM-DD) from the ISO 8601 timestamp
            // This now correctly handles the 'T' separator.
            const orderDate = order.created_at.split('T')[0];
            // Only count orders that fall within our last 30-day range
            if (dailyOrderCounts.hasOwnProperty(orderDate)) {
                dailyOrderCounts[orderDate]++;
            }
        });

        // Prepare data for ApexCharts series and categories
        const categories = []; // These will be the formatted dates for the x-axis
        const seriesData = []; // These will be the order counts for each date

        last30DaysYYYYMMDD.forEach(dateStr => {
            // Convert YYYY-MM-DD string to "DD Mon, YYYY" for display
            const dateForLabel = new Date(dateStr);
            const options = { day: '2-digit', month: 'short', year: 'numeric' };
            // Using toLocaleDateString with 'en-GB' and replacing spaces ensures "04 Jan, 2025" format
            const formattedDateLabel = dateForLabel.toLocaleDateString('en-GB', options).replace(/ /g, ' ');
            categories.push(formattedDateLabel);
            seriesData.push(dailyOrderCounts[dateStr]);
        });

        // ApexCharts configuration
        const options = {
            chart: {
                type: 'area', // Area chart for a wave-like appearance
                height: 350,
                toolbar: {
                    show: false // Hide toolbar for a cleaner look
                },
                zoom: {
                    enabled: false
                }
            },
            series: [{
                name: 'Total Orders',
                data: seriesData
            }],
            xaxis: {
                categories: categories, // Use the pre-formatted date strings
                title: {
                    text: 'Date',
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
                    // The formatter simply returns the category value, as it's already formatted
                    formatter: function (val) {
                        return val;
                    },
                    rotate: -45, // Rotate labels by 45 degrees
                    rotateAlways: true, // Force rotation for better readability
                    offsetY: 0, // Adjust vertical offset if needed after rotation
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
                    }
                },
                // Ensure y-axis labels are integers and start from 0
                min: 0,
                forceNiceScale: true,
                labels: {
                    formatter: function (val) {
                        return Math.round(val);
                    }
                }
            },
            tooltip: {
                theme: 'light',
                x: {
                    formatter: function (val, { dataPointIndex }) { // Destructure dataPointIndex
                        return categories[dataPointIndex]; // Access the formatted date from categories
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
            stroke: {
                curve: 'smooth', // Make the line smooth for a wave effect
                width: 3 // Thicker line for better visibility
            },
            fill: {
                type: 'gradient', // Gradient fill for a more visually appealing area
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100],
                    colorStops: [
                        {
                            offset: 0,
                            color: '#3B82F6', // Start color (blue)
                            opacity: 0.8
                        },
                        {
                            offset: 100,
                            color: '#60A5FA', // End color (lighter blue)
                            opacity: 0.1
                        }
                    ]
                },
                colors: ['#3B82F6'] // Fallback color if gradient is not supported
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
        const chart = new ApexCharts(document.querySelector("#ordersDateChart"), options);
        chart.render();
    });
</script>
