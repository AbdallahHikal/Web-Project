<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional CV Manager</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="../css/my cv 2.css">
    <style>
        .file-input {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="header-content">
                <div class="logo">
                    <i class="fas fa-file-alt"></i>
                    <span>CV Manager</span>
                </div>
            </div>
        </header>

        <div class="main-content">
            <div class="sidebar">
                <h3 class="sidebar-title">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>Upload CV</span>
                </h3>

                <form id="uploadForm">
                    <input type="file" id="cvFile" class="file-input" accept=".pdf,.doc,.docx">
                    <div class="upload-card" id="uploadArea">
                        <div class="upload-icon">
                            <i class="fas fa-file-import"></i>
                        </div>
                        <p class="upload-text">Upload Your CV</p>
                        <p class="upload-subtext">PDF or Word documents</p>
                    </div>

                    <div id="fileInfo" style="display: none; margin-bottom: 20px;">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                            <i class="fas fa-check-circle"></i>
                            <span id="fileName"></span>
                        </div>
                        <button type="submit" class="btn">
                            <i class="fas fa-upload"></i> Upload Now
                        </button>
                    </div>
                </form>

                <div style="margin-top: 30px;">
                    <div style="display: flex; flex-direction: column; gap: 15px;">
                        <div style="display: flex; justify-content: space-between;">
                            <span>Last Upload</span>
                            <span id="lastUpload">Today</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cv-list-container">
                <div class="cv-list" id="cvList">
                    <div class="no-cv" id="noCvMessage" style="display: none;">
                        <i class="fas fa-folder-open"></i>
                        <p>You haven't uploaded any CVs yet</p>
                    </div>
                </div>
            </div>
        </div>

        <center>
            <a href="main menu employee.php" class="cta-button">Cancel</a>
        </center>
    </div>
</body>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const uploadForm = document.getElementById('uploadForm');
    const cvFileInput = document.getElementById('cvFile');
    const uploadArea = document.getElementById('uploadArea');
    const fileInfo = document.getElementById('fileInfo');
    const fileName = document.getElementById('fileName');
    const cvList = document.getElementById('cvList');
    const noCvMessage = document.getElementById('noCvMessage');
    let cvs = [];

    function init() {
        loadCVs();
        setupEventListeners();
    }

    function loadCVs() {
        const savedCVs = localStorage.getItem('cvs');
        if (savedCVs) {
            cvs = JSON.parse(savedCVs);
            renderCVList();
        }
    }

    function saveCVs() {
        localStorage.setItem('cvs', JSON.stringify(cvs));
    }

    function setupEventListeners() {
        cvFileInput.addEventListener('change', handleFileSelect);
        uploadForm.addEventListener('submit', handleUpload);
        uploadArea.addEventListener('click', function (e) {
            e.preventDefault();
            cvFileInput.click();
        });
    }

    function handleFileSelect(e) {
        const file = e.target.files[0];
        if (file) {
            fileName.textContent = file.name;
            fileInfo.style.display = 'block';
            uploadArea.style.display = 'none';
        }
    }

    function handleUpload(e) {
        e.preventDefault();
        const file = cvFileInput.files[0];

        if (!file) {
            alert('Please choose the file first !');
            return;
        }

        const newCV = {
            id: Date.now(),
            name: file.name,
            size: (file.size / (1024 * 1024)).toFixed(1) + ' MB',
            type: file.type.includes('pdf') ? 'pdf' : 'word',
            file: file,
            uploadDate: new Date().toLocaleDateString()
        };

        cvs.unshift(newCV);
        saveCVs();
        renderCVList();

        uploadForm.reset();
        fileInfo.style.display = 'none';
        uploadArea.style.display = 'flex';
    }

    function renderCVList() {
        cvList.innerHTML = '';

        if (cvs.length === 0) {
            noCvMessage.style.display = 'flex';
            return;
        }

        noCvMessage.style.display = 'none';

        cvs.forEach(cv => {
            const cvItem = document.createElement('div');
            cvItem.className = 'cv-item';
            cvItem.dataset.id = cv.id;

            cvItem.innerHTML = `
                <div class="cv-header">
                    <div class="cv-icon">
                        <i class="fas ${cv.type === 'pdf' ? 'fa-file-pdf' : 'fa-file-word'}"></i>
                    </div>
                    <div>
                        <h3 class="cv-name">${cv.name}</h3>
                        <p class="cv-meta">Success Upload : ${cv.uploadDate} • ${cv.size}</p>
                    </div>
                </div>
                <div class="cv-actions">
                    <button class="btn btn-view">
                        <i class="fas fa-eye"></i> View
                    </button>
                    <button class="btn btn-delete">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>
                </div>
            `;

            cvList.appendChild(cvItem);
        });

        document.querySelectorAll('.btn-view').forEach(btn => {
            btn.addEventListener('click', viewCV);
        });

        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', deleteCV);
        });
    }

    function viewCV(e) {
        const cvId = parseInt(e.target.closest('.cv-item').dataset.id);
        const cv = cvs.find(c => c.id === cvId);

        if (cv.file instanceof File) {
            const fileUrl = URL.createObjectURL(cv.file);
            window.open(fileUrl, '_blank');
        } else {
            alert('error view file');
        }
    }

    function deleteCV(e) {
        if (!confirm('Are You Sure To Delete This CV')) return;

        const cvId = parseInt(e.target.closest('.cv-item').dataset.id);
        cvs = cvs.filter(c => c.id !== cvId);

        saveCVs();
        renderCVList();
    }

    init();
});
</script>
</html>
