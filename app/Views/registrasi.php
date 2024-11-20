<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>

    <!-- Link to Poppins font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background-image: url('/background.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        background-color: rgba(74, 73, 73, 0.85);
        width: 400px;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        position: relative;
    }

    img {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 150px;
    }

    h2 {
        color: white;
        font-size: 18px;
        text-align: left;
        margin-bottom: 10px;
        font-weight: 600;
    }

    label {
        color: white;
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
    }

    select,
    input[type="text"],
    input[type="password"],
    input[type="email"],
    input[type="nim"],
    input[type="domisili"],
    input[type="ktp"],
    input[type="asal_univ"] {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border: none;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
    }

    .file-upload {
        display: flex;
        justify-content: flex-start;
        /* Aligns children to the left */
        align-items: center;
        /* Centers vertically */
        width: 100%;
        border-radius: 5px;
        background-color: #f8f9fa;
        padding: 10px;
        box-sizing: border-box;
        margin-bottom: 15px;
    }

    .select-file-btn {
        display: inline-block;
        background-color: #ffffff;
        color: #007bff;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 12px;
        text-decoration: none;
        border: 1px solid #007bff;
        margin-left: 10px;
        margin-top: 5px;
    }

    #ktp-upload,
    #license-upload,
    #ktm-upload,
    #file-upload {
        display: none;
        /* Hide the file input */
    }

    .file-name {
        color: #4A4949;
        margin-left: 10px;
        /* Space between the button and file name */
    }

    .btn-submit {
        background-color: #4A4949;
        border: none;
        color: white;
        padding: 12px 0;
        font-size: 18px;
        border-radius: 12px;
        width: 100%;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        margin-top: 20px;
    }

    .btn-submit:hover {
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.4);
        transform: translateY(-4px);
    }

    .btn-submit:active {
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
        transform: translateY(2px);
    }

    .error-message {
        color: red;
        font-size: 12px;
        margin-bottom: 12px;
        display: none;
        text-align: left;
    }

    .error {
        border: 1px solid red;
    }
    </style>
</head>

<body>
    <div class="container">
        <img src="<?= base_url('images/Logo Bercerita.com.png') ?>" alt="Logo">
        <h2>MASUK SEBAGAI</h2>
        <form id="registerForm" action="/prosesRegistrasi" method="post" enctype="multipart/form-data">
            <label for="category">Kategori</label>
            <select id="category" name="category" onchange="loadAdditionalInputs()">
                <option value="">Pilih Kategori</option>
                <option value="klien">Klien</option>
                <option value="mhs">Mahasiswa Psikologi</option>
                <option value="psikolog">Psikolog</option>
            </select>
            <div id="categoryError" class="error-message">Kategori harus dipilih.</div>

            <label for="username">Nama pengguna</label>
            <input type="text" id="username" name="username" placeholder="Nama pengguna" required>
            <div id="usernameError" class="error-message">Nama pengguna harus diisi.</div>

            <label for="password">Kata sandi</label>
            <input type="password" id="password" name="password" placeholder="Kata sandi" required>
            <div id="passwordError" class="error-message">Kata sandi harus diisi.</div>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <div id="emailError" class="error-message">Email harus diisi.</div>

            <!-- Tempat untuk menambahkan input tambahan berdasarkan kategori -->
            <div id="additionalInputs"></div>

            <label for="fotodiri">Mengunggah Foto</label>
            <div class="file-upload">
                <input type="file" id="file-upload" name="file-upload" accept="image/*,application/pdf" required
                    onchange="showUploadStatus()">
                <label for="file-upload" class="select-file-btn">SELECT FILE</label>
                <span id="file-name" class="file-name">Tidak ada file terpilih</span> <!-- File name display -->
            </div>
            <div id="fileError" class="error-message">Mengunggah file diperlukan.</div>

            <?php if (session()->getFlashdata('error')): ?>
            <div id="globalError" class="alert alert-danger" style="color: red; margin-top: 20px; text-align: center;">
                <?= session()->getFlashdata('error') ?>
            </div>
            <?php endif; ?>


            <button type="button" class="btn-submit" onclick="submitForm()">DAFTAR</button>
        </form>
    </div>

    <script>
    // Function to show error messages
    function showError(elementId, message) {
        const errorElement = document.getElementById(elementId);
        errorElement.innerText = message;
        errorElement.style.display = 'block';
    }

    // Function to hide error messages
    function hideError(elementId) {
        const errorElement = document.getElementById(elementId);
        errorElement.style.display = 'none';
    }

    // Real-time validation for username
    document.getElementById('username').addEventListener('input', function() {
        if (this.value.trim() === '') {
            showError('usernameError', 'Nama pengguna harus diisi.');
            this.classList.add('error');
        } else {
            hideError('usernameError');
            this.classList.remove('error');
        }
    });

    // Real-time validation for password
    document.getElementById('password').addEventListener('input', function() {
        if (this.value.trim() === '') {
            showError('passwordError', 'Kata sandi harus diisi.');
            this.classList.add('error');
        } else {
            hideError('passwordError');
            this.classList.remove('error');
        }
    });

    // Real-time validation for email
    document.getElementById('email').addEventListener('input', function() {
        if (this.value.trim() === '') {
            showError('emailError', 'Email harus diisi.');
            this.classList.add('error');
        } else {
            hideError('emailError');
            this.classList.remove('error');
        }
    });

    // Real-time validation for category
    document.getElementById('category').addEventListener('change', function() {
        if (this.value.trim() === '') {
            showError('categoryError', 'Kategori harus dipilih.');
            this.classList.add('error');
        } else {
            hideError('categoryError');
            this.classList.remove('error');
        }
    });

    // Real-time validation for file upload
    document.getElementById('file-upload').addEventListener('change', function() {
        if (this.files.length === 0) {
            showError('fileError', 'Mengunggah file diperlukan.');
            this.classList.add('error');
        } else {
            hideError('fileError');
            this.classList.remove('error');
            document.getElementById('file-name').innerText = this.files[0].name;
        }
    });
    

    // Function to submit form
    function submitForm() {
        // Menyembunyikan semua pesan error terlebih dahulu
        const errorMessages = document.querySelectorAll('.error-message');
        errorMessages.forEach(message => {
            message.style.display = 'none';
        });

        // Validasi form secara manual
        const username = document.getElementById('username');
        const password = document.getElementById('password');
        const email = document.getElementById('email');
        const category = document.getElementById('category');
        const fileUpload = document.getElementById('file-upload');
        let isValid = true;

        // Validate username
        if (username.value.trim() === '') {
            showError('usernameError', 'Nama pengguna harus diisi.');
            username.classList.add('error');
            isValid = false;
        }

        // Validate password
        if (password.value.trim() === '') {
            showError('passwordError', 'Kata sandi harus diisi.');
            password.classList.add('error');
            isValid = false;
        }

        // Validate email
        if (email.value.trim() === '') {
            showError('emailError', 'Email harus diisi.');
            email.classList.add('error');
            isValid = false;
        }

        // Validate category
        if (category.value.trim() === '') {
            showError('categoryError', 'Kategori harus dipilih.');
            category.classList.add('error');
            isValid = false;
        }

        // Validate file upload
        if (fileUpload.files.length === 0) {
            showError('fileError', 'Mengunggah file diperlukan.');
            fileUpload.classList.add('error');
            isValid = false;
        }

        // If form is valid, alert the user
        // Jika form valid, lanjutkan untuk mengecek username di database
        if (isValid) {
            // Pengecekan username di server
            checkUsernameAvailability(username.value.trim(), function(isUsernameTaken) {
                if (isUsernameTaken) {
                    showError('usernameError', 'Username ini sudah terpakai.');
                    username.classList.add('error');
                } else {
                    // Jika username belum terpakai, kirim form
                    alert("Form berhasil diajukan!");
                    document.getElementById('registerForm').submit(); // Submit form
                }
            });
        }
    }

    function loadAdditionalInputs() {
        const category = document.getElementById('category').value;
        const additionalInputs = document.getElementById('additionalInputs');
        const submitButton = document.querySelector('.btn-submit');

        if (category === "mhs") {
            additionalInputs.innerHTML = `
                    <label for="nim">NIM</label>
                    <input type="nim" id="nim" name="nim" placeholder="Nomor Induk Mahasiswa" required>

                    <label for="asal_univ">Asal Universitas</label>
                    <input type="asal_univ" id="asal_univ" name="asal_univ" placeholder="Asal Universitas" required>

                    <label for="fotoKTM">Mengunggah KTM</label>
                    <div class="file-upload">
                        <input type="ktm" id="ktm-upload" name="fotoKTM" accept="image/*,application/pdf" required onchange="showKTMFileName()">
                        <label for="ktm-upload" class="select-file-btn">SELECT FILE</label>
                        <span id="ktm-file-name" class="file-name">Tidak ada file terpilih</span>
                    </div>
                `;
            submitButton.disabled = false; // Enable the submit button
        } else if (category === "psikolog") {
            additionalInputs.innerHTML = `
                    <label for="domisili">Domisili</label>
                    <input type="domisili" id="domisili" name="domisili" placeholder="Domisili" required>

                    <label for="ktp-upload">Mengunggah Foto KTP</label>
                    <div class="file-upload">
                        <input type="ktp" id="ktp-upload" name="ktp" accept="image/*,application/pdf" required onchange="showKTPFileName()">
                        <label for="ktp-upload" class="select-file-btn">SELECT FILE</label>
                        <span id="ktp-file-name" class="file-name">Tidak ada file terpilih</span>
                    </div>

                    <label for="license-upload">Mengunggah Foto Lisensi</label>
                    <div class="file-upload">
                        <input type="license" id="license-upload" name="license" accept="image/*,application/pdf" required onchange="showLicenseFileName()">
                        <label for="license-upload" class="select-file-btn">SELECT FILE</label>
                        <span id="license-file-name" class="file-name">Tidak ada file terpilih</span>
                    </div>
                `;
            submitButton.disabled = false; // Enable the submit button
        } else if (category === "klien") {
            additionalInputs.innerHTML = ''; // No additional inputs for "Klien"
            submitButton.disabled = false; // Enable the submit button
        } else {
            additionalInputs.innerHTML = ''; // Clear if category is not valid
            submitButton.disabled = true; // Disable the submit button
        }
    }

    // Event listener to trigger the form validation as soon as the category changes
    document.getElementById('category').addEventListener('change', function() {
        loadAdditionalInputs();
        validateForm(); // Revalidate the form after category selection
    });

    // File upload handlers to update file names when the user selects a file
    function showUploadStatus() {
        const fileInput = document.getElementById('file-upload');
        const fileNameDisplay = document.getElementById('file-name');

        if (fileInput.files.length > 0) {
            fileNameDisplay.textContent = fileInput.files[0].name;
        } else {
            fileNameDisplay.textContent = 'Tidak ada file terpilih';
        }
    }

    function showKTMFileName() {
        const ktmInput = document.getElementById('ktm-upload');
        const ktmFileNameDisplay = document.getElementById('ktm-file-name');

        if (ktmInput.files.length > 0) {
            ktmFileNameDisplay.textContent = ktmInput.files[0].name;
        } else {
            ktmFileNameDisplay.textContent = 'Tidak ada file terpilih';
        }
    }

    function showKTPFileName() {
        const ktpInput = document.getElementById('ktp-upload');
        const ktpFileNameDisplay = document.getElementById('ktp-file-name');

        if (ktpInput.files.length > 0) {
            ktpFileNameDisplay.textContent = ktpInput.files[0].name;
        } else {
            ktpFileNameDisplay.textContent = 'Tidak ada file terpilih';
        }
    }

    function showLicenseFileName() {
        const licenseInput = document.getElementById('license-upload');
        const licenseFileNameDisplay = document.getElementById('license-file-name');

        if (licenseInput.files.length > 0) {
            licenseFileNameDisplay.textContent = licenseInput.files[0].name;
        } else {
            licenseFileNameDisplay.textContent = 'Tidak ada file terpilih';
        }
    }

    // Disable the submit button when the form is submitted
    document.getElementById('registerForm').addEventListener('submit', function() {
        const submitButton = document.querySelector('.btn-submit');
        submitButton.disabled = true;
    });

    
    </script>

</body>

</html>