<?php
include './db/db_connection.php';
session_start();

$resumeData = null;
$experienceData = [];
$educationData = [];
$skillsData = [];

if (isset($_GET['resumeid'])) {
  $resumeId = $_GET['resumeid'];
  $userId = $_SESSION['user_id'];

  // Fetch main resume
  $query = "SELECT * FROM resumes WHERE id = '$resumeId' AND user_id = '$userId' LIMIT 1";
  $result = mysqli_query($con, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $resumeData = mysqli_fetch_assoc($result);

    // Fetch experience
    $queryExp = "SELECT * FROM experiences WHERE resume_id = '$resumeId'";
    $resultExp = mysqli_query($con, $queryExp);
    if ($resultExp && mysqli_num_rows($resultExp) > 0) {
      while ($row = mysqli_fetch_assoc($resultExp)) {
        $experienceData[] = $row;
      }
    }

    // Fetch education
    $queryEdu = "SELECT * FROM educations WHERE resume_id = '$resumeId'";
    $resultEdu = mysqli_query($con, $queryEdu);
    if ($resultEdu && mysqli_num_rows($resultEdu) > 0) {
      while ($row = mysqli_fetch_assoc($resultEdu)) {
        $educationData[] = $row;
      }
    }

    // Fetch skills
    $querySkills = "SELECT * FROM skill WHERE resume_id = '$resumeId'";
    $resultSkills = mysqli_query($con, $querySkills);
    if ($resultSkills && mysqli_num_rows($resultSkills) > 0) {
      while ($row = mysqli_fetch_assoc($resultSkills)) {
        $skillsData[] = $row;
      }
    }

  } else {
    // Resume not found or doesn't belong to user
    header("Location: myresumes.php");
    exit();
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Resume Builder</title>
  <link rel="icon" href="image/logo.png" />
  <link rel="stylesheet" href="css/creatorresume.css" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar">
    <div class="nav-container d-flex justify-content-between align-items-center w-100">
      <div class="nav-brand">
        <img src="image/logo.png" alt="" height="24" />
        <span>Resume Builder</span>
      </div>
      <div class="nav-actions">
        <a href="profile.php" class="btn dark">My Profile</a>
        <a href="actions/logout_action.php" class="btn danger">Logout</a>
      </div>
    </div>
  </nav>


  <div class="main-container">
    <div class="resume-box">
      <div class="section-header">
        <h2>Create Resume</h2>
        <a href="myresumes.php" class="link">← Back</a>
      </div>

     <form class="form-section" action="actions/updateresume_action.php" method="POST"  enctype="multipart/form-data">
        <h3>Personal Information</h3>
        <div class="grid">
          <!-- Personal info fields -->
          <input type="hidden" name="resume_id" value="<?= $resumeData['id'] ?? '' ?>">
          <div class="form-group"><label>Title</label><input placeholder="Save as" type="text" name="title"
              value="<?= $resumeData['title'] ?? '' ?>" required /></div>
          <div class="form-group"><label>Full Name</label><input type="text" name="name"
              value="<?= $resumeData['name'] ?? '' ?>" required /></div>
          <div class="form-group"><label>Email</label><input type="email" name="email" required
              value="<?= $resumeData['email'] ?? '' ?>" /></div>
          <div class="form-group"><label>Mobile No</label><input type="number" name="phone" required
              value="<?= $resumeData['phone'] ?? '' ?>" /></div>
          <div class="form-group"><label>Date of Birth</label><input type="date" name="dob"
              value="<?= isset($resumeData['dob']) ? date('Y-m-d', strtotime($resumeData['dob'])) : '' ?>" required />
          </div>
          <div class="form-group">
            <label>Gender</label>
            <select name="gender">
              <option <?= ($resumeData['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
              <option <?= ($resumeData['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
              <option <?= ($resumeData['gender'] == 'Transgender') ? 'selected' : '' ?>>Transgender</option>
            </select>
          </div>

          <div class="form-group"><label>Nationality</label>
            <select name="nationality">
              <option <?= ($resumeData['nationaility'] == 'Pakistani') ? 'selected' : '' ?>>Pakistani</option>
              <option <?= ($resumeData['nationaility'] == 'Non Pakistani') ? 'selected' : '' ?>>Non Pakistani</option>
            </select>
          </div>
          <div class="form-group"><label>Marital Status</label>
            <select name="marital">
              <option <?= ($resumeData['marital'] == 'Married') ? 'selected' : '' ?>>Married</option>
              <option <?= ($resumeData['marital'] == 'Single') ? 'selected' : '' ?>>Single</option>
              <option <?= ($resumeData['marital'] == 'Divorced') ? 'selected' : '' ?>>Divorced</option>
            </select>
          </div>
          <div class="form-group"><label>Hobbies</label><input name="hobbies" type="text" required
              value="<?= $resumeData['hobbies'] ?? '' ?>" /></div>
          <div class="form-group"><label>Languages Known</label><input name="languages" type="text"
              value="<?= $resumeData['languages'] ?? '' ?>" /></div>
          <div class="form-group full-width"><label>Address</label><input name="address" type="text" required
              value="<?= $resumeData['address'] ?? '' ?>" /></div>
          <div class="form-group full-width"><label>Objective</label><input name="objective" type="text" required
              value="<?= $resumeData['objective'] ?? '' ?>" /></div>
        </div>
        <!-- Profile Photo Upload and Preview -->
<div class="form-group">
  <label>Profile Photo</label>

  <!-- Show current photo if exists -->
  <?php if (!empty($resumeData['photo'])): ?>
    <div style="margin-bottom: 10px;">
      <img src="uploads/<?= htmlspecialchars($resumeData['photo']) ?>" 
           alt="Profile Photo" 
           style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px; border: 1px solid #ccc;">
    </div>

    <!-- Delete Photo Link -->
    <a href="actions/deletephoto_action.php?resumeid=<?= $resumeData['id'] ?>" 
       onclick="return confirm('Are you sure you want to delete this photo?')" 
       class="btn btn-sm btn-danger mb-2">
       ❌ Delete Photo
    </a>
  <?php endif; ?>

  <!-- Upload input (always shown for updating) -->
  <input type="file" name="photo" class="form-control" accept="image/*">
</div>




        <hr />

        <!-- Experience Section -->
        <div class="d-flex justify-content-between align-items-center">
          <h3>Experience</h3>
          <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal"
            data-target="#experienceModal">
            ➕ Add New
          </button>
        </div>
        <?php if (!empty($experienceData)): ?>
          <?php foreach ($experienceData as $exp): ?>
            <div class="entry-box">
              <div class="d-flex justify-content-between">
                <h4><?= htmlspecialchars($exp['position']) ?></h4>
                <a href="actions/deleteexperience_action.php?id=<?= $exp['id'] ?>&resumeid=<?= $resumeId ?>"
                  class="text-danger small" onclick="return confirm('Delete this experience?')">
                  <i class="bi bi-trash"></i> Delete
                </a>
              </div>
              <p><strong><?= htmlspecialchars($exp['company']) ?></strong> (<?= htmlspecialchars($exp['started']) ?> -
                <?= htmlspecialchars($exp['ended']) ?>)
              </p>
              <p><?= htmlspecialchars($exp['description']) ?></p>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="entry-box">
            <p>No experience added yet.</p>
          </div>
        <?php endif; ?>


        <hr />

        <!-- Education Section -->
        <div class="d-flex justify-content-between align-items-center">
          <h3>Education</h3>
          <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal"
            data-target="#educationModal">
            ➕ Add New
          </button>
        </div>
        <?php if (!empty($educationData)): ?>
          <?php foreach ($educationData as $edu): ?>
            <div class="entry-box">
              <div class="d-flex justify-content-between">
                <h4><?= htmlspecialchars($edu['course']) ?></h4>
                <a href="actions/deleteeducation_action.php?id=<?= $edu['id'] ?>&resumeid=<?= $resumeId ?>"
                  class="text-danger small" onclick="return confirm('Delete this education record?')">
                  <i class="bi bi-trash"></i> Delete
                </a>
              </div>
              <p><?= htmlspecialchars($edu['institute']) ?></p>
              <p>Passed in <?= htmlspecialchars($edu['completed_on']) ?></p>
            </div>

          <?php endforeach; ?>
        <?php else: ?>
          <div class="entry-box">
            <p>No education added yet.</p>
          </div>
        <?php endif; ?>

        <hr />

        <!-- Skills Section -->
        <div class="d-flex justify-content-between align-items-center">
          <h3>Skills</h3>
          <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#skillsModal">
            ➕ Add New
          </button>
        </div>
        <?php if (!empty($skillsData)): ?>
          <div class="entry-box">
            <?php foreach ($skillsData as $skill): ?>
              <div class="d-flex justify-content-between">
                <p class="mb-1">✔ <?= htmlspecialchars($skill['skill']) ?></p>
                <a href="actions/deleteskill_action.php?id=<?= $skill['id'] ?>&resumeid=<?= $resumeId ?>"
                  class="text-danger small" onclick="return confirm('Remove this skill?')">
                  <i class="bi bi-trash"></i> Delete
                </a>
              </div>

            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <div class="entry-box">
            <p>No skills added yet.</p>
          </div>
        <?php endif; ?>


        <div class="text-end mt-3">
          <button type="submit" class="btn btn-primary">💾 Update Resume</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Experience Modal -->
  <div class="modal fade" id="experienceModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <form class="modal-content" method="POST" action="actions/addexperience_action.php">
        <div class="modal-header">
          <h5>Add Experience</h5>
        </div>
        <div class="modal-body">
          <input type="hidden" name="resume_id" value="<?= $_GET['resumeid'] ?? '' ?>">
          <label>Position/Job Role</label>
          <input name="position" type="text" class="form-control mb-2" required>

          <label>Company</label>
          <input name="company" type="text" class="form-control mb-2" required>

          <label>Description</label>
          <textarea name="description" class="form-control mb-2" required></textarea>

          <label>Joined</label>
          <input name="started" type="text" class="form-control mb-2" required>

          <label>Resigned</label>
          <input name="ended" type="text" class="form-control mb-2" required>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Education Modal -->
  <div class="modal fade" id="educationModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <form class="modal-content" method="POST" action="actions/addeducation_action.php">
        <div class="modal-header">
          <h5>Add Education</h5>
        </div>
        <div class="modal-body">
          <input type="hidden" name="resume_id" value="<?= $_GET['resumeid'] ?? '' ?>">
          <label>Degree / Class</label>
          <input name="course" type="text" class="form-control mb-2" required>

          <label>Institute</label>
          <input name="institute" type="text" class="form-control mb-2" required>

          <label>Year of Completion</label>
          <input name="completed_on" type="text" class="form-control mb-2" required>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Skills Modal -->
  <div class="modal fade" id="skillsModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <form class="modal-content" method="POST" action="actions/addskill_action.php">
        <div class="modal-header">
          <h5>Add Skill</h5>
        </div>
        <div class="modal-body">
          <input type="hidden" name="resume_id" value="<?= $_GET['resumeid'] ?? '' ?>">
          <label>Skill</label>
          <input name="skill" type="text" class="form-control mb-2" required>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>


  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>