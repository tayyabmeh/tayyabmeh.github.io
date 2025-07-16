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

            <form class="form-section" action="actions/creatresume_action.php" method="POST"
                enctype="multipart/form-data">
                <h3>Personal Information</h3>
                <div class="grid">
                    <!-- Personal info fields -->
                    <div class="form-group"><label>Title</label><input placeholder="Save as" type="text" name="title">
                    </div>
                    <div class="form-group"><label>Full Name</label><input type="text" name="name" required /></div>
                    <div class="form-group"><label>Email</label><input type="email" name="email" required /></div>
                    <div class="form-group"><label>Mobile No</label><input type="text" name="phone" required /></div>

                    <div class="form-group"><label>Date of Birth</label><input type="date" name="dob" required /></div>
                    <div class="form-group"><label>Gender</label><select name="gender">
                            <option>Male</option>
                            <option>Female</option>
                            <option>Transgender</option>
                        </select></div>
                    <div class="form-group"><label>Nationality</label><select name="nationality">
                            <option>Pakistani</option>
                            <option>Non Pakistani</option>
                        </select></div>
                    <div class="form-group"><label>Marital Status</label><select name="marital">
                            <option>Married</option>
                            <option>Single</option>
                            <option>Divorced</option>
                        </select></div>
                    <div class="form-group"><label>Hobbies</label><input name="hobbies" type="text" required /></div>
                    <div class="form-group"><label>Languages Known</label><input name="languages" type="text" /></div>
                    <div class="form-group full-width"><label>Address</label><input name="address" type="text"
                            required /></div>
                    <div class="form-group full-width"><label>Objective</label><input name="objective" type="text"
                            required /></div>
                    <div class="form-group"> <label for="photo">Upload Profile Photo:</label>
                        <input type="file" name="photo" id="photo" accept="image/*">
                    </div>
                </div>


                <hr />
               <hr />
<h3>Add More Details</h3>
<p class="text-muted">After saving, you can add your skills, education, and experience to complete your resume.</p>
<p class="text-muted">Update it from dashboard to add followings...</p>
<ul class="list-unstyled">
    <li>✔️ Add professional experience</li>
    <li>✔️ Add academic qualifications</li>
    <li>✔️ Add technical or soft skills</li>
</ul>



                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary">💾 Save Resume</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>