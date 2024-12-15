<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Mahasiswa</title>
    <style>
    body {
        background: linear-gradient(to bottom, #77E4C8, #36C2CE, #478CCF);
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 20px;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .back-icon img {
        width: 24px;
        height: 24px;
        cursor: pointer;
    }

    .title {
        font-size: 18px;
        font-weight: bold;
    }

    .profile_container {
        text-align: center;
        margin-bottom: 20px;
        position: relative;
    }

    .profile_container p {
        opacity: 0.5;
    }

    .profile_pic {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background-color: #f0f0f0;
        display: inline-block;
        position: relative;
        overflow: hidden;
        margin: 0 auto;
    }

    .profile_pic img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
    }

    .upload_icon {
        position: absolute;
        top: 90px;
        left: calc(720px - 30px);
        transform: translateY(-50%);
        width: 30px;
        height: 30px;
        background-color: purple;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        z-index: 10;
        margin-left: -8px;
    }

    .upload_icon img {
        width: 80%;
        height: 80%;
    }

    .separator {
        border-top: 1px solid #ccc;
        margin: 20px 0;
    }

    .form_container {
        max-width: 400px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
    }

    .form_group {
        display: flex;
        margin-bottom: 15px;
        align-items: center;
    }

    .form_group label {
        flex: 0 0 150px;
        margin-right: 10px;
    }

    .form_group input {
        flex: 1;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .eye-icon {
        width: 24px;
        height: 24px;
        cursor: pointer;
        margin-left: -40px;
        margin-right: 15px;
        z-index: 1;
    }

    .save_button {
        background-color: #333;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 40px;
        margin-left: 115px;
        width: 100%;
        max-width: 180px;
        align-self: center;
    }
    </style>
</head>

<body>

    <div class="header">
        <div class="back-icon" onclick="window.history.back();">
            <img src="<?= base_url('Images/kembali.png') ?>" alt="Back Icon">
        </div>
        <div class="title">Edit Profil Mahasiswa</div>
    </div>

    <div class="profile_container">
        <div class="upload_icon" onclick="document.getElementById('file-input').click();">
            <img src="<?= base_url('Images/Add.png') ?>" alt="Upload Icon">
        </div>

        <div class="profile_pic">
            <img id="profile-image"
                src="<?= isset($data['foto']) ? base_url($data['foto']) : base_url('path/to/default-profile.png') ?>"
                alt="Foto Profil">
        </div>
        <input type="file" id="file-input" style="display: none;" accept="image/*" name="profile_pic"
            onchange="previewImage(event)">
        <h3><?= strtoupper($data['username'] ?? 'Nama Pengguna') ?></h3>
        <p style="opacity: 0.5;"><?= $data['email'] ?? 'Email Pengguna' ?></p>
    </div>

    <div class="separator"></div>

    <div class="form_container">
        <form action="<?= base_url('mahasiswa/updateProfile') ?>" method="POST" enctype="multipart/form-data"
            onsubmit="return validateForm(this)">
            <input type="hidden" name="kode_mahasiswa" value="<?= $data['kd_mahasiswa'] ?? '' ?>">
            <div class="form_group">
                <label for="username">Nama Pengguna</label>
                <input type="text" id="username" name="username" value="<?= $data['username'] ?? '' ?>" placeholder="">
            </div>
            <div class="form_group">
                <label for="password">Kata Sandi Baru</label>
                <input type="password" id="password" name="password" placeholder="">
                <img class="eye-icon" id="eye-icon" src="<?= base_url('Images/close.png') ?>" alt="Eye Icon"
                    onclick="togglePasswordVisibility()">
            </div>
            <div class="form_group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= $data['email'] ?? '' ?>" placeholder="">
            </div>
            <div class="form_group">
                <label for="asal_universitas">Asal Universitas</label>
                <input type="text" id="asal_universitas" name="asal_universitas" value="<?= $data['asal_univ'] ?? '' ?>"
                    placeholder="">
            </div>
            <div class="form_group">
                <label for="nim">NIM</label>
                <input type="text" id="nim" name="nim" value="<?= $data['nim'] ?? '' ?>" placeholder="">
            </div>

            <button class="save_button" type="submit" id="saveButton">Simpan</button>
        </form>
    </div>

    <script>
    // Function to preview the profile image
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('profile-image');
                img.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }

    // Function to toggle password visibility
    function togglePasswordVisibility() {
        const passwordField = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.src = '<?= base_url('Images/open.png') ?>'; // Change to open eye icon
        } else {
            passwordField.type = 'password';
            eyeIcon.src = '<?= base_url('Images/close.png') ?>'; // Change to closed eye icon
        }
    }

    // Function for form validation
    function validateForm(form) {
        const username = form.username.value.trim();
        const email = form.email.value.trim();

        if (username === "") {
            alert("Nama Pengguna tidak boleh kosong!");
            return false;
        }

        if (email === "") {
            alert("Email tidak boleh kosong!");
            return false;
        }

        return true;
    }

    // Function to check if the username already exists using AJAX
    function checkUsername() {
        const username = document.getElementById('username').value.trim();

        if (username === "") {
            return;
        }

        // AJAX request to check if the username already exists
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "<?= base_url('mahasiswa/checkUsername') ?>", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.exists) {
                    document.getElementById('usernameError').style.display = "inline";
                    document.getElementById('saveButton').disabled = true;
                } else {
                    document.getElementById('usernameError').style.display = "none";
                    document.getElementById('saveButton').disabled = false;
                }
            }
        };
        xhr.send("username=" + encodeURIComponent(username));
    }
    </script>
</body>

</html>