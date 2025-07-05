<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GASC Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; }
        .container { display: flex; height: 100vh; }
        .sidebar { width: 20%; background-color: #2aafa2; padding: 20px; color: white; overflow-y: auto; }
        .sidebar h1 { font-size: 20px; margin-bottom: 20px; }
        .sidebar button { width: 100%; padding: 10px; margin: 5px 0; background-color: #444; color: white; border: none; border-radius: 5px; cursor: pointer; display: flex; align-items: center; }
        .sidebar button i { margin-right: 10px; }
        .sidebar button:hover { background-color: #555; }
        .content { flex-grow: 1; background-color: #fff; padding: 20px; overflow-y: auto; }
        .section { display: none; }
        .section.active { display: block; }
    </style>
    <script>
        function loadSection(sectionId) {
            document.querySelectorAll('.section').forEach(section => section.classList.remove('active'));
            const activeSection = document.getElementById(sectionId);
            activeSection.classList.add('active');
            fetch(sectionId + '.php')
                .then(response => response.text())
                .then(data => { activeSection.innerHTML = data; })
                .catch(error => { activeSection.innerHTML = `<p>Error loading content: ${error.message}</p>`; });
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h1>Admin Site</h1>
            <h3>Anti-Ragging Committee</h3>
            <button onclick="loadSection('antistudentview')"><i class="fas fa-user-graduate"></i> Student Records</button>
            <button onclick="loadSection('antistaffview')"><i class="fas fa-user-tie"></i> Staff Records</button>
            
            <h3>Blood Donors Club</h3>
            <button onclick="loadSection('bdcstudentview')"><i class="fas fa-user-graduate"></i> Student Records</button>
            <button onclick="loadSection('bdcstaffview')"><i class="fas fa-user-tie"></i> Staff Records</button>
            
            <h3>Clean Bridge</h3>
            <button onclick="loadSection('cbstudentview')"><i class="fas fa-user-graduate"></i> Student Records</button>
            <button onclick="loadSection('cbstaffview')"><i class="fas fa-user-tie"></i> Staff Records</button>
            
            <h3>Citizen Consumer Club</h3>
            <button onclick="loadSection('cccstudentview')"><i class="fas fa-user-graduate"></i> Student Records</button>
            <button onclick="loadSection('cccstaffview')"><i class="fas fa-user-tie"></i> Staff Records</button>
            
            <h3>Environment & Gardening Club</h3>
            <button onclick="loadSection('egcstudentview')"><i class="fas fa-user-graduate"></i> Student Records</button>
            <button onclick="loadSection('egcstaffview')"><i class="fas fa-user-tie"></i> Staff Records</button>

	      <h3>Gender Champions Club </h3>
            <button onclick="loadSection('gccstudentview')"><i class="fas fa-user-graduate"></i> Student Records</button>
            <button onclick="loadSection('gccstaffview')"><i class="fas fa-user-tie"></i> Staff Records</button>
            
            <h3>National Cadet Corps (NCC)</h3>
            <button onclick="loadSection('nccstudentview')"><i class="fas fa-user-graduate"></i> Student Records</button>
            <button onclick="loadSection('nccstaffview')"><i class="fas fa-user-tie"></i> Staff Records</button>
            
            <h3>National Social Service (NSS)</h3>
            <button onclick="loadSection('nssstudentview')"><i class="fas fa-user-graduate"></i> Student Records</button>
            <button onclick="loadSection('nssstaffview')"><i class="fas fa-user-tie"></i> Staff Records</button>
            
            <h3>Physical Education</h3>
            <button onclick="loadSection('pestudentview')"><i class="fas fa-user-graduate"></i> Student Records</button>
            <button onclick="loadSection('pestaffview')"><i class="fas fa-user-tie"></i> Staff Records</button>

	      <h3>Rovers & Rangers</h3>
            <button onclick="loadSection('rrstudentview')"><i class="fas fa-user-graduate"></i> Student Records</button>
            <button onclick="loadSection('rrcstaffview')"><i class="fas fa-user-tie"></i> Staff Records</button>

		      <h3>Student Service League</h3>
            <button onclick="loadSection('sslstudentview')"><i class="fas fa-user-graduate"></i> Student Records</button>
            <button onclick="loadSection('sslstaffview')"><i class="fas fa-user-tie"></i> Staff Records</button>
            
            <h3>Youth Red Cross</h3>
            <button onclick="loadSection('yrcstudentview')"><i class="fas fa-user-graduate"></i> Student Records</button>
            <button onclick="loadSection('yrcstaffview')"><i class="fas fa-user-tie"></i> Staff Records</button>
        </div>

        <div class="content">
            <div id="dashboard" class="section active">
                <h2>Welcome to the GASC Admin!!!!!</h2>
                <p>Select a category from the sidebar.</p>
            </div>
            <div id="antistudentview" class="section"><h2>Anti-Ragging Student Records</h2></div>
            <div id="antistaffview" class="section"><h2>Anti-Ragging Staff Records</h2></div>
            <div id="bdcstudentview" class="section"><h2>Blood Donors Club Student Records</h2></div>
            <div id="bdcstaffview" class="section"><h2>Blood Donors Club Staff Records</h2></div>
            <div id="cbstudentview" class="section"><h2>Clean Bridge Student Records</h2></div>
            <div id="cbstaffview" class="section"><h2>Clean Bridge Staff Records</h2></div>
            <div id="cccstudentview" class="section"><h2>Citizen Consumer Club Student Records</h2></div>
            <div id="cccstaffview" class="section"><h2>Citizen Consumer Club Staff Records</h2></div>
            <div id="egcstudentview" class="section"><h2>Environment & Gardening Club Student Records</h2></div>
            <div id="egcstaffview" class="section"><h2>Environment & Gardening Club Staff Records</h2></div>
		<div id="gccstudentview" class="section"><h2>Gender Champions Club Student Records</h2></div>
            <div id="gccstaffview" class="section"><h2>Gender Champions Club Staff Records</h2></div>
            <div id="nccstudentview" class="section"><h2>NCC Student Records</h2></div>
            <div id="nccstaffview" class="section"><h2>NCC Staff Records</h2></div>
		 <div id="nssstudentview" class="section"><h2>NSS Student Records</h2></div>
            <div id="nssstaffview" class="section"><h2>NSS Staff Records</h2></div>
		 <div id="pestudentview" class="section"><h2>PHY Student Records</h2></div>
            <div id="pestaffview" class="section"><h2>PHY Staff Records</h2></div>
		 <div id="rrstudentview" class="section"><h2>RR Student Records</h2></div>
            <div id="rrstaffview" class="section"><h2>RR Staff Records</h2></div>
		 <div id="sslstudentview" class="section"><h2>SSL Student Records</h2></div>
            <div id="sslstaffview" class="section"><h2>SSL Staff Records</h2></div>
		 <div id="yrcstudentview" class="section"><h2>YRC Student Records</h2></div>
            <div id="yrcstaffview" class="section"><h2>YRC Staff Records</h2></div>
        </div>
    </div>
<center><h1><a href="wall.html">BACK</a></h1></center>
</body>
</html>

