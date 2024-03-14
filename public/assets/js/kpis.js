Chart.defaults.global.defaultFontSize = 10;
Chart.defaults.global.defaultFontColor = "black";
(function () {
    let brrs = $("#chart_patient_of_area");
    let patiens_areas = brrs.data("types");
    let labels = [];
    let data = [];
    let backgroundColors = [];
    for (let area in patiens_areas) {
        labels.push(area);
        data.push(patiens_areas[area]);
        backgroundColors.push(getRandomColor());
    }
    new Chart(brrs, {
        type: "doughnut",
        data: {
            labels: labels,
            datasets: [
                {
                    data: data,
                    backgroundColor: backgroundColors,
                    borderWidth: 3,
                    borderRadius: 4,
                    responsive: true,
                    maxWidth: 12,
                    hoverBorderWidth: 5,
                }
            ]
        }
    });
    //genera colores aleatorios, 
    function getRandomColor() {
        return `rgb(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)})`;
    }
})(jQuery);

