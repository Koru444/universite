  const ctx = document.getElementById('myChart');

  fetch("./controllers/ApiGraph.php")
  .then((response)=>{
    return response.json();
  })
  .then((data) =>{
    createChart(data,'bar')
  })
function createChart(chartData,type){
  
  new Chart(ctx, {
    type: type,
    data: {
      labels: chartData.map(row => row.date),
      datasets: [{
        label: 'Absences',
          data: chartData.map(row => row.status === 'A' ? 1 : 0), // si "A" = absence
        borderWidth: 1
      },
     {
        label: 'Retards',
          data: chartData.map(row => row.status === 'R' ? 1 : 0), // si "R" = retard
        backgroundColor: 'rgba(54, 162, 235, 0.8)',
        stack: 'Stack 0',
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
}
