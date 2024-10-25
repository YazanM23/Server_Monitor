<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Status Cards</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/myCss.css') }}">
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Status Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-bell"></i>
            <span class="badge bg-danger">3</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5 d-flex justify-content-center">
  <div class="row justify-content-center">

    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
      <div class="card text-center p-4 custom-card yellow-hover">
        <div class="icon mb-2">
          <i class="fas fa-microchip"></i>
        </div>
        <h5>CPU</h5>
        <div class="progress-circle-container">
          
          <div class="progress-circle yellow" style="--percentage: {{ intval($informations->cpu_load) }};">
            <span>{{ $informations->cpu_load }}%</span>
          </div>
          
        </div>
      </div>
    </div>


    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
      <div class="card text-center p-4 custom-card red-hover">
        <div class="icon mb-2">
          <i class="fas fa-memory"></i>
        </div>
        <h5>Memory</h5>
        <div class="progress-circle-container">
          <div class="progress-circle red" style="--percentage: {{($informations->memory_usage)}};">
            <span>{{$informations->memory_usage}}%</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Disk Card -->
    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
      <div class="card text-center p-4 custom-card blue-hover">
        <div class="icon mb-2">
          <i class="fas fa-hdd"></i>
        </div>
        <h5>Disk</h5>
        <div class="progress-circle-container">
          <div class="progress-circle blue" style="--percentage:{{$informations->disk_usage}};">
            <span>{{$informations->disk_usage}}%</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<style>
  body {
    background-color: #f8f9fa;
  }
  
  .navbar {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  }
  
  .custom-card {
    border-radius: 20px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
    padding: 50px;
    min-width: 350px;
    background-color: white;
    color: #333;
  }
  
  .custom-card:hover {
    transform: translateY(-10px);
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
  }
  
  /* Hover for blue-themed card */
  .blue-hover:hover {
    background-color: #007bff;
    color: white;
    border: 2px solid #007bff;
  }
  
  .blue-hover:hover .icon i,
  .blue-hover:hover h5 {
    color: white;
  }
  
  .blue-hover:hover .progress-circle {
    --color: white;
  }
  
  .red-hover:hover {
    background-color: #ff6b6b;
    color: white;
    border: 2px solid #ff6b6b;
  }
  
  .red-hover:hover .icon i,
  .red-hover:hover h5 {
    color: white;
  }
  
  .red-hover:hover .progress-circle {
    --color: white;
  }
  
  .yellow-hover:hover {
    background-color: #f1c40f;
    color: white;
    border: 2px solid #f1c40f;
  }
  
  .yellow-hover:hover .icon i,
  .yellow-hover:hover h5 {
    color: white;
  }
  
  .yellow-hover:hover .progress-circle {
    --color: white;
  }
  
  .icon {
    font-size: 50px;
  }
  
  h5 {
    font-weight: 600;
    margin-bottom: 30px;
  }
  
  /* Enhanced Progress Circle */
  .progress-circle-container {
    position: relative;
    width: 180px;
    height: 180px;
    margin: 0 auto;
  }
  
  .progress-circle {
    --circle-size: 160px;
    --circle-thickness: 15px;
    --bg-color: #eaeaea;
  
    width: var(--circle-size);
    height: var(--circle-size);
    border-radius: 50%;
    background: conic-gradient(var(--color) calc(var(--percentage) * 1%), var(--bg-color) 0%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    position: relative;
  }
  
  .progress-circle::before {
    content: "";
    position: absolute;
    width: calc(var(--circle-size) - var(--circle-thickness) * 2);
    height: calc(var(--circle-size) - var(--circle-thickness) * 2);
    background-color: white;
    border-radius: 50%;
  }
  
  .progress-circle span {
    position: relative;
    font-size: 1.8em;
    font-weight: bold;
    color: #333;
  }
  
  /* Color Themes */
  .blue {
    --color: #007bff;
  }
  
  .red {
    --color: #ff6b6b;
  }
  
  .yellow {
    --color: #f1c40f;
  }
  
  .container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
</style>