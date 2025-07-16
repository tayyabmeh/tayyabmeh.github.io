<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit Profile | Resume Builder</title>
  <link rel="icon" href="image\logo.png" />
  <link rel="stylesheet" href="css\profile.css" />
</head>
<body>

  <nav class="navbar">
    <div class="nav-container">
      <div class="nav-brand">
        <img src="image\logo.png" alt="Logo" height="24" />
        <span>Resume Builder</span>
      </div>
      <div class="nav-actions">
        <a href="profile.php" class="btn dark">👤 My Profile</a>
        <a href="actions/logout_action.php" class="btn danger">🚪 Logout</a>
      </div>
    </div>
  </nav>

  <div class="main-container">
    <div class="form-box">
      <div class="form-header">
        <h2>Edit Profile</h2>
        <a href="myresumes.php" class="link">⬅ Back</a>
      </div>

      <form class="form-grid" method="POST" action="actions\profile_action.php">
        <div class="form-group">
          <label>Full Name</label>
          <input type="text" name="name" required />
        </div>

        <!-- ✅ New Username Field -->
        <div class="form-group">
          <label>Username</label>
          <input type="text"  name="username" required/>
        </div>

        <div class="form-group full-width">
          <label>New Password</label>
          <input type="password" name="password" required />
        </div>

        <div class="form-actions text-end">
          <button type="submit" class="btn primary">💾 Update Profile</button>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
