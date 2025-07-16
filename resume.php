<?php
include 'db/db_connection.php';
session_start();

if (!isset($_GET['resumeid'])) {
    die("Resume ID not provided.");
}

$resume_id = $_GET['resumeid'];
$resume = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM resumes WHERE id = '$resume_id'"));

$expResult = mysqli_query($con, "SELECT * FROM experiences WHERE resume_id = '$resume_id'");
$eduResult = mysqli_query($con, "SELECT * FROM educations WHERE resume_id = '$resume_id'");
$skillsResult = mysqli_query($con, "SELECT * FROM skill WHERE resume_id = '$resume_id'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($resume['title'] ?? 'Resume') ?></title>
  <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Pacifico&family=Playfair+Display&family=Dancing+Script&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/resume.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter&family=Lato&family=Poppins:wght@300;600&family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet" />
  <style>
    .profile-photo {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border-radius: 50%;
      border: 2px solid #ccc;
      margin-bottom: 15px;
    }
   
  </style>
  
</head>
<div style="width: 97.5%; padding: 12px 20px; background-color: #222; color: white; text-align: right; position: sticky; top: 0; z-index: 100; display: flex; justify-content: space-between; align-items: center;">
  
  <!-- Left Side: Font Dropdown -->
 <div style="color: white; display: flex; align-items: center; gap: 10px;">
  <label for="font-select">Font:</label>
  <select id="font-select" onchange="changeFont(this.value)" style="padding: 4px 8px; border-radius: 4px;">
    <option value="'Poppins', sans-serif" selected>Poppins</option>
    <option value="'Inter', sans-serif">Inter</option>
    <option value="'Roboto', sans-serif">Roboto</option>
    <option value="'Lato', sans-serif">Lato</option>
    <option value="Georgia, serif">Georgia</option>
    <option value="'Montserrat', sans-serif">Montserrat</option>
    <option value="'Open Sans', sans-serif">Open Sans</option>
    <option value="'Nunito', sans-serif">Nunito</option>
      <option value="'Great Vibes', cursive">Great Vibes (Curvy)</option>
  <option value="'Pacifico', cursive">Pacifico (Handwritten)</option>
  <option value="'Playfair Display', serif">Playfair Display (Elegant)</option>
  <option value="'Dancing Script', cursive">Dancing Script</option>
  </select>

  <label for="font-size-select">Size:</label>
  <select id="font-size-select" onchange="changeFontSize(this.value)" style="padding: 4px 8px; border-radius: 4px;">
    <option value="12px">12px</option>
    <option value="14px">14px</option>
    <option value="16px" selected>16px</option>
    <option value="18px">18px</option>
    <option value="20px">20px</option>
    <option value="22px">22px</option>
    <option value="24px">24px</option>
  </select>
</div>


  <!-- Right Side: Buttons -->
  <div>
    <button onclick="downloadPDF()" style="background-color: white; color: black; padding: 6px 14px; margin-right: 8px; border: none; border-radius: 4px; cursor: pointer;">
  <i class="fa fa-download" style="margin-right: 6px;"></i> Download PDF
</button>

    <button onclick="window.print()" style="background-color: white; color: black; padding: 6px 14px; margin-right: 8px; border: none; border-radius: 4px; cursor: pointer;">
      <i class="fa fa-print" style="margin-right: 6px;"></i> Print
    </button>

    <a href="myresumes.php" style="background-color: #ddd; color: black; padding: 4px 10px; border-radius: 4px; text-decoration: none; font-size: 13px;">
      <i class="fa fa-arrow-left" style="margin-right: 4px;"></i> Back
    </a>
  </div>
</div>



  <div class="resume-container">
    <aside class="sidebar">
      <?php if (!empty($resume['photo']) && file_exists("uploads/" . $resume['photo'])): ?>
        <img src="uploads/<?= htmlspecialchars($resume['photo']) ?>" alt="Profile Photo" class="profile-photo">
      <?php endif; ?>

      <h1><?= htmlspecialchars($resume['name']) ?></h1>
      <p><strong>Phone:</strong> <?= htmlspecialchars($resume['phone']) ?></p>
      <p><strong>Email:</strong> <?= htmlspecialchars($resume['email']) ?></p>
      <p><strong>Address:</strong> <?= htmlspecialchars($resume['address']) ?></p>
      <hr>

      <?php if (mysqli_num_rows($skillsResult) > 0): ?>
        <h3>Skills</h3>
        <ul>
          <?php
          mysqli_data_seek($skillsResult, 0);
          while ($skill = mysqli_fetch_assoc($skillsResult)): ?>
            <li><?= htmlspecialchars($skill['skill']) ?></li>
          <?php endwhile; ?>
        </ul>
      <?php endif; ?>

      <?php if (!empty($resume['languages'])): ?>
        <h3>Languages</h3>
        <p><?= htmlspecialchars($resume['languages']) ?></p>
      <?php endif; ?>

      <?php if (!empty($resume['hobbies'])): ?>
        <h3>Hobbies</h3>
        <p><?= htmlspecialchars($resume['hobbies']) ?></p>
      <?php endif; ?>
    </aside>

    <main class="content">
      <?php if (!empty($resume['objective'])): ?>
        <section>
          <h2>Objective</h2>
          <p><?= htmlspecialchars($resume['objective']) ?></p>
        </section>
      <?php endif; ?>

      <?php if (mysqli_num_rows($expResult) > 0): ?>
        <section>
          <h2>Experience</h2>
          <?php
          mysqli_data_seek($expResult, 0);
          while ($exp = mysqli_fetch_assoc($expResult)): ?>
            <div class="item">
              <h4><?= htmlspecialchars($exp['position']) ?> at <?= htmlspecialchars($exp['company']) ?></h4>
              <span><?= htmlspecialchars($exp['started']) ?> - <?= htmlspecialchars($exp['ended']) ?></span>
              <p><?= htmlspecialchars($exp['description']) ?></p>
            </div>
          <?php endwhile; ?>
        </section>
      <?php endif; ?>

      <?php if (mysqli_num_rows($eduResult) > 0): ?>
        <section>
          <h2>Education</h2>
          <?php
          mysqli_data_seek($eduResult, 0);
          while ($edu = mysqli_fetch_assoc($eduResult)): ?>
            <div class="item">
              <h4><?= htmlspecialchars($edu['course']) ?> — <?= htmlspecialchars($edu['institute']) ?></h4>
              <span>Completed in <?= htmlspecialchars($edu['completed_on']) ?></span>
            </div>
          <?php endwhile; ?>
        </section>
      <?php endif; ?>

      <section>
        <h2>Personal Details</h2>
        <table class="personal-table">
          <tr><td>Date of Birth</td><td><?= date('d F Y', strtotime($resume['dob'])) ?></td></tr>
          <tr><td>Gender</td><td><?= htmlspecialchars($resume['gender']) ?></td></tr>
          <tr><td>Nationality</td><td><?= htmlspecialchars($resume['nationaility']) ?></td></tr>
          <tr><td>Marital Status</td><td><?= htmlspecialchars($resume['marital']) ?></td></tr>
        </table>
      </section>

      <section>
        <h2>Declaration</h2>
        <p>I hereby declare that the above information is correct to the best of my knowledge and can be supported by relevant documents as and when required.</p>
        <p><strong>Date:</strong> <?= date('d-m-Y') ?> &nbsp; &nbsp; <strong>Signature:</strong> <?= htmlspecialchars($resume['name']) ?></p>
      </section>
    </main>
  </div>
 

<script>
  function changeFont(font) {
    document.querySelector('.resume-container').style.fontFamily = font;
  }

  function changeFontSize(size) {
    document.querySelector('.resume-container').style.fontSize = size;
  }

   function downloadPDF() {
    const element = document.querySelector('.resume-container');
    const opt = {
       margin:       [0, 0, 0, 0], // top, right, bottom, left (0 means no margin)
      filename:     'resume.pdf',
      image:        { type: 'jpeg', quality: 0.98 },
      html2canvas:  { scale: 2 },
      jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    };
    html2pdf().from(element).set(opt).save();
  
  }
</script>



<!-- ✅ Add html2pdf library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</body>
</html>



</body>
</html>
