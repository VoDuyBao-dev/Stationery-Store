document.addEventListener('DOMContentLoaded', function() {
    // Khởi tạo biểu đồ khi load trang
    fetchData('7days');

    // Xử lý khi thay đổi loại thống kê
    document.getElementById('type-select').addEventListener('change', function() {
        const customDateRange = document.getElementById('customDateRange');
        if (this.value === 'custom') {
            customDateRange.classList.remove('d-none');
        } else {
            customDateRange.classList.add('d-none');
            fetchData(this.value);
        }
    });

    // Xử lý submit form tùy chỉnh thời gian
    document.getElementById('filterForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const fromDate = document.getElementById('fromDate').value;
        const toDate = document.getElementById('toDate').value;

        // Validate ngày
        if (fromDate > toDate) {
            alert('Ngày bắt đầu phải nhỏ hơn ngày kết thúc');
            return;
        }

        fetchCustomData(fromDate, toDate);
    });
});

let chart = null; // Global chart instance

function renderChart(categories, revenue) {
    // Destroy existing chart if any
    if (chart) {
        chart.destroy();
    }

    const options = {
        series: [{
            name: 'Doanh thu',
            data: revenue
        }],
        chart: {
            height: 350,
            type: 'area'
        },
        colors: ["#34eb71"],
        dataLabels: {
            enabled: true,
            formatter: function(val) {
                return val.toLocaleString('vi-VN') + ' VNĐ';
            }
        },
        stroke: {
            curve: 'smooth'
        },
        xaxis: {
            categories: categories,
            labels: {
                style: {
                    colors: "#9aa0ac"
                }
            }
        },
        yaxis: {
            title: {
                text: "Doanh thu (VNĐ)"
            },
            labels: {
                style: {
                    color: "#9aa0ac"
                },
                formatter: function(val) {
                    return val.toLocaleString('vi-VN');
                }
            }
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val.toLocaleString('vi-VN') + ' VNĐ';
                }
            }
        },
    };

    // Create new chart
    chart = new ApexCharts(document.querySelector("#chart1"), options);
    chart.render();
}

// Cập nhật hàm fetchData
function fetchData(type) {
    if (type === 'custom') return;
    
    fetch(_WEB_ROOT + `/bao-cao-doanh-thu?type=${type}`)
        .then(res => res.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }
            // Vẽ biểu đồ trước
            renderChart(data.categories, data.revenue);
            
            // Kiểm tra xem có cần update summary không
            const summaryElements = document.querySelectorAll('#totalRevenue, #avgRevenue, #maxRevenue, #growth');
            if (summaryElements.length > 0) {
                updateSummary(data);
            }
        })
        .catch(err => {
            console.error("Lỗi khi fetch dữ liệu:", err);
            // Chỉ alert khi lỗi thực sự ảnh hưởng đến dữ liệu
            if (!err.toString().includes('textContent')) {
                alert("Có lỗi xảy ra khi tải dữ liệu");
            }
        });
}

// Thêm hàm fetch dữ liệu tùy chỉnh
function fetchCustomData(fromDate, toDate) {
    fetch(_WEB_ROOT + `/bao-cao-doanh-thu?type=custom&from=${fromDate}&to=${toDate}`)
        .then(res => res.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }
            renderChart(data.categories, data.revenue);
            
            // Kiểm tra tương tự như trên
            const summaryElements = document.querySelectorAll('#totalRevenue, #avgRevenue, #maxRevenue, #growth');
            if (summaryElements.length > 0) {
                updateSummary(data);
            }
        })
        .catch(err => {
            console.error("Lỗi khi fetch dữ liệu tùy chỉnh:", err);
            if (!err.toString().includes('textContent')) {
                alert("Có lỗi xảy ra khi tải dữ liệu");
            }
        });
}

// Hàm xuất báo cáo
function exportExcel() {
    const type = document.getElementById('type-select').value;
    let url = `${_WEB_ROOT}/bao-cao-doanh-thu/export?type=${type}`;
    
    if (type === 'custom') {
        const fromDate = document.getElementById('fromDate').value;
        const toDate = document.getElementById('toDate').value;
        if (!fromDate || !toDate) {
            alert('Vui lòng chọn khoảng thời gian');
            return;
        }
        url += `&from=${fromDate}&to=${toDate}`;
    }
    
    window.location.href = url;
}

function updateSummary(data) {
    // Kiểm tra elements trước khi thực hiện
    const elements = {
        totalRevenue: document.getElementById('totalRevenue'),
        avgRevenue: document.getElementById('avgRevenue'),
        maxRevenue: document.getElementById('maxRevenue'),
        growth: document.getElementById('growth')
    };

    // Nếu không có elements nào thì return luôn
    if (!Object.values(elements).some(el => el)) {
        return;
    }

    try {
        // Kiểm tra data hợp lệ
        if (!data || !data.revenue || !Array.isArray(data.revenue)) {
            console.error('Data không hợp lệ:', data);
            return;
        }

        // Tính toán các chỉ số
        const totalRevenue = data.revenue.reduce((sum, value) => sum + value, 0);
        const avgRevenue = totalRevenue / data.revenue.length;
        const maxRevenue = Math.max(...data.revenue);
        const growth = data.revenue.length > 1 
            ? ((data.revenue[data.revenue.length - 1] - data.revenue[0]) / data.revenue[0] * 100)
            : 0;

        // Cập nhật UI an toàn
        if (elements.totalRevenue) {
            elements.totalRevenue.textContent = totalRevenue.toLocaleString('vi-VN') + ' VNĐ';
        }
        if (elements.avgRevenue) {
            elements.avgRevenue.textContent = Math.round(avgRevenue).toLocaleString('vi-VN') + ' VNĐ';
        }
        if (elements.maxRevenue) {
            elements.maxRevenue.textContent = maxRevenue.toLocaleString('vi-VN') + ' VNĐ';
        }
        if (elements.growth) {
            elements.growth.textContent = growth.toFixed(2) + '%';
            elements.growth.classList.remove('text-success', 'text-danger');
            elements.growth.classList.add(growth >= 0 ? 'text-success' : 'text-danger');
        }

    } catch (error) {
        console.error('Lỗi khi cập nhật summary:', error);
    }
}



